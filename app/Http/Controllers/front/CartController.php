<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Auth;
use App\Models\TblProduct;
use App\Models\TblBrand;
use App\Models\TblCategory;
use App\Models\TblShipping;
use App\Models\TblFeeShip;
use App\Models\City;
use App\Models\Provice;
use App\Models\Wards;
use App\Models\TblUser;


class CartController extends Controller
{
    public function __construct()
    {
        $this->category = TblCategory::select('category_name', 'category_id', 'category_image')->where('category_status', 1)->orderBy('updated_at', 'desc')->get();
        $this->brand = TblBrand::select('brand_name', 'brand_id', 'brand_image')->where('brand_status', 1)->orderBy('updated_at', 'desc')->get();
    }

    public function addCart(){
        $getCity = City::orderBy('name_thanhpho', 'asc')->get();
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
		return view('frontend.cart', compact('getCategory', 'getBrand', 'showCart', 'totalCart', 'getCity'));
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

        $getCategory = $this->category;
        $getBrand =  $this->brand;
        $data = $request->all();

        $getDataFee = TblFeeShip::with('City', 'Provice', 'Wards')->where('fee_matp', $data['city'])->where('fee_maqh', $data['provice'])->where('fee_maxp', $data['wards'])->first();

        $getAllName = '';
        $getFeeShip = 0;

        if (!isset($getDataFee)) {
            $getIdCity = City::where('matp', $data['city'])->with('allAddress')->first();
            $getName = array(
              'name_thanhpho' => $getIdCity['name_thanhpho']  
            );
            foreach ($getIdCity['allAddress'] as $value) {
                if ($data['provice'] == $value['maqh']) {
                    $getName['name_quanhuyen'] = $value['name_quanhuyen'];
                    foreach ($value['Wards'] as $children) {
                        if ($data['wards'] == $children['xaid']) {
                            $getName['name_xa'] = $children['name_xa'];
                            break;
                        }
                    }
                    break;
                }
            }
            $getAllName = $getName['name_xa'].' - '. $getName['name_quanhuyen'].' - '.$getName['name_thanhpho'];
            $getFeeShip = 10000;
        } else {
            $getAllName = $getDataFee['Wards']['name_xa'].' - '. $getDataFee['Provice']['name_quanhuyen'].' - '.$getDataFee['City']['name_thanhpho'];
             $getFeeShip = $getDataFee['fee_feesship'];
        }
        $getShipping = new TblShipping;
        $getShipping->shipping_name = $data['shipping_name'];
        $getShipping->shipping_email = $data['shipping_email'];
        $getShipping->shipping_address = $getAllName;
        $getShipping->shipping_phone = $data['shipping_phone'];
        $getShipping->shipping_content = $data['shipping_content'];
        $getShipping->fee_ship = $getFeeShip;
        $getShipping->check_default = 1;
        $getShipping->user_id = Auth::guard('writer')->user()['id'];
        $getShipping->save();
        $getIdShippng = $getShipping->shipping_id;

        $getFeeAndAdd = array(
            'shipping_id' => $getIdShippng
        );
        $request->session()->put('fee', $getFeeAndAdd);

        $getFee = $request->session()->get('fee');

        return response()->json(['code' =>200]);
    }

    public function Payment(Request $request){
        $getCategory = $this->category;
        $getBrand =  $this->brand;
        $getFee = session('fee');
        if (isset($getFee)) {
            $getAdd = TblShipping::where('shipping_id', $getFee['shipping_id'])->first();
            $request->session()->forget('fee');
        } else {
            $id = Auth::guard('writer')->user()['id'];
            $getAdd = TblShipping::where('user_id', $id)->latest('shipping_id')->first();
        }

        $totalCart = 0;
        $getCart = session('cart');
        foreach ($getCart as $value) {
           $totalCart += $value['product_price']*$value['product_qty']; 
        }
        // get tat ca ban ghi
         $getAddAll = TblShipping::where('user_id', $id)->get();
        return view('frontend.payment', compact('getCategory', 'getBrand', 'getAdd', 'totalCart', 'getAddAll'));
    }

    public function checkUser(){
        $id = Auth::guard('writer')->user()['id'];
        $checkAuth = false;
        $getData = TblShipping::where('user_id', $id)->latest('shipping_id')->first();
        if (isset($getData)) {
            $checkAuth = true;
        }

        return response()->json($checkAuth);
    }
}
