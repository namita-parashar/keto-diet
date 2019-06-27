<html>
<head>
</head>
<body>
  <table>
    <tr>
      <th>Name</th>
      <th>Quantity</th>
      <th>Metric</th>
    </tr>
@foreach($result as $recipe_products )
<tr>
  <td>{{$recipe_products->name}}</td>
  <td>{{$recipe_products->pivot->quantity}}</td>
  <td>
    @if($recipe_products->pivot->hide_metric ==1)
    {{$recipe_products->pivot->metric}}
    @endif

  </td>
</tr>
@endforeach
</table>

</body>
</html>
