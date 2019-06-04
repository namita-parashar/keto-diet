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
<div class="row">
  <!-- User Profile Details div -->
<div class="col-lg-9 profile-div">
<div class="tab-content p-0 b0">
<div class="tab-pane active" id="tabSetting1">
<div class="card b">
<div class="card-header bg-gray-lighter text-bold">Diet Details</div>
<div class="feed-activity-list">
  @foreach($recipe->recipeIngredients as $res)
  <div class="row show-grid">
  <div class=" col-md-4 ">Quantity:</div>
  <div class=" col-md-8 ">{{$res->quantity}}</div>
  </div>
  @endforeach
  @foreach($recipe->recipeIngredient as $re)
  <div class="row show-grid">
  <div class=" col-md-4 ">Product Name:</div>
  <div class=" col-md-8 ">{{$re->name}}</div>
  </div>

  <div class="row show-grid">
  <div class=" col-md-4 ">Is Important:</div>
  <div class=" col-md-8 ">
    @if($re->is_important == 1)
    Important
    @else
    Not Important
    @endif
  </div>
  </div>
@endforeach
<div class="row show-grid">
<div class=" col-md-4 ">Time Making:</div>
<div class=" col-md-8 ">
{{$recipe->time}}
</div>
</div>
<div class="row show-grid">
<div class=" col-md-4 ">Video:</div>
<div class=" col-md-8 ">
{{$recipe->video}}
</div>
</div>

<?php $key = 1; ?>
@foreach($recipe->recipePreparation as $rep)
<div class="row show-grid">
<div class=" col-md-4 ">Steps {{$key++}}:</div>
<div class=" col-md-8 ">
{{$rep->step}}
</div>
<div class=" col-md-4 "></div>
<div class=" col-md-8 ">
<img src="{{$rep->image}}" height=50 width="50">
</div>
</div>
@endforeach
</div>
</div>
</div>
</div>
</div>
<!--end of user profile div  -->

</div>
</div>
</section>
<!-- Main section End-->
@endsection
