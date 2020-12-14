<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TblOrder;
use App\Models\TblOrderDetail;
use Auth;
use App\Models\TblBrand;
use App\Models\TblCategory;
use App\Models\TblUser;
use App\Models\TblShipping;
class OrderController extends Controller
{
	public function __construct()
    {
        $this->category = TblCategory::select('category_name', 'category_id', 'category_image')->where('category_status', 1)->orderBy('updated_at', 'desc')->get();
        $this->brand = TblBrand::select('brand_name', 'brand_id', 'brand_image')->where('brand_status', 1)->orderBy('updated_at', 'desc')->get();
    }

    public function orderPlace(Request $request){
    	$data = $request->all();
    	dd($data);
    	$saveOrder = new TblOrder;
    	$saveOrder->user_id = Auth::guard('writer')->user()['id'];
    	$saveOrder->payment_status = $data['payment_option'];
    	$saveOrder->order_status = 1;
    	$saveOrder->order_total = $data['total_cart'];
    	$saveOrder->save();

    	foreach (session('cart') as $key => $value) {
    		$saveOrderDetail = new TblOrderDetail;
    		$saveOrderDetail->order_id = $saveOrder->order_id;
    		$saveOrderDetail->product_id = $value['product_id'];
    		$saveOrderDetail->product_name = $value['product_name'];
    		$saveOrderDetail->product_price = $value['product_price'];
    		$saveOrderDetail->product_sales_quantity = $value['product_qty'];
    		$saveOrderDetail->save();
    	}

    	$getCategory = $this->category;
    	$getBrand =  $this->brand;
    	if ( $data['payment_option'] == 2) {
    		$request->session()->forget('cart');
        	return view('frontend.handcash', compact('getCategory', 'getBrand'));
    	} else {
        	return abort(404);
    	} 
    }

    public function allOrder(){
    	$getData = TblOrder::with('TblUser')->get();
    	return view('backend.order.all_order', compact('getData'));
    }

    public function detailOrder($id_order){
    	$userid = TblOrder::find($id_order);
    	$getInfoShipping = TblShipping::where('user_id', $userid->user_id)->get();
    	dd($getInfoShipping);
    	return view('backend.detail_order');
    	// dd($id_order);
    }
}
