<html>
<head>
<style>
img {
  border: 2px solid #504214;
  align: middle;
  width: 60%;
}
h1 {
  color: #A29F3B ;
  text-align: center;
  font-size: 4em;
  background-color: #246161;
  padding: 10px;
}
h2 {
  color: #A29F3B ;
  text-align: left;
  font-size: 2em;
}
h3 {
  color: #797618 ;
  text-align: left;
  font-size: 1.5em;
}
h1, h2, h3 {
  font-family: georgia;
}
table {
    color: #246161;
}
th, td {
  padding-left: 5px;
  text-align: left;

}

.ing {
    text-transform: capitalize;
}
#teaser {
  padding-left: 30%;
}

p {
  padding: 10px;
  margin: 5px;
  color: #246161;
}
ol li {
    color: #246161;
  padding: 5px;
}

body {
  background-color: white;
  width:75%;
  padding-left:12%;
  font-family: helvetica;
}

a {
  color: #793C18 ;
  text-decoration: none;
}
</style>
</head>
<body>
<p>{{$recipe->name}}</p>
<p>
  @if($recipe->type ==1)
  Breakfast
  @elseif($recipe->type == 2)
  Brunch
  @elseif($recipe->type ==3)
  Lunch
  @elseif($recipe->type ==4)
  Dinner
  @endif
</p>
<p>{{$recipe->time}}</p>
<p>{{$calories_count}}kcal</p>
<p>@if(!empty($recipe->video))
<iframe width="100" height="100" src="//www.youtube.com/embed/{{$recipe->video}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
@endif</p>
<h2>Ingredients</h2>

<table>
  <tr>
    <th>Qty</th>
  </tr>
  @foreach($recipe->recipeIngredient as $recipe_products)
  @if($recipe_products->is_important ==1 )
  <tr style="color:blue;">
    <td>{{$recipe_products->pivot->quantity}}</td>
    <td>{{$recipe_products->pivot->metric}}</td>
    <td class="ing">{{$recipe_products->name}}</td>
  </tr>
  @else
  <tr>
    <td>{{$recipe_products->pivot->quantity}}</td>
    <td>{{$recipe_products->pivot->metric}}</td>
    <td class="ing">{{$recipe_products->name}}</td>
  </tr>
  @endif
  @endforeach
<p>*All blue -colored products are essential.</p>

</table>

<h2>Steps</h2>
<ol>
@foreach($recipe->recipePreparation as $recipe_step)
<li>
  {{$recipe_step->step}}
  @if(!empty($recipe_step->image))
  <div style="width:171px;height: 110px";>  <img src="{{url('storage/'.$recipe_step->image) }}" width="50" height="50"></div>
  @endif

</li>
  @endforeach
</ol>





</body>
</html>
