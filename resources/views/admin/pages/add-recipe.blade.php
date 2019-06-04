@extends('admin/layout/main') @section('content')
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
                          <div class="form-group"><label>Products</label>
                            <select class="form-control multiselecopt product_div" id="select2-1" name="product" multiple>
                              <option>Select  Product</option>
                              @foreach($products as $product)
                              <option class="product_value" value ="{{$product->id}}">{{$product->name}}</option>
                              @endforeach
                            </select>
                             </div>
                             <span class="error" style="display:none;">Quantity field is required to fill</span>
                             <div class="form-group quantity_div" style="display:none;"><label>Quantity</label><input class="form-control" type="text" placeholder="Enter Quantity" name="quantity">
                             </div>
                             <div class="form-group input_fields_wrap"><label>Steps</label>
                               <textarea class="form-control " type="text" placeholder="Enter step" name="step[][title]"></textarea>
                               <input type="file" class="form-control" name="steps[][image]">
                               <button class="add_field_button">+</button>
                             </div>
                             <div class="form-group">
                               <label>Video</label>
                               <input type="file" class="form-control" name="video" accept="video/*">

                             </div>
                          <button class="btn btn-success btn-lg" type="submit" style="width:100%;">Add</button>
                    </div>
                 </div><!-- END card-->
              </div>
            </form>

           </div>
        </div>
     </section>

@endsection
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
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

});

$(document).ready(function () {
    $("select.product_div").change(function (){
			if($(this).val()) {
				$("div.quantity_div").show();
        $('.quantity_div').prop('required',true);
       $(".select2-results").hide();
			}
    });


        // alert($('.quantity_div').val());
      // $("select.product_div").click(function(){
      //   alert('inside');
      //   if($('.quantity_div').val() !=""){
      //     $(".select2-results").show();
      //   }
      //   else{
      //     alert('dff');
      //     $(".error").toggle();
      //   }
      // });



	});
</script>
