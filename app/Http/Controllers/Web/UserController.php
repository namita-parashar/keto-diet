<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Activity;
use App\Models\Product;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserPreferenceActivity;
use App\Models\UserPreferenceMeal;
use App\Models\DietChart;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\Order;
use App\Models\RecipePreparation;
use App\Jobs\SendEmailJob;
use Session;
use Carbon\Carbon;
use PDF;
use Redirect;

class UserController extends Controller
{
    //
    public function index(){
      $activity = Activity::where('type',1)->get();
      $meats = Product::where('type',1)->where('is_important',1)->get();
      $veggies = Product::where('type',2)->where('is_important',1)->get();
      $products = Product::where('type',3)->where('is_important',1)->get();
      $typical_day = Activity::where('type',2)->get();
      $true_for = Activity::where('type',3)->get();
      return view('web/user-information',['activites'=>$activity,'meats'=>$meats,'veggies'=>$veggies,
                                          'products'=>$products,'typical_day'=>$typical_day,'true_for_you'=>$true_for]);
    }
    public function create(Request $request)
    {
      if($request->type == 1)
      {
        $age = $request->metric_age_val;
        $height = $request->metric_height_val;
        $weight = $request->metric_weight_val;
        $target_weight = $request->metric_target_weight_val;
      }
      else{
        $age = $request->imperial_age;
        $height = round(($request->imperial_feet*30.48) + ($request->imperial_inch*2.54),2);
        $weight = round($request->imperial_weight/2.2046 ,2 );
        $target_weight = round($request->imperial_target_weight/2.2046 ,2);
      }

      //convert feet inch to cm
      // $heignt_cm = round(($request->imperial_feet*30.48) + ($request->imperial_inch*2.54),2);
      //convert lb to kg
      // $weight_kg = round($request->imperial_weight/2.2046 ,2 );
      // $target_weight_kg = round($request->)imperial_target_weight/2.2046 ,2);
      $bmi = 0;
      $bmi_type ="";
      $water_recommend = 0;
      $bmr_value=0;
      $calories_recommend_from=0;
      $calories_recommend_to=0;
      if($weight != 0){
      //bmi
      $height_metre = $height/100;
      $bmi = round($weight/($height_metre * $height_metre),2);
      if($bmi < 18.5){
          $bmi_type = "Under Weight";
      }
      elseif($bmi >=18.5 && $bmi<= 24.9){
          $bmi_type = "Normal Weight";
      }
      elseif($bmi >= 25.0 && $bmi <=29.9){
          $bmi_type = "Over Weight";
      }
      elseif($bmi >=30.0){
        $bmi_type = "Obese";
      }
      //water recommend
      $water_recommend = round($weight* 0.033,2);
      if($request->gender == 1)
      {
      $bmr_value = round(((10 * $weight) + (6.25 * $height) - (5 * $age) - 161),2);
      }
      else{
        $bmr_value = round(((10 * $weight) + (6.25 * $height) - (5 * $age) + 5),2);
      }
      $activity_factor = Activity::where('id',$request->activity)->first();
      $calories_recommend_from = round($bmr_value * $activity_factor->value);
      $calories_recommend_to = ($calories_recommend_from - 100);
      // echo $activity_factor->value;die;
      // echo $bmi ."<br/>". $water_recommend ."<br/>". $bmr_value ."<br/>".  $calories_recommend;die;
    }

       Session::put('user', ['gender' => $request->gender,
                            'last_div' => $request->last_div,
                            'activity' => $request->activity,
                            'meat' => $request->meat ,
                            'veggie' =>$request->veggie,
                            'product'=>$request->product,
                            'day'=>$request->day,
                            'true'=>$request->true,
                            'height'=>$height,
                            'weight'=>$weight,
                            'target_weight'=>$target_weight,
                            'bmi'=>$bmi,
                            'metabolic_age'=>22,
                            'achievabe_weight'=>45,
                            'bmi_type'=>$bmi_type,
                            'water_recommend'=>$water_recommend,
                            'bmr'=>$bmr_value,
                            'calories_recommend_from'=>$calories_recommend_from,
                            'calories_recommend_to'=>$calories_recommend_to,
                            'age'=>$age,
                            'metric_age'=>$request->metric_age_val,
                            'metric_height'=>$request->metric_height_val,
                            'metric_weight'=>$request->metric_weight_val,
                            'metric_target_weight'=>$request->metric_target_weight_val,
                            'imperial_age'=>$request->imperial_age,
                            'imperial_feet'=>$request->imperial_feet,
                            'imperial_inch'=>$request->imperial_inch,
                            'imperial_weight'=>$request->imperial_weight,
                            'imperial_target_weight'=>$request->imperial_target_weight]);

        return Session::get('user');
    }
    public function showFinal()
    {
      return view('web/final');
    }
    public function showEmail()
    {
      return view('web/email');
    }
    public function sendEmail(Request $request)
    {
      $email = $request->email;
      // dispatch(new SendEmailJob());
      // Mail::send('web/email',['email'=>$email] , function($message) use ($email) {
      //   // $message->from('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', 'Learning Laravel');
      //   $message->to($email);
      //   $message->subject('Sendgrid Testing'); });
      $user = new User();
      $user->email = $email;
      $user->gender = Session::get('user.gender');
      $user->is_admin = 0;
      $user->save();
      //
      $user_profile = new UserProfile();
      $user_profile->user_id = $user->id;
      $user_profile->age = Session::get('user.age');
      $user_profile->height = Session::get('user.height');
      $user_profile->weight = Session::get('user.weight');
      $user_profile->target_weight = Session::get('user.target_weight');
      $user_profile->acheivable_weight = Session::get('user.achievabe_weight');
      $user_profile->calories_recommend = Session::get('user.calories_recommend_from');
      $user_profile->water_recommend = Session::get('user.water_recommend');
      $user_profile->bmi = Session::get('user.bmi');
      $user_profile->metabolic_age = Session::get('user.metabolic_age');
      $user_profile->save();

      $user_preference_activity = new UserPreferenceActivity();
      $user_preference_activity->user_id = $user->id;
      $user_preference_activity->activity_id = Session::get('user.activity');
      $user_preference_activity->save();
      $veggie = explode(',' ,Session::get('user.veggie'));
      $meat =explode(',' , Session::get('user.meat'));
      $product = explode(',' ,Session::get('user.product'));
      $products = array_merge($veggie,$meat,$product);
      $week = 1;
      $day = 1;
      foreach($products as $key =>$pr)
      {
      $product_id = $products[$key];
      $user_preference_meal = new UserPreferenceMeal();
      $user_preference_meal->user_id = $user->id;
      $user_preference_meal->product_id = $product_id;
      $user_preference_meal->save();

    //   $recipe = RecipeIngredient::where('product_id',$product_id)->first();
    //   // // echo $recipe;die;
    //   $type = Recipe::Where('id',$recipe->recipe_id)->first();
    //   $user_diet_chart = new DietChart();
    //   $user_diet_chart->user_id = $user->id;
    //   $user_diet_chart->recipe_id = $recipe->recipe_id;
    //   $user_diet_chart->type = $type->type;
    //   $exists = DietChart::where('user_id',$user->id)->where('type',$type->type)->orderby('day','desc')->first();
    //   $exists_sec =  DietChart::where('user_id',$user->id)->first();
    //   $table_check = DietChart::where('user_id',$user->id)->count();
    //   if($table_check == 0)
    //   {
    //     $day_diet = 1;
    //   }
    //   elseif(DietChart::where('user_id',$user->id)->where('type',$type->type)->orderby('day','desc')->first()){
    //     $day_diet = $exists->day+1;
    //   }
    //   elseif(DietChart::where('user_id',$user->id)->where('type','!=',$type->type)->first()){
    //     $day_diet =  $exists_sec->day;
    //   }
    //   $user_diet_chart->day = $day_diet;
    //   $user_diet_chart->save();
    }
      Session::flush('user');
      return view('web/checkout',['user_id'=>$user->id]);
    }

    public function checkout(){
      $user_id = User::orderby('id','desc')->first();
      return view('web/checkout',['user_id'=>$user_id]);
    }

    public function dietPlanDetails(Request $request){
      $recipe = Recipe::where('id',$request->recipe_id)->first();
      $calories_count = $recipe->recipeIngredient()->sum('calories');
    return view('web/recipe-detail',['recipe'=>$recipe,'calories_count'=>$calories_count]);
    }
    public function generatePDF(Request $request)
    {
      // return $request->week;
        $user_id = $request->user_id;
        // $days_count =   DietChart::where('user_id',$user_id)->groupby('recipe_id')->get();
        //   return $request->week;
          $day_check = Recipe::getWeek($request->week);
          $day_check_start= $day_check['day_check_start'];
          $day_check_end= $day_check['day_check_end'];
          $diet = DietChart::where('user_id',$user_id)->where('day','>=',$day_check_start)->where('day','<=',$day_check_end)->groupby('recipe_id')->orderby('day','asc')->get();
          // return $diet;
          $result = [];
        foreach ($diet as $key) {
          $recipe_id=$key->recipe_id;
          $recipe = Recipe::where('id',$recipe_id)->first();
          foreach ($recipe->recipeIngredient as  $value) {
          $key =  is_array($value) ? $value['name'] : $value->name;
              $result[$key] =$value;
            }
        }
          $pdf = PDF::loadView('web/grocery-list', ['recipe'=>$recipe,'result'=>$result]);
          return $pdf->download('grocery-list.pdf');
    }
    public function dietPlan(Request $request){
      $order_id = $request->uuid;
      $order = Order::where('uuid',$order_id)->first();
      $days_count = DietChart::where('user_id',$order->user_id)->groupby('day')->get();
      $data = [];
      foreach ($days_count as $key) {
        $data[] =  $key['day'];
        }
        $week = ceil(count($data) / 7);
        // return $request->week;
        $day_check = Recipe::getWeek($request->week);
        $day_check_start= $day_check['day_check_start'];
        $day_check_end= $day_check['day_check_end'];
        $diet = DietChart::where('user_id',$order->user_id)->where('day','>=',$day_check_start)->where('day','<=',$day_check_end)->orderby('day','asc')->get();
        $response = [];
        foreach($diet as $d) {
          $user_id = $d['user_id'];
          $day = $d['day'];
          $type = $d['type'];
          $response[$user_id][$day][$type]['name'] = $this->recipeName($d->recipe_id);
          $response[$user_id][$day][$type]['id'] = $d->recipe_id;
        }
      return view('web/diet-plan',['diets'=>$response,'order'=>$order,'week'=>$week,'diet'=>$diet,'week_url'=>$request->week]);
    }
    public function recipeName($request){
        $recipe_name = Recipe::where('id',$request)->first();
      return $recipe_name->name;

    }
}
