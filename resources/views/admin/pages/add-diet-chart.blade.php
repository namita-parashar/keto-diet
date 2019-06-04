@extends('admin/layout/main') @section('content')
<section class="section-container">
        <!-- Page content-->
        <div class="content-wrapper">
           <div class="content-heading">
              <div>Add User Diet</div><!-- START Language list-->
           </div>
           <form action = "{{route('create_diet')}}" method="post">
             {{csrf_field()}}
             <input type="hidden" value="{{$user_id}}" name="user_id">
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
           <div class="row">
             <div class="col-md-8">
                 <!-- START card-->
                 <div class="card card-default">
                    <div class="card-body">
                      <div class="form-group"><label>Recipe</label>
                        <select class="form-control" id="select2-1" name="recipe">
                          <option>Select  Recipe Name</option>
                          @foreach($recipes as $recipe)
                          <option value ="{{$recipe->id}}">{{$recipe->name}}</option>
                          @endforeach
                        </select>
                         </div>
                         <div class="form-group"><label>Type</label>
                            <select class="form-control" id="select2-1" name="type">
                               <option></option>
                               <option value="1">Breakfast</option>
                               <option value="2">Brunch</option>
                               <option value="3">Lunch</option>
                               <option value="4">Dinner</option>
                            </select>
                         </div>
                         <div class="form-group"><label>Week</label><input class="form-control" type="text" name="week"></div>
                         <div class="form-group"><label>Day</label><input class="form-control" type="text" name="day"></div>

                             </div>
                          <button class="btn btn-success btn-lg" type="submit" style="width:100%;">Add</button>
                    </div>
                 </div><!-- END card-->
              </div>
            </form>

           </div>
        </div>
     </section>

@endsection
