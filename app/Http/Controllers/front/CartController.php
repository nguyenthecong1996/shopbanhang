<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TblProduct;
use App\Models\TblBrand;
use App\Models\TblCategory;

class CartController extends Controller
{
    public function __construct()
    {
        $this->category = TblCategory::select('category_name', 'category_id', 'category_image')->where('category_status', 1)->orderBy('updated_at', 'desc')->get();
        $this->brand = TblBrand::select('brand_name', 'brand_id', 'brand_image')->where('brand_status', 1)->orderBy('updated_at', 'desc')->get();
    }

    public function addCart(){
    	$getCategory = $this->category;
    	$getBrand =  $this->brand;
    	$showCart = session('cart');
		return view('frontend.cart', compact('getCategory', 'getBrand', 'showCart'));
    }

    public function changeQty(Request $request){
        $data = $request->all();
        $qty = (int)$data['change_product_qty'];
        $check_qty = false; 
        $getCart = $request->session()->get('cart');
        if (array_key_exists($data['product_id'], $getCart)) {
            $getCart[$data['product_id']]['product_qty'] = $qty;
            $check_qty = true;
        }
        $request->session()->put('cart', $getCart);
        return response()->json($check_qty);
    }
}
