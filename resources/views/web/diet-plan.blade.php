<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
.jumbotron {
  text-align: center;
  padding: 5px;
}

#mealSchedule {
  display: block;
  width: 90%;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
  <div class="jumbotron">
  <div id="mealSchedule" class="section well">
    <a href="{{route('grocery-list',[$order->user_id,$week_url])}}">
    <button type="button" class="btn btn-primary btn-sm" style="float:right;margin-top:20px;">Download Grocery List for Week {{$week_url}}</button>
</a>

        <h4>Total Week : {{$week}}</h4>
        <form action="{{route('diet-plan',[$order->uuid])}}" method="get">
        <div class="form-group col-sm-4">
        <select class="form-control week"  name="week" onchange="this.form.submit()">
          <option >Select  Week</option>
          @for($i=1 ; $i<=$week ;$i++)
          <option class="weeks" value="{{$i}}">Week {{$i}}</option>
          @endfor
        </select>
      </div>
    </form>
    <table id="schedTable" class="table verticalTable">
      <tr>
        <th>Days</th>
        <th>Breakfast</th>
        <th>Brunch</th>
        <th>Lunch</th>
        <th>Dinner</th>
      </tr>

    @foreach($diets as $diet)

        @foreach($diet as $key=>$die)

        <tr>
        <td>{{$key}}</td>
        <td>
        @if(isset($die['1']))
        <a href="{{route('diet-plan-detail',$die['1']['id'])}}">{{$die['1']['name']}}</a>
        @else
        --
        @endif
        </td>
        <td>
        @if(isset($die['2']))
      <a href="{{route('diet-plan-detail',$die['2']['id'])}}">  {{$die['2']['name']}}</a>
        @else
        --
        @endif
        </td>
        <td>
        @if(isset($die['3']))
      <a href="{{route('diet-plan-detail',$die['3']['id'])}}">{{$die['3']['name']}}</a>
        @else
        --
        @endif
        </td>
        <td>
        @if(isset($die['4']))
        <a href="{{route('diet-plan-detail',$die['4']['id'])}}">{{$die['4']['name']}}</a>
        @else
        --
        @endif
        </td>
        </tr>
        @endforeach
       @endforeach
    </table>
    <div id="mealOptions"></div>
  </div>
</div>
</body>

</html>
