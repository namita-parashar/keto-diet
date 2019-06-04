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
          return $this->belongsToMany('App\Models\Product','recipe_ingredient','recipe_id','product_id');
    }
    public function recipePreparation(){
          return $this->hasMany('App\Models\RecipePreparation');
    }


}
