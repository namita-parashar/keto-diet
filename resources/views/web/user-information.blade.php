<html>
<head>
  <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <meta name="description" content="Bootstrap Admin App">
     <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
     <link rel="icon" type="image/x-icon" href="favicon.ico">
     <title>Angle - Bootstrap Admin Template</title><!--  VENDOR STYLES -->
     <!-- FONT AWESOME-->
     <link rel="stylesheet" href="assets/@fortawesome/fontawesome-free/css/brands.css">
     <link rel="stylesheet" href="assets/@fortawesome/fontawesome-free/css/regular.css">
     <link rel="stylesheet" href="assets/@fortawesome/fontawesome-free/css/solid.css">
     <link rel="stylesheet" href="assets/@fortawesome/fontawesome-free/css/fontawesome.css">

     <!-- SIMPLE LINE ICONS-->
     <link rel="stylesheet" href="assets/simple-line-icons/css/simple-line-icons.css"><!-- ANIMATE.CSS-->
     <link rel="stylesheet" href="assets/animate.css/animate.css"><!-- WHIRL (spinners)-->
     <link rel="stylesheet" href="assets/whirl/dist/whirl.css">

     <!-- Jquery -->
     <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
     <link rel="stylesheet" href="assets/jquery-bootgrid/dist/jquery.bootgrid.css">

     <!-- SELECT2-->
     <link rel="stylesheet" href="assets/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
     <!-- SLIDER CTRL-->
     <link rel="stylesheet" href="assets/select2/dist/css/select2.css">
     <link rel="stylesheet" href="assets/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.css">


     <!-- BOOTSTRAP STYLES -->
     <link rel="stylesheet" href="assets/css/bootstrap.css" id="bscss">

     <!--- APP STYLE -->
     <link rel="stylesheet" href="assets/css/app.css" id="maincss">

     <!-- CUSTOM CSS -->
     <link rel="stylesheet" href="assets/css/style.css" id="maincss">

<style>
.select2-search__field{
  width:660px!important;
}
</style>
</head>
<body>
  <form method="post">
  <div class="row">
    <div class="col-md-4">
        <!-- START card-->
        <div class="card card-default">
           <div class="card-body">
             <?php
print_r(Session::get('user'));
?>
            <!--start gender div  -->
              <div class="form-group gender-div diet" id="gender"><label>Select Gender</label>
                    <select class="form-control gender-option" name="gender" >
                       <option>Select Gender</option>
                       <option  value = "0" >Male</option>
                       <option value="1" >Female</option>
                    </select>
                 </div>
                 <!-- end gender div -->

                 <!-- start activity div -->
                 <div class="form-group activity-div diet" id="activity" style="display:none;"><label>Select Activity</label>
                       <select class="form-control activity-option"  name="activity" >
                          <option>Select Activity</option>
                          @foreach($activites as $activity)
                          <option  value = "{{$activity->id}}">{{$activity->name}}</option>
                          @endforeach
                       </select>
                    </div>
                    <!--  end activity div-->

                    <!-- start meart div -->
                    <div class="form-group meat-div multiple-choice diet" style="display:none;"><label>Select Meat</label>
                          <select class="form-control multiselecopt meat-option" name="meat" multiple >
                             <option >Select Meat</option>
                             @foreach($meats as $meat)
                             <option  value = "{{$meat->id}}">{{$meat->name}}</option>
                             @endforeach
                          </select>
                       </div>
                       <!-- end meat div -->

                       <!-- start veggie div -->
                       <div class="form-group veggies-div multiple-choice diet" style="display:none;"><label>Select Veggies</label>
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
                             <select class="form-control multiselecopt veggie-option" name="veggies" multiple required>
                                <option >Select Multiple Veggies</option>
                                @foreach($veggies as $veggie)
                                <option  value = "{{$veggie->id}}">{{$veggie->name}}</option>
                                @endforeach
                             </select>
                          </div>
                          <!-- end veggie div -->

                          <!-- start product div-->
                          <div class="form-group product-div multiple-choice diet" style="display:none;"><label>Select Products</label>
                                <select class="form-control multiselecopt products-option" name="product" multiple required>
                                   <option >Select Multiple Products</option>
                                   @foreach($products as $product)
                                   <option  value = "{{$product->id}}">{{$product->name}}</option>
                                   @endforeach
                                </select>
                             </div>
                             <!-- end product div -->

                             <!-- start typical day for you div -->
                             <div class="form-group day-div diet" style="display:none;"><label>Select Typical Day For You</label>
                                   <select class="form-control day-option" name="day">
                                      <option >Select Typical Day For You</option>
                                      @foreach($typical_day as $typical_day)
                                      <option  value = "{{$typical_day->id}}">{{$typical_day->name}}</option>
                                      @endforeach
                                   </select>
                                </div>
                                <!-- end typical day for you div -->

                                <!-- start true for you div-->
                                <div class="form-group true-div multiple-choice diet" style="display:none;"><label>Select True For You</label>
                                      <select class="form-control multiselecopt true-option"  name="true_for_you" multiple required>
                                         <option >Select Multiple True For You</option>
                                         @foreach($true_for_you as $true_for)
                                         <option  value = "{{$true_for->id}}">{{$true_for->name}}</option>
                                         @endforeach
                                      </select>
                                   </div>
                                   <!-- end true for you div -->

                                   <!--  start measurement div-->
                                   <div class="measurement-div diet" style="display:none;">
                                     <h2>Measurement</h2>
                                   <button type="button" class="btn btn-primary metric-btn">Metric</button>
                                   <button type="button" class="btn btn-primary imperial-btn">Imperial</button>
                                   <div class="metric-div">
                                   <div class="form-group"><label>Age</label><input class="form-control" type="text" name="age" ></div>
                                   <div class="form-group"><label>Height(CM)</label><input class="form-control" type="text" name="height" ></div>
                                   <div class="form-group"><label>Weight(KG)</label><input class="form-control" type="text" name="weight" ></div>
                                   <div class="form-group"><label>Target Weight(KG)</label><input class="form-control" type="text" name="target_weight" ></div>
                                 </div>
                                   <div class="imperial-div" style="display:none">
                                   <div class="form-group"><label>Age</label><input class="form-control" type="text" name="imperial_age"></div>
                                   <div class="form-group"><label>Feet(ft)</label><input class="form-control" type="text" name="feet"></div>
                                   <div class="form-group"><label>Inch</label><input class="form-control" type="text" name="inch"></div>
                                    <div class="form-group"><label>Weight(lb)</label><input class="form-control" type="text" name="imperial_weight"></div>
                                   <div class="form-group"><label>Target Weight(lb)</label><input class="form-control" type="text" name="imperial_target_weight"></div>
                                 </div>
                               </div>
                                   <!--  thanks div-->
                                   <div class="thanks-div diet" style="display:none;">
                                     <h2>Thanks</h2>
                                   </div>
                    </div>
                    <button class="btn btn-success btn-lg continue-btn" type="submit" style="width:100%; display:none;" >Continue</button>
                 <button class="btn btn-success btn-lg final" type="submit" style="width:100%; display:none;" >Submit</button>
           </div>
        </div><!-- END card-->
     </div>
   </form>

</body>
</html>
<script src="assets/modernizr/modernizr.custom.js"></script><!-- STORAGE API-->
  <script src="assets/js-storage/js.storage.js"></script><!-- SCREENFULL-->
  <script src="assets/screenfull/dist/screenfull.js"></script><!-- i18next-->
  <script src="assets/i18next/i18next.js"></script>
  <script src="assets/i18next-xhr-backend/i18nextXHRBackend.js"></script>
  <script src="assets/jquery/dist/jquery.js"></script>
  <script src="assets/popper.js/dist/umd/popper.js"></script>
  <script src="assets/bootstrap/dist/js/bootstrap.js"></script><!-- PAGE VENDOR SCRIPTS -->

  <script src="assets/bootstrap-filestyle/src/bootstrap-filestyle.js"></script>
  <script src="assets/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
  <script src="assets/select2/dist/js/select2.full.js"></script>

  <!-- end -->

  <!-- APP SCRIPTS -->
   <script src="assets/js/app.js"></script>
   <script>
   jQuery(function($) {

     $(".metric-div").validate({
       rules: {
        age: 'required',
        height: 'required',
        weight: {
           required: true,
           maxlength: 255,
        },
     },
     });

   });

   $(document).ready(function() {
     // var last_div_id ="";
     //
     // last_div_id = "";
     // if(last_div_id!=""){
     //   $('.diet').hide();
     //   $(last_div_id).show();
     // }


        $('.multiselecopt').change(function() {
               $('.continue-btn').show();
           });
           // get gender div value
           $('.gender-option').on( "change",function() {
               var id = $(this).parent('div').attr('id');
               var gender_val = $(this).val();
               var dataString = 'gender=' + gender_val;
               var show_div = '.activity-div';
               var hide_div = '.gender-div';
              runAjax(dataString, show_div, hide_div,id);
           });
           // get activity value
           $('.activity-option').on( "change",function() {
               var id = $(this).parent('div').attr('id');
               var activity_val = $(this).val();
               var gender_val = $("select[name=gender]").val();
               var dataString = 'gender=' + gender_val + '&activity=' + activity_val;
               var show_div = '.meat-div';
               var hide_div = '.activity-div';
               runAjax(dataString, show_div, hide_div,id);
           });
           // get meat value
           $('.meat-option').on( "change",function() {
               var meat_val = $(this).val();
               var gender_val = $("select[name=gender]").val();
               var activity_val = $("select[name=activity]").val();
               var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val;

               $('.continue-btn').one( "click",function() {
                   var show_div = '.veggies-div';
                   var hide_div = '.meat-div';
                   runAjax(dataString, show_div, hide_div);
               });
           });
           // get veggie value
           $('.veggie-option').on( "change",function() {
               var veggie_val = $(this).val();
               var gender_val = $("select[name=gender]").val();
               var activity_val = $("select[name=activity]").val();
               var meat_val = $("select[name=meat]").val();
               var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val;

               $('.continue-btn').one( "click",function() {
                   var show_div = '.product-div';
                   var hide_div = '.veggies-div';
                   runAjax(dataString, show_div, hide_div);
                 });
             });
           // get product value
           $('.products-option').on( "change",function() {
               var product_val = $(this).val();
               var gender_val = $("select[name=gender]").val();
               var activity_val = $("select[name=activity]").val();
               var meat_val = $("select[name=meat]").val();
               var veggie_val = $("select[name=veggies]").val();
               var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val;

               $('.continue-btn').one( "click",function() {
                   var show_div = '.day-div';
                   var hide_div = '.product-div';
                   $('.continue-btn').hide();
                   runAjax(dataString,show_div, hide_div);
               });
             });
           // get day value
           $('.day-option').change(function() {
               var day_val = $(this).val();
               var gender_val = $("select[name=gender]").val();
               var activity_val = $("select[name=activity]").val();
               var meat_val = $("select[name=meat]").val();
               var veggie_val = $("select[name=veggies]").val();
               var product_val = $("select[name=product]").val();
               var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val + '&day=' + day_val;
               var show_div = '.true-div';
               var hide_div = '.day-div';
               runAjax(dataString, show_div, hide_div);
           });
           $('.true-option').on( "change",function() {
               var true_val = $(this).val();
               var gender_val = $("select[name=gender]").val();
               var activity_val = $("select[name=activity]").val();
               var meat_val = $("select[name=meat]").val();
               var veggie_val = $("select[name=veggies]").val();
               var product_val = $("select[name=product]").val();
               var day_val = $("select[name=day]").val();
               var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val + '&day=' + day_val + '&true=' + true_val;
               $('.continue-btn').one( "click",function() {
                   var show_div = '.measurement-div';
                   var hide_div = '.true-div';
                   runAjax(dataString, show_div, hide_div);
                    $('.continue-btn').hide();
                    $('.final').show();

               });
           });
            // get metric value
           $('.metric-btn').click(function() {
              $('.metric-div').show();
               $('.imperial-div').hide();
               $('.final').click(function() {
                 var gender_val = $("select[name=gender]").val();
                 var activity_val = $("select[name=activity]").val();
                 var meat_val = $("select[name=meat]").val();
                 var veggie_val = $("select[name=veggies]").val();
                 var product_val = $("select[name=product]").val();
                 var day_val = $("select[name=day]").val();
                 var true_val = $("select[name=true_for_you]").val();
                 var metric_age_val = $("input[name=age]").val();
                 var metric_height_val = $("input[name=height]").val();
                 var metric_weight_val = $("input[name=weight]").val();
                 var metric_target_weight_val = $("input[name=target_weight]").val();
                 var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val + '&day=' + day_val + '&true=' + true_val + '&metric_age_val=' + metric_age_val + '&metric_height_val=' + metric_height_val + '&metric_weight_val=' + metric_weight_val + '&metric_target_weight_val=' + metric_target_weight_val;
                  var show_div = '.thanks-div';
                  var hide_div = '.measurement-div';
           //          $(".metric-div").validate({
           //      rules: {
           //       age: 'required',
           //       height: 'required',
           //       weight: {
           //          required: true,
           //          maxlength: 255,
           //       },
           //    },
           //    submitHandler: function (div) { // for demo
           //     alert('valid form submitted'); // for demo
           //     return false; // for demo
           // }
           // });

               runAjax(dataString, show_div, hide_div);
               $('.final').hide();
               // alert(dataString);
                });
           });
           $('.imperial-btn').click(function() {
              $('.imperial-div').show();
               $('.metric-div').hide();

               $('.final').click(function() {
                 var gender_val = $("select[name=gender]").val();
                 var activity_val = $("select[name=activity]").val();
                 var meat_val = $("select[name=meat]").val();
                 var veggie_val = $("select[name=veggies]").val();
                 var product_val = $("select[name=product]").val();
                 var day_val = $("select[name=day]").val();
                 var true_val = $("select[name=true_for_you]").val();
                 var imperial_age_val = $("input[name=imperial_age]").val();
                 var imperial_feet_val = $("input[name=feet]").val();
                 var imperial_inch_val = $("input[name=inch]").val();
                 var imperial_weight_val = $("input[name=imperial_weight]").val();
                 var imperial_target_weight_val = $("input[name=imperial_target_weight]").val();
                 var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val + '&day=' + day_val + '&true=' + true_val + '&imperial_age=' + imperial_age_val + '&imperial_feet=' + imperial_feet_val + '&imperial_inch=' + imperial_inch_val + '&imperial_weight=' + imperial_weight_val + '&imperial_target_weight=' + imperial_target_weight_val;
                 var show_div = '.thanks-div';
                 var hide_div = '.measurement-div';
                 runAjax(dataString, show_div, hide_div);
                 $('.final').hide();
                 // alert(show_div);
               });
             });


           function runAjax(data1, show_div, hide_div,id) {
                event.preventDefault();
                $.ajax({
                   type:'POST',
                   url:'{{URL::route('create_user_information')}}'+'?_token='+'{{ csrf_token() }}'+'&dc='+id+'&last_div='+show_div,
                   data: data1,
                   success: function(data) {
                       $(hide_div).hide();
                       $(show_div).show();
                   }

               });

            }
  });





</script>
