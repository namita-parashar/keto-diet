@extends('admin/layout/main') @section('content')
<section class="section-container">
        <!-- Page content-->
        <div class="content-wrapper">
           <div class="content-heading">
              <div>Update Activity</div><!-- START Language list-->
           </div>
           <ol class="breadcrumb">
                    <li>
                       <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li>
                       <a href="{{route('show_activity')}}">Activity</a>
                    </li>
                    <li class="active">
                      <strong>  Edit Activity </strong>
                    </li>
           </ol>
           <form action = "{{route('update_activity',$activity->id)}}" method="post">
             {{csrf_field()}}
           <div class="row">
             <div class="col-md-8">
                 <!-- START card-->
                 <div class="card card-default">
                    <div class="card-body">
                          <div class="form-group"><label>Name</label><input class="form-control" type="text" placeholder="Enter Name" name="name" value="{{$activity->name}}"></div>
                          <div class="form-group"><label>Value</label><input class="form-control" type="text" placeholder="Enter value" name="value" Value="{{$activity->value}}"></div>
                          <div class="form-group"><label>Type</label>
                             <select class="form-control" id="select2-1" name="type">
                                <option></option>
                                <option {{ $activity->type == '1' ? 'selected':'' }} value = "1">Activity</option>
                                <option {{ $activity->type == '2' ? 'selected':'' }} value="2">Typical Day For You</option>
                                <option {{ $activity->type == '3' ? 'selected':'' }} value="3">True For You</option>
                             </select>
                          </div>

                             </div>
                          <button class="btn btn-success btn-lg" type="submit" style="width:100%;">Update</button>
                    </div>
                 </div><!-- END card-->
              </div>
            </form>

           </div>
        </div>
     </section>

@endsection
