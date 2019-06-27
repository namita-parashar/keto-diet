<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Validator;
use URL;
use Session;
use Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\UserPreferenceMeal;
use App\Models\DietChart;
use App\Models\RecipeIngredient;
use App\Models\Recipe;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Jobs\SendEmailJob;
use App\Models\User;

class PaymentController extends Controller
{
    //
     private $_api_context;
    public function __construct()
    {
      // parent::__construct();
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
    );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    public function payPal(Request $request){
      $user_id = $request->user_id;
      return view('web/paywithpaypal',['user_id'=>$user_id]);
    }
    public function payWithpaypal(Request $request)
    {
      $user_id =  $request->user_id;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setPrice(1); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
        ->setTotal(1);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
        ->setItemList($item_list)
        ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('paymentstatus',['user_id'=>$user_id])) /** Specify return URL **/
        ->setCancelUrl(URL::route('paymentstatus',['user_id'=>$user_id]));
        $payment = new Payment();
        $payment->setIntent('Sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirect_urls)
        ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        // dd($payment);die;
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::route('paywithpaypal',['user_id'=>$user_id]);
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('paywithpaypal',['user_id'=>$user_id]);
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session **/
       Session::put('paypal_payment_id', $payment->getId());
      // session('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::route('paywithpaypal',['user_id'=>$user_id]);
    }

    public function getPaymentStatus(Request $request)
    {
        $user_id = $request->user_id;
        // return $user_id;
        /** Get the payment ID before session clear **/
        // $payment_id = Session::get('paypal_payment_id');
      $payment_id = $request->paymentId;
        // return $payment_id;
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::route('/');
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {

          $user_id = $request->user_id;
          $order = new Order();
          $order->user_id = $user_id;
          $order->price = 1;
          $order->status = 1;
          $order->uuid = Str::uuid()->toString();;
          $order->save();

          $products = UserPreferenceMeal::where('user_id',$user_id)->get();

          $week = 1;
          $day = 1;
          foreach($products as $key)
          {
            $recipe = RecipeIngredient::where('product_id',$key->product_id)->first();
             $type = Recipe::Where('id',$recipe->recipe_id)->first();
             $day_check = Recipe::getWeek($request->week);
             // return $request->week;
             $day_check_start= $day_check['day_check_start'];
             $day_check_end= $day_check['day_check_end'];
             $exists_diet = DietChart::where('user_id',$user_id)->where('day','>=',$day_check_start)
                        ->where('day','<=',$day_check_end)->where('recipe_id',$recipe->recipe_id)->first();
            if(!$exists_diet){
             $user_diet_chart = new DietChart();
             $user_diet_chart->user_id = $user_id;
             $user_diet_chart->recipe_id = $recipe->recipe_id;
             $user_diet_chart->type = $type->type;
             $exists = DietChart::where('user_id',$user_id)->where('type',$type->type)->orderby('day','desc')->first();
             $exists_sec =  DietChart::where('user_id',$user_id)->first();
             $table_check = DietChart::where('user_id',$user_id)->count();
             if($table_check == 0)
             {
               $day_diet = 1;
             }
             elseif(DietChart::where('user_id',$user_id)->where('type',$type->type)->orderby('day','desc')->first()){
               $day_diet = $exists->day+1;
             }
             elseif(DietChart::where('user_id',$user_id)->where('type','!=',$type->type)->first()){
               $day_diet =  $exists_sec->day;
             }
             $user_diet_chart->day = $day_diet;
             $user_diet_chart->order_id = $order->id;
             $user_diet_chart->save();
           }
           }
           $user = User::Where('id',$user_id)->first();
           // return $user_id;
           $user['email'] = $user->email;
             dispatch(new SendEmailJob($user));
           \Session::put('success', 'Payment success');
            return Redirect::route('index_user_information');
        }
        \Session::put('error', 'Payment failed');
        return Redirect::route('/');
    }

    public function payWithcash(Request $request)
    {
      $user_id = $request->user_id;
      $order = new Order();
      $order->user_id = $user_id;
      $order->price = 1;
      $order->status = 1;
      $order->uuid = Str::uuid()->toString();;
      $order->save();

      $products = UserPreferenceMeal::where('user_id',$user_id)->get();
      $day = 1;
      foreach($products as $key){
          $recipe = RecipeIngredient::where('product_id',$key->product_id)->first();
          $type = Recipe::Where('id',$recipe->recipe_id)->first();
          $day_check = Recipe::getWeek($request->week);
          $day_check_start= $day_check['day_check_start'];
          $day_check_end= $day_check['day_check_end'];
          $exists_diet = DietChart::where('user_id',$user_id)->where('day','>=',$day_check_start)
                        ->where('day','<=',$day_check_end)->where('recipe_id',$recipe->recipe_id)->orderby('day','asc')->first();
          if(!$exists_diet){
              $user_diet_chart = new DietChart();
              $user_diet_chart->user_id = $user_id;
              $user_diet_chart->recipe_id = $recipe->recipe_id;
              $user_diet_chart->type = $type->type;
              $exists = DietChart::where('user_id',$user_id)->where('type',$type->type)->orderby('day','desc')->first();
              $exists_sec =  DietChart::where('user_id',$user_id)->first();
              $table_check = DietChart::where('user_id',$user_id)->count();
              if($table_check == 0){
                    $day_diet = 1;
              }
              elseif(DietChart::where('user_id',$user_id)->where('type',$type->type)->orderby('day','desc')->first()){
                  $day_diet = $exists->day+1;
              }
              elseif(DietChart::where('user_id',$user_id)->where('type','!=',$type->type)->first()){
                    $day_diet =  $exists_sec->day;
              }
              $user_diet_chart->day = $day_diet;
              $user_diet_chart->order_id = $order->id;
              $user_diet_chart->save();
       }
     }
       $user = User::Where('id',$user_id)->first();
       $user['email'] = $user->email;
         dispatch(new SendEmailJob($user));
         echo "success";
       // return $user_diet_chart;

    }
}
