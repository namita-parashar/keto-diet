<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DietRequest;
use App\Models\Recipe;
use App\Models\DietChart;

class DietChartController extends Controller
{
    //
    public function index(Request $request)
    {
      $recipes = Recipe::get();
      $user_id = $request->id;
      return view('admin/pages/add-diet-chart',['recipes'=>$recipes,'user_id'=>$user_id]);
    }

    public function create(DietRequest $request)
    {
      $diet = new DietChart();
      $diet->user_id = $request->user_id;
      $diet->recipe_id = $request->recipe;
      $diet->type = $request->type;
      $diet->week = $request->week;
      $diet->day = $request->day;
      $diet->save();
      return redirect()->back();
    }
}
