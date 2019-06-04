@extends('admin/layout/main') @section('content')
<section class="section-container">
         <!-- Page content-->
         <div class="content-wrapper">
            <div class="content-heading">
               <div>Users</div><!-- START Language list-->
            </div>
            <ol class="breadcrumb">
                     <li>
                        <a href="{{route('dashboard')}}">Dashboard</a>
                     </li>
                     <li class="active">
                   <strong>  Users </strong>
                     </li>
            </ol>
            <div class="row">
              <div class="col-lg-12">
                  <div class="panel panel-default">
                     <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table table-striped my-4 w-100" >
                           <thead>
                              <tr>
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Gender</th>
                              </tr>
                           </thead>
                           <tbody>
                             @foreach($users as $users_data)
                           <tr>
                              <td>{{$users_data->user->name}}</td>
                              <td>{{$users_data->user->email}}</td>
                              <td>
                                @if($users_data->user->gender == 1)
                                Female
                                @else
                                Male
                                @endif
                              </td>
                            <td class="text-center">
                        <div class="btn-group btn-group-xs">
                            <a href="{{route('show_user_detail',$users_data->id)}}" data-toggle="tooltip" title="View" class="btn btn-default"><i class="fa fa-eye"></i></a>
                            <!-- <a id="{{$users_data->id}}" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger delete" ><i class="fa fa-times"></i></a> -->
                        </div>
                    </td>
                           </tr>
                           @endforeach

                           </tbody>
                           <tfoot >
                           <tr class="test">
                              <td colspan="12">
                                 <ul class="pagination pull-right ">{{$users->appends(Request::except('page'))->links()}}</ul>
                              </td>
                           </tr>
                        </tfoot>
                        </table>
                        @if(!count($users))
                    <div style="padding: 50px; font-size: 20px; text-align: center;padding-top:1px; font-family: sans-serif;">No results found</div>
                    @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

@endsection
