@extends('admin/layout/main') @section('content')
<section class="section-container">
        <!-- Page content-->
        <div class="content-wrapper">
           <div class="content-heading">
              <div>Update Product</div><!-- START Language list-->
           </div>
           <ol class="breadcrumb">
                    <li>
                       <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li>
                       <a href="{{route('show_products')}}">Product</a>
                    </li>
                    <li class="active">
                      <strong>  Edit Product </strong>
                    </li>
           </ol>
           <form action = "{{route('update_product',$product->id)}}" method="post">
             {{csrf_field()}}
           <div class="row">
             <div class="col-md-8">
                 <!-- START card-->
                 <div class="card card-default">
                    <div class="card-body">
                          <div class="form-group"><label>Name</label><input class="form-control" type="text" placeholder="Enter Name" name="name" value="{{$product->name}}"></div>
                          <div class="form-group"><label>Calories</label><input class="form-control" type="text" placeholder="Enter calories" name="calories" Value="{{$product->calories}}"></div>
                          <div class="form-group"><label>Type</label>
                             <select class="form-control" id="select2-1" name="type">
                                <option></option>
                                <option {{ $product->type == '1' ? 'selected':'' }} value = "1">Meat</option>
                                <option {{ $product->type == '2' ? 'selected':'' }} value="2">Veggie</option>
                                <option {{ $product->type == '3' ? 'selected':'' }} value="3">Product</option>
                             </select>
                          </div>
                          <div class="form-group row">
                              <div class="col-xl-10">
                                @if($product->is_important ==0)
                                 <div class="checkbox c-checkbox"><label><input type="checkbox"  name="is_important"><span class="fa fa-check"></span> Is Important</label></div>
                                 @else
                                 <div class="checkbox c-checkbox"><label><input type="checkbox" checked="" name="is_important"><span class="fa fa-check"></span> Is Important</label></div>
                                 @endif
                              </div>
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
