<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\Product;
use App\Http\Requests\RecipeRequest;
use App\Models\RecipePreparation;
use App\Models\RecipeIngredient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class RecipeController extends Controller
{
    //
    public function show(){
      $recipe = Recipe::get();
      return view('admin/pages/recipes',['recipes'=>$recipe]);
    }

    public function showRecipeDetail(Request $request){
      $recipe = Recipe::where('id',$request->id)->first();
      // return  $recipe->recipeIngredient()->get();
      // select * from `products` inner join `recipe_ingredient` on `products`.`id` = `recipe_ingredient`.`product_id` where `recipe_ingredient`.`recipe_id` = ?;
      return view('admin/pages/recipe-detail',['recipe'=>$recipe]);
    }
    public function showAddRecipe(Request $request)
    {
      $products = Product::orderby('name','asc')->get();

      return view('admin/pages/add-recipe',['products'=>$products]);
    }
    public function create(RecipeRequest $request)
    {
      // $video_name = $request->file('video')->getClientOriginalName();
      // $extension = $request->file('video')->getClientOriginalExtension();
      // Storage::disk('public')->put($request->file('video')->getClientOriginalName(),  File::get($request->file('video')));
        $recipe = new Recipe();
        $recipe->name = $request->name;
        $recipe->time = $request->time;
        $recipe->video = $request->video;
        $recipe->type = $request->type;
        $recipe->save();

        $step=  $request->get('step');
        $images = $request->file('steps');
        $step_images=array();
        if($images){
        foreach($images as $k =>$img){
          $step_images[] = $request->file('steps')[$k]['image']->getClientOriginalName();
           $extension = $request->file('steps')[$k]['image']->getClientOriginalExtension();
           Storage::disk('public')->put($request->file('steps')[$k]['image']->getClientOriginalName(),  File::get($request->file('steps')[$k]['image']));
        }}

          foreach($step as $i =>$steps){
              // if(!empty($recipe_step[$i])){
          $recipe_step = new RecipePreparation();
          $recipe_step->recipe_id = $recipe->id;
          $recipe_step->step = $step[$i]['title'];
          if(!empty($step_images[$i])){
            $recipe_step->image = $step_images[$i];
          }
          $recipe_step->save();
        }
        // }

        $product = array();
        $quantity= array();
        $pr = $request->get('product');
        for($k=0;$k<count($pr['product_name']);$k++)
        {
          $product_id = $pr['product_name'][$k];
          $quantity = $pr['qty'][$k];
          $metric = $pr['metric'][$k];
          if($pr['is_hide'][$k] == 'on'){
            $is_hide =1;
          }
          else{
            $is_hide =0;
          }
          $recipe_ingredient = new RecipeIngredient();
          $recipe_ingredient->product_id = $product_id;
          $recipe_ingredient->recipe_id = $recipe->id;
          $recipe_ingredient->quantity = $quantity;
          $recipe_ingredient->metric = $metric;
          $recipe_ingredient->hide_metric = $is_hide;
          $recipe_ingredient->save();
        }
          return redirect()->back();
    }

    public function indexUpdateRecipe(Request $request){
        $recipe = Recipe::where('id',$request->id)->first();
        $products = Product::orderby('name','asc')->get();
        return view('admin/pages/update-recipe',['recipe'=>$recipe,'products'=>$products]);
    }
    public function updateRecipe(Request $request){
      // $video_name = $request->file('video')->getClientOriginalName();
      // $extension = $request->file('video')->getClientOriginalExtension();
      // Storage::disk('public')->put($request->file('video')->getClientOriginalName(),  File::get($request->file('video')));
      Recipe::where('id',$request->recipe_id)->update(['name'=>$request->name,'time'=>$request->time,'type'=>$request->type,'video'=>$request->video]);
      // RecipeIngredient::where('recipe_id',$request->recipe_id)->update(['product_id'=>$request->product,'quantity'=>$request->quantity]);
      $product = array();
      $quantity= array();
      $pr = $request->get('product');
      RecipeIngredient::where('recipe_id',$request->recipe_id)->delete();
      for($k=0;$k<count($pr['product_name']);$k++){
        $product_id = $pr['product_name'][$k];
        $quantity = $pr['qty'][$k];
        $metric = $pr['metric'][$k];
        // print_r($product_id);

        if($pr['is_hide'][$k] == 'on'){
          $is_hide =1;
        }
        else{
          $is_hide =0;
        }

        $recipe_ingredient = new RecipeIngredient();
        $recipe_ingredient->product_id = $product_id;
        $recipe_ingredient->recipe_id = $request->recipe_id;
        $recipe_ingredient->quantity = $quantity;
        $recipe_ingredient->metric = $metric;
        $recipe_ingredient->hide_metric = $is_hide;
        $recipe_ingredient->save();
      }
      $step = $request->get('step');
      $images = $request->file('steps');
      $step_images=array();
      if($images){
      foreach($images as $k =>$img){
            $step_images[$k] = $request->file('steps')[$k]['image']->getClientOriginalName();
            $extension = $request->file('steps')[$k]['image']->getClientOriginalExtension();
            Storage::disk('public')->put($request->file('steps')[$k]['image']->getClientOriginalName(),  File::get($request->file('steps')[$k]['image']));
        }
      }

      foreach(array_values($request->recipe_step_id) as $r_id =>$red_id)
      {
        foreach($step as $i =>$steps) {
            $recipe_step = $request->recipe_step_id;
            if(! empty($recipe_step[$i])){
              $recipe_steps = RecipePreparation::where('id',$recipe_step[$i])->first();
              $recipe_steps->step = $step[$i]['title'];
              if(empty($step_images[$i])){
                $recipe_steps->image = $recipe_steps->image;
              }
              else{
                    $recipe_steps->image = $step_images[$i];
              }
              $recipe_steps->save();
            }
            elseif(empty($request->recipe_step_id[$r_id])){
              $recipe_step = new RecipePreparation();
              $recipe_step->recipe_id = $request->recipe_id;
              $recipe_step->step = $step[$i]['title'];
              if($images){
                  $recipe_step->image = $step_images[$i];
                }
                $recipe_step->save();
              }
        }
      }
      return redirect()->back();
    }
    public function delete(Request $request){
      Recipe::where('id',$request->id)->delete();
      return redirect::back();
    }
    public function deleteRecipeStep(Request $request){
      RecipePreparation::where('id',$request->id)->delete();
      return redirect::back();
    }

}
