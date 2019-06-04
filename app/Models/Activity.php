<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $table = 'activity';

    public function users(){
          return $this->belongsToMany('App\Models\User','user_preference_activity','activity_id','user_id');
    }
}
