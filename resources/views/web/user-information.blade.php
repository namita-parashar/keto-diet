<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Bootstrap Admin App">
    <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Angle - Bootstrap Admin Template</title>
    <!--  VENDOR STYLES -->
    <!-- FONT AWESOME-->
    <link rel="stylesheet" href="assets/@fortawesome/fontawesome-free/css/brands.css">
    <link rel="stylesheet" href="assets/@fortawesome/fontawesome-free/css/regular.css">
    <link rel="stylesheet" href="assets/@fortawesome/fontawesome-free/css/solid.css">
    <link rel="stylesheet" href="assets/@fortawesome/fontawesome-free/css/fontawesome.css">
    <!-- SIMPLE LINE ICONS-->
    <link rel="stylesheet" href="assets/simple-line-icons/css/simple-line-icons.css">
    <!-- ANIMATE.CSS-->
    <link rel="stylesheet" href="assets/animate.css/animate.css">
    <!-- WHIRL (spinners)-->
    <link rel="stylesheet" href="assets/whirl/dist/whirl.css">
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
        .select2-search__field {
            width: 660px!important;
        }
    </style>
    <!-- Jquery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <!-- START card-->
                <div class="card card-default">
                    <div class="card-body">
                        <?php print_r(Session::get('user')); ?>
                            <input type="hidden" name="new_url" value="{{route('show_user_result')}}">
                            <input type="hidden" name="last_div" value="{{Session::get('user.last_div')}}">
                            <input type="hidden" name="url" value="{{URL::route('create_user_information')}}/?_token={{ csrf_token() }}">
                            <!--start gender div  -->

                            <div class="form-group gender-div diet" id="gender">
                                <label>Select Gender</label>
                                <select class="form-control gender-option" name="gender">
                                    <option>Select Gender</option>
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                            </div>
                            <!-- end gender div -->

                            <!-- start activity div -->
                            <div class="form-group activity-div diet" id="activity" style="display:none;">
                                <label>Select Activity</label>
                                <select class="form-control activity-option" name="activity">
                                    <option>Select Activity</option>
                                    @foreach($activites as $activity)
                                    <option value="{{$activity->id}}">{{$activity->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--  end activity div-->

                            <!-- start meart div -->
                            <div class="form-group meat-div multiple-choice diet" style="display:none;">
                                <label>Select Meat</label>
                                <select class="form-control multiselecopt meat-option" name="meat" multiple>
                                    <option>Select Meat</option>
                                    @foreach($meats as $meat)
                                    <option value="{{$meat->id}}">{{$meat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- end meat div -->

                            <!-- start veggie div -->
                            <div class="form-group veggies-div multiple-choice diet" style="display:none;">
                                <label>Select Veggies</label>
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
                                    <option>Select Multiple Veggies</option>
                                    @foreach($veggies as $veggie)
                                    <option value="{{$veggie->id}}">{{$veggie->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- end veggie div -->

                            <!-- start product div-->
                            <div class="form-group product-div multiple-choice diet" style="display:none;">
                                <label>Select Products</label>
                                <select class="form-control multiselecopt products-option" name="product" multiple required>
                                    <option>Select Multiple Products</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- end product div -->

                            <!-- start typical day for you div -->
                            <div class="form-group day-div diet" style="display:none;">
                                <label>Select Typical Day For You</label>
                                <select class="form-control day-option" name="day">
                                    <option>Select Typical Day For You</option>
                                    @foreach($typical_day as $typical_day)
                                    <option value="{{$typical_day->id}}">{{$typical_day->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- end typical day for you div -->

                            <!-- start true for you div-->
                            <div class="form-group true-div multiple-choice diet" style="display:none;">
                                <label>Select True For You</label>
                                <select class="form-control multiselecopt true-option" name="true_for_you" multiple required>
                                    <option>Select Multiple True For You</option>
                                    @foreach($true_for_you as $true_for)
                                    <option value="{{$true_for->id}}">{{$true_for->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- end true for you div -->

                            <!--  start measurement div-->
                            <div class="measurement-div diet" style="display:none;">
                                <h2>Measurement</h2>
                                <p id="head"></p>
                                <button type="button" class="btn btn-primary metric-btn">Metric</button>
                                <button type="button" class="btn btn-primary imperial-btn">Imperial</button>
                                <div class="metric-div">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control" type="text" name="age" id="age" required>
                                    </div>
                                    <p id="p2"></p>
                                    <div class="form-group">
                                        <label>Height(CM)</label>
                                        <input class="form-control" type="text" name="height" id="height" required>
                                    </div>
                                    <p id="p3"></p>
                                    <div class="form-group">
                                        <label>Weight(KG)</label>
                                        <input class="form-control" type="text" name="weight" id="weight" required>
                                    </div>
                                    <p id="p4"></p>
                                    <div class="form-group">
                                        <label>Target Weight(KG)</label>
                                        <input class="form-control" type="text" id="target_weight" name="target_weight">
                                    </div>
                                    <p id="p5"></p>
                                </div>
                                <div class="imperial-div" style="display:none">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control" type="text" name="imperial_age" id="imperial_age">
                                    </div>
                                    <p id="p6"></p>
                                    <div class="form-group">
                                        <label>Feet(ft)</label>
                                        <input class="form-control" type="text" name="feet" id="imperial_feet">
                                    </div>
                                    <p id="p7"></p>
                                    <div class="form-group">
                                        <label>Inch</label>
                                        <input class="form-control" type="text" name="inch" id="imperial_inch">
                                    </div>
                                    <p id="p8"></p>
                                    <div class="form-group">
                                        <label>Weight(lb)</label>
                                        <input class="form-control" type="text" name="imperial_weight" id="imperial_weight">
                                    </div>
                                    <p id="p9"></p>
                                    <div class="form-group">
                                        <label>Target Weight(lb)</label>
                                        <input class="form-control" type="text" name="imperial_target_weight" id="imperial_target_weight">
                                    </div>
                                    <p id="p10"></p>
                                </div>
                            </div>
                            <!--  thanks div-->
                            <div class="thanks-div diet" style="display:none;">
                              <input type="hidden" value="{{Session::get('user.bmi')}}">
                                <h2 class="values_user">Thanks</h2>
                            </div>
                    </div>
                    <button class="btn btn-success btn-lg continue-btn" type="submit" style="width:100%; display:none;">Continue</button>

                    <!-- <a href="{{route('show_user_result')}}" target="_blank"> -->
                      <button class="btn btn-success btn-lg final" type="submit" style="width:100%; display:none;">Submit</button>
                    <!-- </a> -->
                </div>
            </div>
            <!-- END card-->
        </div>
    </form>

</body>

</html>
<script src="assets/modernizr/modernizr.custom.js"></script>
<!-- STORAGE API-->
<script src="assets/js-storage/js.storage.js"></script>
<!-- SCREENFULL-->
<script src="assets/screenfull/dist/screenfull.js"></script>
<!-- i18next-->
<script src="assets/i18next/i18next.js"></script>
<script src="assets/i18next-xhr-backend/i18nextXHRBackend.js"></script>
<script src="assets/jquery/dist/jquery.js"></script>
<script src="assets/popper.js/dist/umd/popper.js"></script>
<script src="assets/bootstrap/dist/js/bootstrap.js"></script>
<!-- PAGE VENDOR SCRIPTS -->
<script src="assets/bootstrap-filestyle/src/bootstrap-filestyle.js"></script>
<script src="assets/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
<script src="assets/select2/dist/js/select2.full.js"></script>
<!-- end -->
<!-- APP SCRIPTS -->
<script src="assets/js/app.js"></script>
<script src="assets/js/my.js"></script>
