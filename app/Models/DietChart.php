<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietChart extends Model
{
    //
    protected $table = 'diet_chart';

    public function user(){
          return $this->belongsToMany('App\Models\Recipe','diet_chart','recipe_id','user_id');
    }
}
