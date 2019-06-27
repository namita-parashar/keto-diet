@extends('admin/layout/main') @section('content')
<style>
span.select2.select2-container.select2-container--bootstrap4.select2-container--focus,.product_div{
  width: 161px!important;
}

input.form-control.qunatity_div {
    width: 161px;
    margin-top: -37px;
    margin-left: 222px;}
    input.form-control.metric_div{
        width: 161px;
        margin-top: -36px;
        float: right;
        margin-right: 80px;
    }
    input.add_field_button_products,input.remove_field_button_products {
    margin-top: -30px;
    float: right;
    margin-right: 32px;
}
</style>
<section class="section-container">
        <!-- Page content-->
        <div class="content-wrapper">
           <div class="content-heading">
              <div>Edit Recipe</div><!-- START Language list-->
           </div>
           <ol class="breadcrumb">
                    <li>
                       <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li>
                       <a href="{{route('show_recipe')}}">Recipe</a>
                    </li>
                    <li class="active">
                      <strong>  Edit Recipe </strong>
                    </li>
           </ol>
           <form action ="{{route('update_recipe')}}" method="post" enctype="multipart/form-data">
             <input type="hidden" name="recipe_id" value={{$recipe->id}}>
             {{csrf_field()}}
           <div class="row">
             <div class="col-md-8">
                 <!-- START card-->
                 <div class="card card-default">
                    <div class="card-body">
                      <div class="form-group"><label>Name</label><input class="form-control" type="text" name="name" value="{{$recipe->name}}" ></div>
                      <div class="form-group"><label>Time</label><input class="form-control" type="time"  name="time" value="{{$recipe->time}}" ></div>
                      <div class="form-group"><label>Type</label>
                         <select class="form-control" id="select2-1" name="type">
                            <option></option>
                            <option {{ $recipe->type == '1' ? 'selected':'' }} value="1">Breakfast</option>
                            <option {{ $recipe->type == '2' ? 'selected':'' }} value="2">Brunch</option>
                            <option {{ $recipe->type == '3' ? 'selected':'' }} value="3">Lunch</option>
                            <option {{ $recipe->type == '4' ? 'selected':'' }} value="4">Dinner</option>
                         </select>
                      </div>
                      <div id="container">
                        <?php $count_i=1;?>
                      @foreach($recipe->recipeIngredient as $recipe_products)
                        <div class="form-group input_fields_wrap_products"><label>Products</label>
                        <select class="form-control  product_div"  name="product[product_name][]" >
                          <option >Select  Product</option>
                          @foreach($products as $product)
                           <option value="{{$product->id}}" @if($product->id == $recipe_products->id)
                                         selected @endif>{{$product->name}}</option>
                           @endforeach
                        </select>
                        <input type="text" class="form-control qunatity_div" name="product[qty][]" placeholder="enter quantity" value="{{$recipe_products->pivot->quantity}}">
                        <input type="text" class="form-control metric_div" name="product[metric][]" placeholder="enter metric" value="{{$recipe_products->pivot->metric}}">
                        @if($recipe_products->pivot->hide_metric ==0)
                         <div class="c-checkbox"><label><input type="checkbox"  name="product[is_hide][]"><span class="fa fa-check"></span>Show Metric</label></div>
                         @else
                         <div class="c-checkbox"><label><input type="checkbox" checked="" name="product[is_hide][]"><span class="fa fa-check"></span> Show Metric </label></div>
                         @endif
                        @if($count_i == 1)
                        <input type="button" class="add_field_button_products" value="+" />@endif
                        <?php $count_i++; ?>
                         </div>

                         @endforeach

                     </div>

                      <div class="step-proc">
                        <?php $i=-1 ; ?>
                          @foreach($recipe->recipePreparation as $recipe_step)
                            <?php $i++;?>
                            <!-- <input type="hidden" class="index_step" value="{{$i}}"> -->
                          <div class="form-group input_fields_wrap"><label>Step</label>
                            <input type="hidden" class= "recipe_step_id" name="recipe_step_id[]" value="{{$recipe_step->id}}">
                            <textarea class="form-control" type="text" name="step[{{$i}}][title]">{{$recipe_step->step}}</textarea>
                            @if(!empty($recipe_step->image))
                            <a id="{{$recipe_step->id}}" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger delete" ><i class="fa fa-times"></i></a>
                            <img src="{{'storage/'.$recipe_step->image}}" type="file" name="steps[{{$i}}][image]" height=50 width=50>
                          @endif
                          <input class="form-control" type="file" name="steps[{{$i}}][image]" value="{{'storage/'.$recipe_step->image}}">
                        </div>
                          <input type="hidden" class="index_step" value="{{$i}}">
                        @endforeach
                      </div>
                        <button class="add_field_button">+</button>
                              <div class="form-group"><label>Video</label>
                                @if(!empty($recipe->video))
                                <iframe width="100" height="100" src="//www.youtube.com/embed/{{$recipe->video}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                @endif
                                <input class="form-control" name="video" type="" Value="{{$recipe->video}}"></div>
                                <button class="btn btn-success btn-lg" type="submit" style="width:100%;">Update</button>
                             </div>
                    </div>
                 </div><!-- END card-->
              </div>
            </form>
            <div class="container_copy" style="display:none;">
            <div class="form-group input_fields_wrap_products"><label>Products</label>
            <select class="form-control  product_div"  name="product[product_name][]" >
              <option selected="true" disabled="disabled">Select  Product</option>
              @foreach($products as $product)
               <option value="{{$product->id}}" >{{$product->name}}</option>
               @endforeach
            </select>
            <input type="text" class="form-control qunatity_div" name="product[qty][]" placeholder="enter quantity" >
            <input type="text" class="form-control metric_div" name="product[metric][]" placeholder="enter metric">
            <div class="c-checkbox"><label><input type="checkbox" name="product[is_hide][]"><span class="fa fa-check"></span> Show Metric</label></div>
            <input type="button" class="remove_field_button_products" value="-" />
          </div></div>

           </div>
        </div>
     </section>
     <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
     <script src="assets/js/my.js"></script>
     <script>
     $(function() {
         $(".delete").click(function(){
             var element = $(this);
             var del_id = element.attr("id");
             if(confirm("Are you sure you want to delete this recipe step? It will delete immediately when you click on OK."))
             {
                 $.get("{{URL::route('delete_recipe_step')}}?id="+del_id,function(data){
                     $(element).closest('label').remove();
                 });
                 window.location.reload();
                 return false;
             }
         });
     });


     $(document).ready(function() {
         var max_fields      = 10; //maximum input boxes allowed
         var wrapper         = $(".step-proc"); //Fields wrapper
         var add_button      = $(".add_field_button"); //Add button ID
         var recipe_step_id = $(".recipe_step_id").val();
         var  index_step = $(".index_step").last().val();
         var x = 1; //initlal text box count
         // var i=0;

         $(add_button).click(function(e){ //on add input button click
             e.preventDefault();

             if(x < max_fields){ //max input box allowed
                 x++; //text box increment
                 index_step++;
                 $(wrapper).append('<div class="form-group input_fields_wrap"><input type="hidden" class= "recipe_step_id" name="recipe_step_id[]" value=""><textarea class="form-control" type="text" name="step[' + index_step + '][title]" placeholder="Enter Step"></textarea><input type="file" class="form-control" name="steps[' + index_step + '][image]"><a href="#" class="remove_field"><strong>-</strong></a></div>'); //add input box
             }
         });
         $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
             e.preventDefault(); $(this).parent('div').remove(); x--;
         })

         // add product name and their quantity
         $('select.product_div').change(function() {
           newProduct();
          });
         $('#container').on('click','.add_field_button_products', function () {
         var newthing=$('.container_copy').html();
         $('#container').append(newthing);
         $('select.product_div').change(function() {
           newProduct();
          });
          $('#container').on('click','.remove_field_button_products', function () {
               $(this).parent().remove();
               newProduct();
             });
           });
         });
       </script>

@endsection
