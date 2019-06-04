<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Activity;
use App\Models\Product;
use Session;

class UserController extends Controller
{
    //
    public function index(){
      $activity = Activity::where('type',1)->get();
      $meats = Product::where('type',1)->get();
      $veggies = Product::where('type',2)->get();
      $products = Product::where('type',3)->get();
      $typical_day = Activity::where('type',2)->get();
      $true_for = Activity::where('type',3)->get();
      return view('web/user-information',['activites'=>$activity,'meats'=>$meats,'veggies'=>$veggies,
                                          'products'=>$products,'typical_day'=>$typical_day,'true_for_you'=>$true_for]);
    }
    public function create(Request $request)
    {

      // print_r($request->gender);die;
      // return $request->gender;
      //convert feet inch to cm
      // $heignt_cm = round(($request->imperial_feet*30.48) + ($request->imperial_inch*2.54),2);
      //convert lb to kg
      // $weight_kg = round($request->imperial_weight/2.2046 ,2 );
      // $target_weight_kg = round($request->)imperial_target_weight/2.2046 ,2);
      //bmi
      //  $bmi = $weight_kg/($heignt_cm * $heignt_cm);
      //water recommend
      // $water_recommend = $weight_kg* 0.033;
       Session::put('user', ['gender' => $request->gender, 'last_div' => $request->last_div, 'activity' => $request->activity,
                              'meat' => $request->meat , 'veggie' =>$request->veggie,'product'=>$request->product,
                              'day'=>$request->day,'true'=>$request->true,
                              'metric_age'=>$request->metric_age_val,'metric_height'=>$request->metric_height_val,'metric_weight'=>$request->metric_weight_val,'metric_target_weight'=>$request->metric_target_weight_val,
                              'imperial_age'=>$request->imperial_age,'imperial_feet'=>$request->imperial_feet,'imperial_inch'=>$request->imperial_inch,'imperial_weight'=>$request->imperial_weight,'imperial_target_weight'=>$request->imperial_target_weight]);

        return Session::get('user');
    }
}
