<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
