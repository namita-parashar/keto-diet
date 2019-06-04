@extends('admin/layout/main') @section('content')
<section class="section-container">
        <!-- Page content-->
        <div class="content-wrapper">
           <div class="content-heading">
              <div>Creating New Product</div><!-- START Language list-->
           </div>
           <ol class="breadcrumb">
                    <li>
                       <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li>
                       <a href="{{route('show_products')}}">Products</a>
                    </li>
                    <li class="active">
                  <strong>  Add Product </strong>
                    </li>
           </ol>
           <form action = "{{route('add_product')}}" method="post">
             {{csrf_field()}}
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
                          <div class="form-group"><label>Name</label><input class="form-control" type="text" placeholder="Enter Name" name="name"></div>
                          <div class="form-group"><label>Calories</label><input class="form-control" type="text" placeholder="Enter calories" name="calories"></div>
                          <div class="form-group"><label>Type</label>
                             <select class="form-control" id="select2-1" name="type">
                                <option></option>
                                <option value="1">Meat</option>
                                <option value="2">Veggie</option>
                                <option value="3">Product</option>
                             </select>
                          </div>
                          <div class="form-group row">
                              <div class="col-xl-10">
                                 <div class="checkbox c-checkbox"><label><input type="checkbox" name="is_important"><span class="fa fa-check"></span> Is Important</label></div>
                              </div>
                           </div>

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
