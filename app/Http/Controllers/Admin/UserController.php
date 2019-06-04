<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use App\Models\User;
use App\Models\Activity;
use App\Models\UserPreferenceActivity;
use App\Models\Recipe;

class UserController extends Controller
{
    //
    public function show()
    {
      $users = UserProfile::paginate(10);
      return view('admin/pages/users',['users'=>$users]);
    }

    public function showUserDetail(Request $request){
      $user = UserProfile::where('user_id',$request->id)->first();
      // return  $user->user->userDietChart()->with('recipe')->get();
      return view('admin/pages/user-detail',['user'=>$user]);
    }

    public function showUserDietDetail(Request $request)
    {
      $recipe = Recipe::where('id',$request->id)->first();
      // return  $recipe->recipePreparation;
      return view('admin/pages/user-diet-detail',['recipe'=>$recipe]);
    }
}
