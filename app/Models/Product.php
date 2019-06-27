<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    public function recipes(){
          return $this->belongsToMany('App\Models\Recipe','recipe_ingredient','product_id','recipe_id');
    }

    public function users(){
          return $this->belongsToMany('App\Models\User','user_preferance_meal','product_id','user_id');
    }

}
