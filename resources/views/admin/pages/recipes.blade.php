@extends('admin/layout/main') @section('content')
<section class="section-container">
   <!-- Page content-->
   <div class="content-wrapper">
      <div class="content-heading">
         <div>Recipe</div>
         <!-- START Language list-->
      </div>
      <ol class="breadcrumb">
         <li>
            <a href="{{route('dashboard')}}">Dashboard</a>
         </li>
         <li class="active">
            <strong>Recipe</strong>
         </li>
      </ol>
      <div class="row">
         <div class="add col-sm-12 " style="margin-top: -5px;">
            <form action="{{route('add_index_recipe')}}" method="post">
               <a href="{{route('add_index_recipe')}}"><button class="btn btn-success" type="button" ><i class="fa fa-plus" aria-hidden="true"></i> Add Recipe</button></a>
            </form>
         </div>
         <div class="col-lg-12">
            <div class="panel panel-default">
               <div class="panel-body">
                  <div class="table-responsive">
                     <table class="table table-striped my-4 w-100" >
                        <thead>
                           <tr>
                              <th>Name</th>
                              <th>Time</th>
                              <th>Type</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($recipes as $recipe)
                           <tr>
                              <td>{{$recipe->name}}</td>
                              <td>{{$recipe->time}}</td>
                              <td><span class="label label-primary">
                                 @if($recipe->type ==1)
                                 Breakfast
                                 @elseif($recipe->type ==2)
                                 Brunch
                                 @elseif($recipe->type ==3)
                                 Lunch
                                 @else
                                 Dinner
                                 @endif
                                 </span>
                              </td>
                              <td class="text-center">
                                 <div class="btn-group btn-group-xs">
                                    <a href="{{route('show_recipe_detail',$recipe->id)}}" data-toggle="tooltip" title="View" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('update_index_recipe',$recipe->id)}}" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                    <a id="{{$recipe->id}}" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger delete" ><i class="fa fa-times"></i></a>
                                 </div>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                        <tfoot >
                           <tr class="test">
                              <td colspan="12">
                                 <ul class="pagination pull-right "></ul>
                              </td>
                           </tr>
                        </tfoot>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
   $(function() {
       $(".delete").click(function(){
           var element = $(this);
           var del_id = element.attr("id");
           if(confirm("Are you sure you want to delete this recipe? It will delete immediately when you click on OK."))
           {
               $.get("{{URL::route('delete_recipe')}}?id="+del_id,function(data){
                   $(element).closest('label').remove();
               });
               window.location.reload();
               return false;
           }
       });
   });
</script>
@endsection
