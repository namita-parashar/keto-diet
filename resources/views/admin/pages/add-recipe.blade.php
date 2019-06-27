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
              <div>Creating New Product</div><!-- START Language list-->
           </div>
           <ol class="breadcrumb">
                    <li>
                       <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li>
                       <a href="{{route('show_recipe')}}">Recipe</a>
                    </li>
                    <li class="active">
                  <strong>  Add Recipe </strong>
                    </li>
           </ol>
           <form action ="{{route('add_recipe')}}" method="post" enctype="multipart/form-data">
             {{csrf_field()}}
             <div class="form-group">
                    @if(count($errors))
                    <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <ul>
                    @foreach($errors->all() as $error)
                      <li>{{ $error }} </li>
                    @endforeach
                     </ul>
                    </div>
                    @endif
                  </div>
           <div class="row">
             <div class="col-md-8">
                 <!-- START card-->
                 <div class="card card-default">
                    <div class="card-body">
                          <div class="form-group"><label>Name</label><input class="form-control" type="text" placeholder="Enter Name" name="name"></div>
                          <div class="form-group"><label>Time</label><input class="form-control" type="time" placeholder="Enter Time" name="time"></div>
                          <div class="form-group"><label>Type</label>
                             <select class="form-control" id="select2-1" name="type">
                                <option></option>
                                <option value="1">Breakfast</option>
                                <option value="2">Brunch</option>
                                <option value="3">Lunch</option>
                                <option value="4">Dinner</option>
                             </select>
                          </div>
                          <div id="container">
                          <div class="form-group input_fields_wrap_products"><label>Products</label>
                            <select class="form-control  product_div"  name="product[product_name][]" >
                              <option >Select  Product</option>
                              @foreach($products as $product)
                              <option class="product_value" value ="{{$product->id}}">{{$product->name}}</option>
                              @endforeach
                            </select>
                            <input type="text" class="form-control qunatity_div" name="product[qty][]" placeholder="enter quantity">
                            <input type="text" class="form-control metric_div" name="product[metric][]" placeholder="enter metric">
                            <div class="c-checkbox"><label><input type="checkbox" name="product[is_hide][]"><span class="fa fa-check"></span> Show Metric</label></div>
                            <input type="button" class="add_field_button_products" value="+" />
                            <!-- <input type="button" class="remove_field" value="-" style="display:none;"> -->
                             </div>
                           </div>
                             <div class="form-group input_fields_wrap"><label>Steps</label>
                               <textarea class="form-control " type="text" placeholder="Enter step" name="step[][title]"></textarea>
                               <input type="file" class="form-control" name="steps[][image]">
                               <button class="add_field_button">+</button>
                             </div>
                             <div class="form-group">
                               <label>Video</label>
                               <input type="" name="video" placeholder="video_id" class="form-control">

                             </div>
                          <button class="btn btn-success btn-lg" type="submit" style="width:100%;">Add</button>
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

@endsection
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="assets/js/my.js"></script>
<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var x = 1; //initlal text box count
    var i=0;
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();

        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            i++;
            $(wrapper).append('<div class="form-group input_fields_wrap"><textarea class="form-control" type="text" name="step[' + i + '][title]" placeholder="Enter Step"></textarea><input type="file" class="form-control" name="steps[' + i + '][image]"><a href="#" class="remove_field"><strong>-</strong></a></div>'); //add input box
        }
    });
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
    // add product name and their quantity
    // var i;
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
