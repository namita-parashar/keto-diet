<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddActivityRequest;
use App\Models\Activity;

class ActivityController extends Controller
{
    //
    public function show(){
      $activites = Activity::paginate(10);
      return view('admin/pages/activity',['activites'=>$activites]);
    }

    public function index(){
      return view('admin/pages/add-activity');
    }

    public function create(AddActivityRequest $request){
      $activity = new Activity();
      $activity->name = $request->name;
      $activity->value = $request->value;
      $activity->type = $request->type;
      $activity->save();
      return redirect()->back();
    }

    public function updateIndex(Request $request)
    {
      $activity = Activity::where('id',$request->id)->first();
      return view('admin/pages/update-activity',['activity'=>$activity]);
    }

    public function update(Request $request)
    {
      $activity = Activity::where('id',$request->id)->update(['name'=>$request->name,'value'=>$request->value,'type'=>$request->type]);
      return redirect()->back();

    }

    public function delete(Request $request)
    {
      Activity::where('id',$request->id)->delete();
      return redirect::back();
    }
}
