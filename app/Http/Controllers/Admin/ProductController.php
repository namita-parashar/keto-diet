<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function show(){
      $product = Product::paginate(10);
      return view('admin/pages/product',['product'=>$product]);
    }

    public function index(){
      return view('admin/pages/add-product');
    }

    public function create(AddProductRequest $request){
      if($request->is_important == 'on'){
        $is_important =1;
      }
      else{
        $is_important =0;
      }
      $exists_product = Product::Where('name','=',$request->name)->first();
      if($exists_product){
          return back()->with('errors', collect(['credentials' => 'Already exists product with this name']));
      }else{
      $product = new Product();
      $product->name = $request->name;
      $product->calories = $request->calories;
      $product->type = $request->type;
      $product->is_important = $is_important;
      $product->save();
      return redirect()->back();
    }

    }

    public function updateIndex(Request $request)
    {
      $product = Product::where('id',$request->id)->first();
      return view('admin/pages/update-product',['product'=>$product]);
    }

    public function update(Request $request)
    {
      if($request->is_important == 'on'){
        $is_important =1;
      }
      else{
        $is_important =0;
      }
      Product::Where('id',$request->id)->update(['name'=>$request->name,'calories'=>$request->calories,'type'=>$request->type, 'is_important' => $is_important]);
      return redirect()->back();
    }

    public function delete(Request $request)
    {
      Product::where('id',$request->id)->delete();
      return redirect()->back();
    }

}
