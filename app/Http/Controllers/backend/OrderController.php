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
use App\Models\TblCoupon;

class OrderController extends Controller
{
	public function __construct()
    {
        $this->category = TblCategory::select('category_name', 'category_id', 'category_image')->where('category_status', 1)->orderBy('updated_at', 'desc')->get();
        $this->brand = TblBrand::select('brand_name', 'brand_id', 'brand_image')->where('brand_status', 1)->orderBy('updated_at', 'desc')->get();
    }

    public function orderPlace(Request $request){
    	$data = $request->all();
    	// dd($data);
    	$saveOrder = new TblOrder;
    	$saveOrder->user_id = Auth::guard('writer')->user()['id'];
    	$saveOrder->payment_status = $data['payment_option'];
    	$saveOrder->order_status = 1;
        $saveOrder->shipping_id = $data['shipping_id'];
    	$saveOrder->order_total = $data['total_cart'];
        if(isset($data['total_coupon'])){
            $saveOrder->total_coupon = $data['total_coupon'];
        }
    	$saveOrder->save();
        $a = array();
        if (session('coupon')) {
            foreach (session('coupon') as $key => $value) {
                array_push($a, $key);
            }
        }
    	foreach (session('cart') as $key => $value) {
    		$saveOrderDetail = new TblOrderDetail;
            if (isset($a)) {
                $saveOrderDetail->product_coupon_id = implode(",", $a);
            }
    		$saveOrderDetail->order_id = $saveOrder->order_id;
    		$saveOrderDetail->product_id = $value['product_id'];
    		$saveOrderDetail->product_name = $value['product_name'];
    		$saveOrderDetail->product_price = $value['product_price'];
            $saveOrderDetail->product_sales_quantity = $value['product_qty'];
            $saveOrderDetail->product_feeship = $data['fee_ship'];
    		$saveOrderDetail->save();
    	}
    	$getCategory = $this->category;
    	$getBrand =  $this->brand;
    	if ( $data['payment_option'] == 2) {
            $request->session()->forget('cart');
            $request->session()->forget('coupon');
    		$request->session()->forget('searchCoupon');
        	return response()->json(['code' =>200]);
    	} else {
        	return abort(404);
    	} 
    }

    public function allOrder(){
    	$getData = TblOrder::with('shipping')->orderBy('updated_at', 'desc')->get();
        $data = [];
        foreach ($getData as $key => $item) {
            $getUser = TblUser::where('id',  $item->user_id)->first();
            $data[$key]['shipping_id'] = $item['shipping_id'];
            $data[$key]['order_total'] = $item['order_total'];
            $data[$key]['order_id'] = $item['order_id'];
            $data[$key]['payment_status'] = $item['payment_status'];
            $data[$key]['order_status'] = $item['order_status'];
            $data[$key]['updated_at'] = $item['updated_at'];
            $data[$key]['name_user'] = $getUser['name'];
            $data[$key]['total_coupon'] = $item['total_coupon'];
        }
    	return view('backend.order.all_order', compact('data'));
    }

    public function detailOrder($id_order){
        $dataAll = [];
    	$userid = TblOrder::find($id_order);
    	$getInfoShipping = $userid->shipping()->where('shipping_id', $userid->shipping_id)->first();
        $getUser = TblUser::where('id',  $getInfoShipping->user_id)->first();
        $getOrderDetail = $userid->orderDetail()->get();

         $dataAll = [
            'getInfoShipping' => $getInfoShipping,
            'getUser' => $getUser,
            'getOrderDetail' => $getOrderDetail,
            'userid' => $userid
        ];

        foreach ($getOrderDetail as  $value) {
            if (isset($value['product_coupon_id'])) {
                $array = explode(',', $value['product_coupon_id']);
            }
        }
        $stringCoupon = '';
        foreach ($array as $value) {
            $data = TblCoupon::where('coupon_id',  $value)->select('coupon_code')->first();
            if (isset($data)) {
                $stringCoupon .= $data['coupon_code'].',';
                $dataAll['stringCoupon'] =  rtrim($stringCoupon, ",");
            }
        }
    	return view('backend.order.detail_order', compact('dataAll'));
    }
}
