<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TblCategory;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard(){
        return view('backend.dashboard');
    }

    public function allCategory(){
    	$getData = TblCategory::orderBy('updated_at', 'desc')->get();
    	return view('backend.category.all_category')->with('getData', $getData);
    }

    public function createCategory(){

    	return view('backend.category.add_category');
    }

    public function saveCategory(Request $request) {
    	$data = $request->all();
    	$request->validate([
          'category_name' => 'required|max:255',
          'category_desc' => 'required',
        ]);
        $category_image = $request->file('category_image');
    	$category = new TblCategory;
        if($category_image) {
            $get_name = current(explode('.', $category_image->getClientOriginalName()));
            $get_type_image = $category_image->getClientOriginalExtension();
            $new_name = time().$get_name.'.'.$get_type_image;
            $category_image->move('uploads/', $new_name);
            $category->category_image = $new_name;
        }
    	$category->category_name = $data['category_name'];
    	$category->category_desc = $data['category_desc'];
    	$category->category_status = $data['category_status'];
    	$category->save();
    	return redirect('admin/all-category')->with('status', 'Tạo danh mục sản phẩm thành công');
    }

    public function showCategory($category_id){
    	$showEdit = TblCategory::find($category_id);
    	return view('backend.category.edit_category')->with('showEdit', $showEdit);
        // return response()->json($showEdit);
    }

    public function updateCategory(Request $request,$category_id) {
    	$request->validate([
          'category_name' => 'required|max:255',
          'category_desc' => 'required',
        ]);
    	$post = TblCategory::find($category_id);
        if (isset($data['category_image'])){
            $category_image = $request->file('category_image');
            if($category_image) {
                $get_name = current(explode('.', $category_image->getClientOriginalName()));
                $get_type_image = $category_image->getClientOriginalExtension();
                $new_name = time().$get_name.'.'.$get_type_image;
                $category_image->move('uploads/', $new_name);
                $post->category_image = $new_name;
            }
        }
    	$post->category_name = $request->category_name;
    	$post->category_desc = $request->category_desc;
    	$post->category_status = $request->category_status;
		$post->save();
    	return redirect('admin/all-category')->with('status', 'Chỉnh sửa danh mục sản phẩm thành công');
		// return response()->json(['code'=>200, 'message'=>'Post Updated successfully','data' => $post], 200);
    }


    public function deteleCategory($category_id){
    	$item = TblCategory::find($category_id);
		$item->delete();
        return redirect('admin/all-category')->with('status', 'Xóa danh mục sản phẩm thành công');
    }
}
