<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 33.33%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
</head>
<body>

<h2>Your Profile summary</h2>
<div class="row">
  <div class="column">
  BMI : {{Session::get('user.bmi')}} Your BMI : {{Session::get('user.bmi_type')}}
  </div>
  <div class="column">
    Calories Recommend : {{Session::get('user.calories_recommend_to')}} - {{Session::get('user.calories_recommend_from')}}Calories
  </div>
  <div class="column">
    Water Recommend : {{Session::get('user.water_recommend')}}L
  </div>
  <div class="column">
  Metabolic Age : 24
  </div>
  <div class="column">
    Achievable Weight : 50Kilograms
  </div>
  <div class="column">
    Ketogenic Diet :75% Fats
  </div>
</div>
<a href="{{route('show_email')}}">
  <button type="button" class="btn btn-primary">Get It Now</button>
</a>
</body>
</html>
