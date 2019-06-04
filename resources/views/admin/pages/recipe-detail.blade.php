@extends('admin/layout/main') @section('content')
<section class="section-container">
        <!-- Page content-->
        <div class="content-wrapper">
           <div class="content-heading">
              <div>Recipe Detail</div><!-- START Language list-->
           </div>
           <ol class="breadcrumb">
                    <li>
                       <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li>
                       <a href="{{route('show_recipe')}}">Recipe</a>
                    </li>
                    <li class="active">
                      <strong>  Recipe Detail </strong>
                    </li>
           </ol>
           <div class="row">
             <div class="col-md-8">
                 <!-- START card-->
                 <div class="card card-default">
                    <div class="card-body">
                      @foreach($recipe->recipeIngredient as $recipe_products)
                      <div class="form-group"><label>Product Name</label><input class="form-control" type="text"  Value="{{$recipe_products->name}}" readonly=""></div>
                      <div class="form-group"><label>Calories</label><input class="form-control" type="text"  Value="{{$recipe_products->calories}}" readonly=""></div>
                      <div class="form-group row">
                          <div class="col-xl-10">
                            @if($recipe_products->is_important ==0)
                             <div class="checkbox c-checkbox"><label><input type="checkbox"  name="is_important"><span class="fa fa-check"></span> Is Important</label></div>
                             @else
                             <div class="checkbox c-checkbox"><label><input type="checkbox" checked="" name="is_important"><span class="fa fa-check"></span> Is Important</label></div>
                             @endif
                          </div>
                       </div>
                        @endforeach
                        @foreach($recipe->recipeIngredients as $recipe_quantity)
                        <div class="form-group"><label>Quantity</label><input class="form-control" type="text"  Value="{{$recipe_quantity->quantity}}" readonly=""></div>
                          @endforeach
                          <div class="form-group"><label>Name</label><input class="form-control" type="text"  value="{{$recipe->name}}" readonly=""></div>
                          <?php $key =1;?>
                          @foreach($recipe->recipePreparation as $recipe_step)
                          <div class="form-group"><label>Step {{$key++}}</label><input class="form-control" type="text"  Value="{{$recipe_step->step}}" readonly="">
                          <img src="{{url('storage/'.$recipe_step->image) }}" width="50" height="50"></div>
                            @endforeach
                              <div class="form-group"><label>Video</label><input class="form-control" type="text" Value="{{$recipe->video}}" readonly=""></div>

                             </div>
                    </div>
                 </div><!-- END card-->
              </div>

           </div>
        </div>
     </section>

@endsection
