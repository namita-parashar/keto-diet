@extends('admin/layout/main') @section('content')
<section class="section-container">
         <!-- Page content-->
         <div class="content-wrapper">
            <div class="content-heading">
               <div>Product</div><!-- START Language list-->
            </div>
            <ol class="breadcrumb">
                     <li>
                        <a href="{{route('dashboard')}}">Dashboard</a>
                     </li>
                     <li class="active">
                   <strong>Products</strong>
                     </li>
            </ol>
            <div class="row">
              <div class="add col-sm-12 " style="margin-top: -5px;">
         <form action="{{route('index_product')}}" method="post">
            <a href="{{route('index_product')}}"><button class="btn btn-success" type="button" ><i class="fa fa-plus" aria-hidden="true"></i> Add Product</button></a>
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
                                 <th>Calories</th>
                                 <th>Type</th>
                              </tr>
                           </thead>
                           <tbody>
                             @foreach($product as $product_data)
                           <tr>
                              <td>{{$product_data->name}}</td>
                              <td>{{$product_data->calories}}</td>
                              <td><span class="label label-primary">
                                @if($product_data->type == 1)
                                Meat
                                @elseif($product_data->type == 2)
                                Veggie
                                @elseif($product_data->type == 3)
                                Product
                                @endif
                              </span></td>
                              <td class="text-center">
                        <div class="btn-group btn-group-xs">
                            <a href="{{route('update_index_product',$product_data->id)}}" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
                            <a id="{{$product_data->id}}" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger delete" ><i class="fa fa-times"></i></a>
                        </div>
                    </td>
                           </tr>
                           @endforeach

                           </tbody>
                           <tfoot >
                           <tr class="test">
                              <td colspan="12">
                                 <ul class="pagination pull-right ">{{$product->appends(Request::except('page'))->links()}}</ul>
                              </td>
                           </tr>
                        </tfoot>
                        </table>
                        @if(!count($product))
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
              if(confirm("Are you sure you want to delete this product? It will delete immediately when you click on OK."))
              {
                  $.get("{{URL::route('delete_product')}}?id="+del_id,function(data){
                      $(element).closest('label').remove();
                  });
                  window.location.reload();
                  return false;
              }
          });
      });
      </script>

@endsection
