<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TblCategory;

class AdminController extends Controller
{
   	public function dashboard(){
    	return view('backend.dashboard');
    }

    public function allCategory(){
    	$getData = TblCategory::orderBy('updated_at', 'desc')->get();
    	return view('backend.all_category')->with('getData', $getData);
    }

    public function createCategory(Request $request){
    	$data = $request->all();
    	$request->validate([
          'category_name' => 'required|max:255',
          'category_desc' => 'required',
        ]);
    	// $saveCategory->category_name = $data['category_name'];
    	// $saveCategory->category_desc = $data['category_desc'];
    	// $saveCategory->category_status = $data['category_status'];
    	$post = TblCategory::create($data);
    	 return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $post], 200);
    }

    public function updateCategory(Request $request,$category_id) {
    	$request->validate([
          'category_name' => 'required|max:255',
          'category_desc' => 'required',
        ]);
    	$post = TblCategory::find($category_id);
    	$post->category_name = $request->category_name;
    	$post->category_desc = $request->category_desc;
    	$post->category_status = $request->category_status;
		$post->save();
		return response()->json(['code'=>200, 'message'=>'Post Updated successfully','data' => $post], 200);
    }

    public function showCategory($category_id){
    	$showEdit = TblCategory::find($category_id);
        return response()->json($showEdit);
    }

    public function deteleCategory($category_id){
    	$item = TblCategory::find($category_id);
		$item->delete();
        return response()->json(['code'=>200, 'message'=>'Post delele successfully','data' => $item], 200);
    }
}
