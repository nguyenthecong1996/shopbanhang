<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TblProduct;
use App\Models\TblBrand;
use App\Models\TblCategory;

class ProductController extends Controller
{
	 public function __construct()
    {
        $this->category = TblCategory::select('category_name', 'category_id')->orderBy('updated_at', 'desc')->get();
        $this->brand = TblBrand::select('brand_name', 'brand_id')->orderBy('updated_at', 'desc')->get();
    }
    public function allProduct(){
    	$getData = TblProduct::with('CategoryProduct', 'Brand')->orderBy('updated_at', 'desc')->get();
    	return view('backend.product.all_product')->with('getData', $getData);
    }

    public function createProduct(){
    	$getCategory = $this->category;
    	$getBrand =  $this->brand;
    	return view('backend.product.add_product', compact('getCategory', 'getBrand'));
    }

    public function saveProduct(Request $request) {
    	$data = $request->all();
    	$request->validate([
          'product_name' => 'required|max:255',
          'product_desc' => 'required',
          'product_content' => 'required',
          'product_price' => 'required',
          'product_desc' => 'required',
          'product_qty' => 'required',
          'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product_image = $request->file('product_image');
    	$product = new TblProduct;
    	if($product_image) {
    		$get_name = current(explode('.', $product_image->getClientOriginalName()));
    		$get_type_image = $product_image->getClientOriginalExtension();
    		$new_name = time().$get_name.'.'.$get_type_image;
    		$product_image->move('uploads/', $new_name);
    		$product->product_image = $new_name;
    	}
    	$product->product_name = $data['product_name'];
    	$product->product_desc = $data['product_desc'];
    	$product->product_content = $data['product_content'];
    	$product->product_price = $data['product_price'];
    	$product->product_desc = $data['product_desc'];
    	$product->product_qty = $data['product_qty'];
    	$product->category_id = $data['category_id'];
    	$product->brand_id = $data['brand_id'];
    	$product->product_status = $data['product_status'];
    	$product->save();
    	return redirect('admin/all-product')->with('status', 'Tạo danh mục sản phẩm thành công');
    }

    public function showProduct($product_id){
    	$getCategory = $this->category;
    	$getBrand =  $this->brand;
    	$showEdit = TblProduct::find($product_id);
    	return view('backend.product.edit_product', compact('getCategory', 'getBrand', 'showEdit'));
        // return response()->json($showEdit);
    }

    public function updateProduct(Request $request,$product_id) {
    	$data = $request->all();
    	$request->validate([
          'product_name' => 'required|max:255',
          'product_desc' => 'required',
          'product_content' => 'required',
          'product_price' => 'required',
          'product_qty' => 'required',
        ]);
    	$product = TblProduct::find($product_id);
    	if (isset($data['product_image'])){
    		$product_image = $request->file('product_image');
    		if($product_image) {
	    		$get_name = current(explode('.', $product_image->getClientOriginalName()));
	    		$get_type_image = $product_image->getClientOriginalExtension();
	    		$new_name = time().$get_name.'.'.$get_type_image;
	    		$product_image->move('uploads/', $new_name);
	    		$product->product_image = $new_name;
    		}
    	}
    	$product->product_name = $data['product_name'];
    	$product->product_desc = $data['product_desc'];
    	$product->product_content = $data['product_content'];
    	$product->product_price = $data['product_price'];
    	$product->product_desc = $data['product_desc'];
    	$product->product_qty = $data['product_qty'];
    	$product->category_id = $data['category_id'];
    	$product->brand_id = $data['brand_id'];
    	$product->product_status = $data['product_status'];
		$product->save();
    	return redirect('admin/all-product')->with('status', 'Chỉnh sửa danh mục sản phẩm thành công');
		// return response()->json(['code'=>200, 'message'=>'Post Updated successfully','data' => $post], 200);
    }


    public function deteleProduct($product_id){
    	$item = TblProduct::find($product_id);
		$item->delete();
        return redirect('admin/all-product')->with('status', 'Xóa danh mục sản phẩm thành công');
    }
}
