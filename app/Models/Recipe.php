<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
    protected $table = 'recipes';

    public function dietChart(){
          return $this->belongsTo('App\Models\DietChart','id','recipe_id');
    }

    public function recipeIngredients()
    {
      return $this->hasMany('App\Models\RecipeIngredient');
    }
    public function recipeIngredient(){
          return $this->belongsToMany('App\Models\Product','recipe_ingredient','recipe_id','product_id')->withPivot('quantity','metric','hide_metric');
    }
    public function recipePreparation(){
          return $this->hasMany('App\Models\RecipePreparation');
    }

    public static function getWeek($res){
      if($res == 1)
      {
        $day_check_start = 1;
        $day_check_end = 7;
      }
      elseif($res == 2){
          $day_check_start= 8;
          $day_check_end = 14;

      }
      elseif($res == 3){
          $day_check_start= 15;
          $day_check_end = 22;
      }
      elseif($res == 4){
        $day_check_start= 23;
        $day_check_end = 30;
      }
      elseif($res == 5){
        $day_check_start = 31;
        $day_check_end = 38;
      }
      elseif($res == 6){
        $day_check_start = 39 ;
        $day_check_end = 46;
      }
      elseif($res == 7){
        $day_check_start = 47;
        $day_check_end = 54;
      }
      elseif($res == 8){
        $day_check_start = 55;
        $day_check_end = 62;
      }
      elseif($res == 9){
        $day_check_start = 63;
        $day_check_end = 70;
      }
      else{
        $day_check_start= 1;
        $day_check_end = 7;
      }
      return ["day_check_start"=>$day_check_start , "day_check_end"=>$day_check_end];
    }


}
