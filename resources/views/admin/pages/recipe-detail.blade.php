@extends('admin/layout/main') @section('content')
<style>
.product_div,.calories_div{
  width: 161px!important;
}

input.form-control.qunatity_div {
    width: 161px;
    margin-top: -37px;
    margin-left: 222px;}
    label.qty {
    float: right;
    margin-right: 400px;
}
input.form-control.metric_div{
    width: 161px;
    margin-top: -36px;
    float: right;
    margin-right: 80px;
}
</style>
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

                      <!-- <div class="form-group"><label>Product Name</label><input class="form-control" type="text"  Value="{{$recipe_products->name}}" readonly=""></div> -->
                      <div id="container">
                      <div class="form-group input_fields_wrap_products"><label>Products</label>
                        <label class="qty">Quantity</label>
                        <input class="form-control product_div" type="text"  Value="{{$recipe_products->name}}" readonly="">
                        <input class="form-control qunatity_div" type="text"  Value="{{$recipe_products->pivot->quantity}}" readonly="">
                          <input class="form-control metric_div" type="text"  Value="{{$recipe_products->pivot->metric}}" readonly="">
                         </div>
                       </div>
                      <div class="form-group"><label>Calories</label><input class="form-control calories_div" type="text"  Value="{{$recipe_products->calories}}" readonly=""></div>
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

                          <div class="form-group"><label>Name</label><input class="form-control" type="text"  value="{{$recipe->name}}" readonly=""></div>
                          <?php $key =1;?>
                          @foreach($recipe->recipePreparation as $recipe_step)
                          <div class="form-group"><label>Step {{$key++}}</label><input class="form-control" type="text"  Value="{{$recipe_step->step}}" readonly="">
                            @if(!empty($recipe_step->image))
                          <img src="{{url('storage/'.$recipe_step->image) }}" width="50" height="50">
                          @endif
                        </div>
                            @endforeach
                            @if(!empty($recipe->video))
                              <div class="form-group"><label>Video</label>
                                <iframe width="100" height="100" src="//www.youtube.com/embed/{{$recipe->video}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>

                             </div>
                             @endif
                    </div>
                 </div><!-- END card-->
              </div>

           </div>
        </div>
     </section>

@endsection
