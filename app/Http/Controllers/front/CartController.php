<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\TblProduct;
use App\Models\TblBrand;
use App\Models\TblCategory;
use App\Models\TblShipping;


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
        $totalCart = 0;
        // $te = array();
        foreach ($showCart as $key => $value) {
            // $te['show_cart'][$key] = $value;
            $totalCart += $value['product_price']*$value['product_qty'];
            // $te['totalCart'][$key] = $value;
        }
		return view('frontend.cart', compact('getCategory', 'getBrand', 'showCart', 'totalCart'));
    }

    public function changeQty(Request $request){
        $data = $request->all();
        // dd($data);
        $qty = (int)$data['change_product_qty'];
        $check_qty = false; 
        $getCart = $request->session()->get('cart');
        // dd($getCart);
        if (array_key_exists($data['product_id'], $getCart)) {
            $getCart[$data['product_id']]['product_qty'] = $qty;
            $changePrice = $getCart[$data['product_id']]['product_price']*$qty;
            $check_qty = true;
        }
        $totalCart = 0;
        foreach ($getCart as $value) {
           $totalCart += $value['product_price']*$value['product_qty']; 
        }
        $request->session()->put('cart', $getCart);
        return response()->json(['check_qty' => $check_qty, 'changePrice' =>$changePrice, 'totalCart' => $totalCart]);
    }

    public function removeItem(Request $request){
        $data = $request->all();
        $request->session()->forget('cart.'.$data['id_remove']);
        $getCart = $request->session()->get('cart');

        $totalCart = 0;
        foreach ($getCart as $value) {
           $totalCart += $value['product_price']*$value['product_qty']; 
        }

        return response()->json(['totalCart' => $totalCart]);
    }

    public function shippingInfo(Request $request){
        $data = $request->all();
        $getShipping = new TblShipping;
        $getShipping->shipping_name = $data['shipping_name'];
        $getShipping->shipping_email = $data['shipping_email'];
        $getShipping->shipping_address = $data['shipping_address'];
        $getShipping->shipping_phone = $data['shipping_phone'];
        $getShipping->shipping_content = $data['shipping_content'];
        $getShipping->save();
        $getIdShippng = $getShipping->shipping_id;
        dd( $getIdShippng);
    }
}
