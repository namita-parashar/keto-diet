<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'users';

    public function userPreferenceMeal(){
          return $this->belongsToMany('App\Models\Product','user_preferance_meal','user_id','product_id');
    }

    public function activity(){
          return $this->belongsToMany('App\Models\Activity','user_preference_activity','user_id','activity_id');
    }

    public function userDietChart(){
          return $this->belongsToMany('App\Models\Recipe','diet_chart','user_id','recipe_id');
    }

}
