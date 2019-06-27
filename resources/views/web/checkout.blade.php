<!doctype html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{url('css/plugins.css')}}">
        <link rel="stylesheet" href="{{url('css/main.css')}}">
        <?php global $template ; if ($template['theme']) { ?><link id="theme-link" rel="stylesheet" href="css/themes/<?php global $template ; echo $template['theme']; ?>.css"><?php } ?>
        <link rel="stylesheet" href="{{url('css/themes.css')}}">
        <script src="{{url('js/vendor/modernizr-respond.min.js')}}"></script>

        <style>
  @media only screen and (min-width: 770px) {
    .index {
       max-height: 50px;
    }
    .bd{
      margin-top: 10%;
    }
    }

  @media only screen and (max-width: 640px) {
    .index {
       max-height: 70px;
    }}

.app-images {
    width: 130px;
}
#myButton {
    text-transform: uppercase;
}
.bd.app .btn-group a {
    display: block;
    margin: 5px 0;
}
.bd.app #myButton {
    width: 100%;
}
.bd.app .btn-group #myButton {
    letter-spacing: 1px;
}
.bd.app .btn-group {
    width: 100%;
    display: inline-block;
}
@media screen and (min-width:320px)and (max-width:360px){
.bd.app h1 {
    font-size: 27px !important;
}
.bd.app #myButton {
    width: 100%;
}}
@media screen and (min-width:320px)and (max-width:400px){
	div#hide-body {
    position: absolute;
    width: 100%;
  top: 104px;
}}
@media screen and (min-width:401px)and (max-width:767px){
	div#hide-body {
    position: absolute;
    width: 100%;
  top: 194px;
}}
/*@media screen and (min-width:320px)and (max-width:399px) {
div #app-hide {
    top: -32em;position: relative;
    right: 0;left: -17em;
}}*/
/*@media screen and (min-width:400px)and (max-width:499px) {
div #app-hide {
    top: -500px;position: relative;
    right: 0;left: -162px;
}}*/
@media screen and (min-width:320px)and (max-width:767px){
#app-hide {
       top: 28%;
    position: absolute;
    right: 0;
    left: 9em;
}}
body {
    overflow-x: hidden;
}

/*@import url(https://fonts.googleapis.com/css?family=RobotoDraft:500);
*/
/**
{
  font-family: 'RobotoDraft', sans-serif;
  font-size: 15px;
  padding: 20px;
}*/

/*.material_block
{
  width: 580px;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0,0,0,.4);
  margin: auto;
}*/

.spinner
{
  -webkit-animation: rotation 1.35s linear infinite;
  animation: rotation 1.35s linear infinite;

}

@-webkit-keyframes rotation
{
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(270deg);
    transform: rotate(270deg);
  }
}

@keyframes rotation
{
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(270deg);
    transform: rotate(270deg);
  }
}

.circle
{
  stroke-dasharray: 180;
  stroke-dashoffset: 0;
  -webkit-transform-origin: center;
  -ms-transform-origin: center;
  transform-origin: center;
  -webkit-animation: turn 1.35s ease-in-out infinite;
  animation: turn 1.35s ease-in-out infinite;
}

@-webkit-keyframes turn
{
  0% {
    stroke-dashoffset: 180;
  }

  50% {
    stroke-dashoffset: 45;
    -webkit-transform: rotate(135deg);
    transform: rotate(135deg);
  }

  100% {
    stroke-dashoffset: 180;
    -webkit-transform: rotate(450deg);
    transform: rotate(450deg);
  }
}

@keyframes turn
{
  0% {
    stroke-dashoffset: 180;
  }

  50% {
    stroke-dashoffset: 45;
    -webkit-transform: rotate(135deg);
    transform: rotate(135deg);
  }

  100% {
    stroke-dashoffset: 180;
    -webkit-transform: rotate(450deg);
    transform: rotate(450deg);
  }
}

svg:nth-child(1){stroke:#ec2828;}
</style>
</head>
<body style="background-color: #ffffff;">
  <div style="text-align: center;">
  <div class="col-md-12 bd app" style="text-align: center;" id="hide-body">
  <img src="{{url('assets/images/ic_payment.png')}}" alt="Lic_payment" class="app-images">
        <h1 style="font-weight:600;font-size: 36px;letter-spacing: 2px;"><font color="#8b8b8b">Select Your</br>Payment Method</font></h1>


  <div class="btn-group">

<a href="{{route('paypal',['user_id'=>$user_id])}}" id="check"  onclick="toggle_visibility('check');">
<span class="myButton" id="myButton" style=" background: #0070ba; border-radius: 4px; border: 1px solid #0070ba; display: inline-block; cursor: pointer; color: rgb(255, 255, 255); font-family: Arial; font-size: 17px; font-weight: bold; padding: 15px 13px; text-decoration: none; text-shadow: rgb(91, 138, 60) 0px 1px 0px;">Pay Via Card</span>

</a>
<a href="{{route('paypalcash',['user_id'=>$user_id])}}" id="check"  onclick="toggle_visibility('check');">
<span class="myButton" id="myButton" style=" background: #0070ba; border-radius: 4px; border: 1px solid #0070ba; display: inline-block; cursor: pointer; color: rgb(255, 255, 255); font-family: Arial; font-size: 17px; font-weight: bold; padding: 15px 13px; text-decoration: none; text-shadow: rgb(91, 138, 60) 0px 1px 0px;">Pay Via Cash</span>

</a>

  <!-- <a href="" id="cod" onclick="toggle_cod('cod')">
<span class="myButton" id="myButton" style=" background: #0caf37; border-radius: 4px; display: inline-block; cursor: pointer; color: rgb(255, 255, 255); font-family: Arial; font-size: 19px; font-weight: bold; padding: 15px 36px; text-decoration: none;  margin-top: 10px;border: 1px solid #0caf37;">Cash on Delivery</span>
</a> -->
</div>
</div>
   <!-- <img src="{{url('uploads/user/paypal.gif')}}" alt="loader" id="app-hide" style="display: none;"> -->
<div >
  <svg class="spinner" id="app-hide" style="display: none; margin-top: 20%;"  width="87px" height="86px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>

</div>
</div>


<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var i = document.getElementById('app-hide');
       i.style.display = 'inline-block';
       var e = document.getElementById('hide-body');
       e.style.display = 'none';

    }

    function toggle_cod(id){
      var i = document.getElementById('app-hide');
       i.style.display = 'inline-block';
       var e = document.getElementById('hide-body');
       e.style.display = 'none';
    }
//-->
</script>

</body>
</html>
