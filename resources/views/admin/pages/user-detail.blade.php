@extends('admin/layout/main') @section('content')
<style>
.show-grid {
padding-bottom: 20px;
border-bottom: 1px solid #f3f3f4;
margin: 15px 0;
margin-top: 15px;
margin-right: 0px;
margin-bottom: 15px;
margin-left: 0px;
}
.documents {
height: 260px !important;
width: 180px !important;
border: 1px solid rgb(228, 229, 229);
}
</style>
<!-- Main section Start-->
<section class="section-container">
<!-- Page content-->
<div class="content-wrapper">
<div class="content-heading">
<div>{{$user->user->name}} <small>{{$user->user->email}}</small></div><!-- START Language list-->
<div class="ml-auto" style="margin-top: -21px;">
<button id="profile-btn" class="btn btn-default btn-lg dash-navi"><em class="fa fa-mask success-circle"></em>Profile</button>
<button id="activity-btn" class="btn btn-default btn-lg dash-navi"><em class="fa fa-mask success-circle"></em> Activity Preference</button>
<button id="meal-btn" class="btn btn-default btn-lg dash-navi"><em class="fa fa-chart-line success-circle"></em>Meal Preference</button>
<button id="diet-btn" class="btn btn-default btn-lg dash-navi"><em class="fa fa-user-ninja success-circle"></em> Diet Chart</button>
</div>
</div>

<div class="row">
  <!-- User Profile Details div -->
<div class="col-lg-9 profile-div">
<div class="tab-content p-0 b0">
<div class="tab-pane active" id="tabSetting1">
<div class="card b">
<div class="card-header bg-gray-lighter text-bold">Profile</div>
<div class="feed-activity-list">

<div class="row show-grid">
<div class=" col-md-4 ">Age:</div>
<div class=" col-md-8 ">{{$user->age}}</div>
</div>
<div class="row show-grid">
<div class=" col-md-4 ">Height:</div>
<div class=" col-md-8 ">{{$user->height}}</div>
</div>
<div class="row show-grid">
<div class=" col-md-4 ">Weight:</div>
<div class=" col-md-8 ">{{$user->weight}}</div>
</div>
<div class="row show-grid">
<div class=" col-md-4 ">Target Weight:</div>
<div class=" col-md-8 ">
{{$user->target_weight}}
</div>
</div>
<div class="row show-grid">
<div class=" col-md-4 ">Acheivable Weight:</div>
<div class=" col-md-8 ">
{{$user->acheivable_weight}}
</div>
</div>
<div class="row show-grid">
<div class=" col-md-4 ">Calories Recommend:</div>
<div class=" col-md-8 ">
{{$user->calories_recommend}}
</div>
</div>
<div class="row show-grid">
<div class=" col-md-4 ">Water Recommend:</div>
<div class=" col-md-8 ">
{{$user->water_recommend}}
</div>
</div>
<div class="row show-grid">
<div class=" col-md-4 ">BMI:</div>
<div class=" col-md-8 ">
{{$user->bmi}}
</div>
</div>

<div class="row show-grid">
<div class=" col-md-4 ">Metabolic Age:</div>
<div class=" col-md-8 ">
{{$user->metabolic_age}}
</div>
</div>



</div>
</div>
</div>
</div>
</div>

<!--end of user profile div  -->

<!-- start of user activity Preference div -->
<div class="col-lg-9 activity-div">
<div class="tab-content p-0 b0">
<div class="tab-pane active" id="tabSetting1">
<div class="card b">
<div class="card-header bg-gray-lighter text-bold">Activity Preference</div>
<div class="feed-activity-list">
  <table class="table table-striped my-4 w-100" >
     <thead>
        <tr>
           <th>Name</th>
           <th>Value</th>
           <th>Type</th>
        </tr>
     </thead>
     <tbody>
       @foreach($user->user->activity as $users_data)
     <tr>
        <td>{{$users_data->name}}</td>
        <td>{{$users_data->value}}</td>
        <td>
          @if($users_data->type == 1)
        Activity
        @elseif($users_data->type ==2)
        Typical Day
        @else
        True For You
        @endif
        </td>
     </tr>
     @endforeach
   </tbody>
 </table>
</div>
</div>
</div>
</div>
</div>
<!-- End of user activity Preference div -->

<!-- Start of user meal Preference div -->
<div class="col-lg-9 meal-div">
  <div class="add col-sm-12 " style="margin-top: -5px;">
    <form action="{{route('index_diet',$users_data->id)}}" method="post">
      <a href="{{route('index_diet',$users_data->id)}}"><button class="btn btn-success" type="button" ><i class="fa fa-plus" aria-hidden="true"></i> Add User Diet</button></a>
    </form>
  </div>
<div class="tab-content p-0 b0">
<div class="tab-pane active" id="tabSetting1">
<div class="card b">
<div class="card-header bg-gray-lighter text-bold">Meal Preference</div>
<div class="feed-activity-list">
  <table class="table table-striped my-4 w-100" >
     <thead>
        <tr>
           <th>Name</th>
           <th>Calories</th>
           <th>Type</th>
        </tr>
     </thead>
     <tbody>
       @foreach($user->user->userPreferenceMeal as $users_data)
     <tr>
        <td>{{$users_data->name}}</td>
        <td>{{$users_data->calories}}</td>
        <td>
          @if($users_data->type == 1)
        Meat
        @elseif($users_data->type ==2)
        Veggie
        @else
        Product
        @endif
        </td>
     </tr>
     @endforeach

     </tbody>

  </table>
</div>
</div>
</div>
</div>
</div>
<!-- End of user Preference meal div -->

<!-- Start of diet chat div -->
<div class="col-lg-9 diet-div">
<div class="tab-content p-0 b0">
<div class="tab-pane active" id="tabSetting1">
<div class="card b">
<div class="card-header bg-gray-lighter text-bold">Diet Chart</div>
<div class="feed-activity-list">
  <table class="table table-striped my-4 w-100" >
     <thead>
        <tr>
           <th>Name</th>
           <th>Week</th>
           <th>Day</th>
           <th>Type</th>
        </tr>
     </thead>
     <tbody>
       @foreach($user->user->userDietChart as $users_data)
     <tr>
        <td>{{$users_data->name}}</td>
        <td>{{$users_data->dietChart->week}}</td>
        <td>{{$users_data->dietChart->day}}</td>
        <td>
          @if($users_data->dietChart->type == 1)
          Breakfast
          @elseif($users_data->dietChart->type ==2)
          Brunch
          @elseif($users_data->dietChart->type ==3)
          Lunch
          @else
          Dinner
          @endif
        </td>
        <td class="text-center">
          <div class="btn-group btn-group-xs">
            <a href="{{route('show_user_diet_detail',$users_data->id)}}" data-toggle="tooltip" title="View" class="btn btn-default"><i class="fa fa-eye"></i></a>
        <!-- <a id="{{$users_data->id}}" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger delete" ><i class="fa fa-times"></i></a> -->
        </div>
      </td>
     </tr>
     @endforeach

     </tbody>

  </table>
</div>
</div>
</div>
</div>
</div>
<!-- end of diet chart div -->
</div>
</div>
</section>
<!-- Main section End-->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

  //by default profile div show
    $('.profile-div').show();
    $('.activity-div').hide();
    $('.meal-div').hide();
    $('.diet-div').hide();

    //on click on profile button to show
    $('#profile-btn').click(function() {
      $('.activity-div').hide();
      $('.meal-div').hide();
      $('.profile-div').show();
      $('.diet-div').hide();
    });

    //on click on activity button to show
    $('#activity-btn').click(function() {
      $('.profile-div').hide();
      $('.meal-div').hide();
      $('.activity-div').show();
      $('.diet-div').hide();
    });

    //onclick on meal Preference button to show
    $('#meal-btn').click(function() {
      $('.profile-div').hide();
      $('.activity-div').hide();
      $('.meal-div').show();
      $('.diet-div').hide();
    });

    //onclick on diet chart to show
    $('#diet-btn').click(function() {
      $('.profile-div').hide();
      $('.activity-div').hide();
      $('.meal-div').hide();
      $('.diet-div').show();

    });


});

</script>
