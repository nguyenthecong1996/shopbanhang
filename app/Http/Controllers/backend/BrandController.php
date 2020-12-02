<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TblBrand;


class BrandController extends Controller
{
    public function allBrand(){
    	$getData = TblBrand::orderBy('updated_at', 'desc')->get();
    	return view('backend.brand.all_brand')->with('getData', $getData);
    }

    public function createBrand(){

    	return view('backend.brand.add_brand');
    }

    public function saveBrand(Request $request) {
    	$data = $request->all();
    	$request->validate([
          'brand_name' => 'required|max:255',
          'brand_desc' => 'required',
        ]);
        $brand_image = $request->file('brand_image');
    	$brand = new TblBrand;
        if($brand_image) {
            $get_name = current(explode('.', $brand_image->getClientOriginalName()));
            $get_type_image = $brand_image->getClientOriginalExtension();
            $new_name = time().$get_name.'.'.$get_type_image;
            $brand_image->move('uploads/', $new_name);
            $brand->brand_image = $new_name;
        }
    	$brand->brand_name = $data['brand_name'];
    	$brand->brand_desc = $data['brand_desc'];
    	$brand->brand_status = $data['brand_status'];
    	$brand->save();
    	return redirect('admin/all-brand')->with('status', 'Tạo danh mục sản phẩm thành công');
    }

    public function showBrand($brand_id){
    	$showEdit = TblBrand::find($brand_id);
    	return view('backend.brand.edit_brand')->with('showEdit', $showEdit);
        // return response()->json($showEdit);
    }

    public function updateBrand(Request $request,$brand_id) {
    	$request->validate([
          'brand_name' => 'required|max:255',
          'brand_desc' => 'required',
        ]);
    	$post = TblBrand::find($brand_id);
        if (isset($data['brand_image'])){
            $brand_image = $request->file('brand_image');
            if($brand_image) {
                $get_name = current(explode('.', $brand_image->getClientOriginalName()));
                $get_type_image = $brand_image->getClientOriginalExtension();
                $new_name = time().$get_name.'.'.$get_type_image;
                $brand_image->move('uploads/', $new_name);
                $post->brand_image = $new_name;
            }
        }
    	$post->brand_name = $request->brand_name;
    	$post->brand_desc = $request->brand_desc;
    	$post->brand_status = $request->brand_status;
		$post->save();
    	return redirect('admin/all-brand')->with('status', 'Chỉnh sửa danh mục sản phẩm thành công');
		// return response()->json(['code'=>200, 'message'=>'Post Updated successfully','data' => $post], 200);
    }


    public function deteleBrand($brand_id){
    	$item = TblBrand::find($brand_id);
		$item->delete();
        return redirect('admin/all-brand')->with('status', 'Xóa danh mục sản phẩm thành công');
    }
}
