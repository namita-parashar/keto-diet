@extends('admin/layout/main') @section('content')
<section class="section-container">
         <!-- Page content-->
         <div class="content-wrapper">
            <div class="content-heading">
               <div>Activity</div><!-- START Language list-->
            </div>
            <ol class="breadcrumb">
                     <li>
                        <a href="{{route('dashboard')}}">Dashboard</a>
                     </li>
                     <li class="active">
                   <strong>  Activity </strong>
                     </li>
            </ol>
            <div class="row">
              <div class="add col-sm-12 " style="margin-top: -5px;">
                <form action="{{route('index_activity')}}" method="post">
                  <a href="{{route('index_activity')}}"><button class="btn btn-success" type="button" ><i class="fa fa-plus" aria-hidden="true"></i> Add Activity</button></a>
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
                                 <th>Value</th>
                                 <th>Type</th>
                              </tr>
                           </thead>
                           <tbody>
                             @foreach($activites as $activites_data)
                           <tr>
                              <td>{{$activites_data->name}}</td>
                              <td>{{$activites_data->value}}</td>
                              <td><span class="label label-primary">
                                @if($activites_data->type == 1)
                                Activity
                                @elseif($activites_data->type == 2)
                                Typical day
                                @elseif($activites_data->type == 3)
                                True for you
                                @endif
                              </span></td>
                              <td class="text-center">
                        <div class="btn-group btn-group-xs">
                            <a href="{{route('update_index_activity',$activites_data->id)}}" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
                            <a id="{{$activites_data->id}}" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger delete" ><i class="fa fa-times"></i></a>
                        </div>
                    </td>
                           </tr>
                           @endforeach

                           </tbody>
                           <tfoot >
                           <tr class="test">
                              <td colspan="12">
                                 <ul class="pagination pull-right ">{{$activites->appends(Request::except('page'))->links()}}</ul>
                              </td>
                           </tr>
                        </tfoot>
                        </table>
                        @if(!count($activites))
                    <div style="padding: 50px; font-size: 20px; text-align: center;padding-top:1px; font-family: sans-serif;">No results found</div>
                    @endif
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
              if(confirm("Are you sure you want to delete this Activity? It will delete immediately when you click on OK."))
              {
                  $.get("{{URL::route('delete_activity')}}?id="+del_id,function(data){
                      $(element).closest('label').remove();
                  });
                  window.location.reload();
                  return false;
              }
          });
      });
      </script>
@endsection
