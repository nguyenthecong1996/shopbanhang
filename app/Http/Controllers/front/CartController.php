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
use App\Models\TblCoupon;


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
        // dd($data);

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
        if (isset($data['shipping_check_user'])) {
            $getShipping->check_default = 0;
        } else {
             $getShipping->check_default = 1;
        }
        $getShipping->user_id = Auth::guard('writer')->user()['id'];
        $getShipping->save();
        $getIdShippng = $getShipping->shipping_id;

        $getFeeAndAdd = array(
            'shipping_id' => $getIdShippng
        );
        $request->session()->put('fee', $getFeeAndAdd);

        $getFee = $request->session()->get('fee');

        return response()->json(['code' =>200, 'getShipping' => $getShipping]);
    }

    public function Payment(Request $request){
        $getCategory = $this->category;
        $getBrand =  $this->brand;
        $getCity = City::orderBy('name_thanhpho', 'asc')->get();
        $id = Auth::guard('writer')->user()['id'];
        $getFee = session('fee');
        if (isset($getFee)) {
            $getAdd = TblShipping::where('shipping_id', $getFee['shipping_id'])->first();
            $request->session()->forget('fee');
        } else {
            $getAdd = TblShipping::where('user_id', $id)->where('check_default', 1)->first();
        }
        $totalCart = 0;
        $getCart = session('cart');
        foreach ($getCart as $value) {
           $totalCart += $value['product_price']*$value['product_qty']; 
        }
        // get tat ca ban ghi
         $getAddAll = TblShipping::where('user_id', $id)->get();
        return view('frontend.payment', compact('getCategory', 'getBrand', 'getAdd', 'totalCart', 'getAddAll', 'getCity'));
    }

    public function checkUser(){
        $id = Auth::guard('writer')->user()['id'];
        $checkAuth = false;
        $getData = TblShipping::where('user_id', $id)->where('check_default', 1)->first();
        if (isset($getData)) {
            $checkAuth = true;
        }

        return response()->json($checkAuth);
    }

    public function handCash(){
        $getCategory = $this->category;
        $getBrand =  $this->brand;
        return view('frontend.handcash', compact('getCategory', 'getBrand'));
    }

    public function getCoupon() {
        $data = TblCoupon::where('coupon_id', 4)->get();
        return response()->json(['code' =>200, 'data' => $data]);
    }

    public function checkCoupon(Request $request){
        // $request->session()->forget('coupon');
        $data = $request->all();
        // dd($data);
        if (isset($data['arr_id_coupon'])) {
            $dataCheck = TblCoupon::whereIn('coupon_id', $data['arr_id_coupon'])->get();
            if(isset($dataCheck)){
                $getCoupon = $request->session()->get('coupon');
                // dd($getCoupon);
                if (isset($getCoupon)) {
                  foreach ($dataCheck as $item) {
                        if (array_key_exists($item['coupon_id'], $getCoupon)) {
                            continue;
                        } else {
                            $getCoupon[$item['coupon_id']] = array(
                                'coupon_name' => $item['coupon_name'],
                                'coupon_number' => $item['coupon_number'],
                                'coupon_condition' => $item['coupon_condition'],
                                'coupon_time' => $item['coupon_time']
                            );
                             $request->session()->put('coupon', $getCoupon);
                        }
                    }  
                    
                } else {
                    foreach ($dataCheck as $value) {
                        $getCoupon[$value['coupon_id']] = array(
                            'coupon_name' => $value['coupon_name'],
                            'coupon_number' => $value['coupon_number'],
                            'coupon_condition' => $value['coupon_condition'],
                            'coupon_time' => $value['coupon_time']
                        );
                    }
                    $request->session()->put('coupon', $getCoupon);
                }
            }
            return response()->json(['code' =>200]);   
        } else {
            if(isset($data['arr_id_remove'])) {
                foreach ($data['arr_id_remove'] as $value) {
                    $request->session()->forget('coupon.'.$value);
                    $request->session()->forget('searchCoupon.'.$value);
                }
                return response()->json(['check' => true]);
            } else {
                return response()->json();
            } 
        }  
    }

    public function searchCoupon(Request $request){
        $data = $request->all();
        $coupon_code = strtolower($data['coupon_code']);
        $getData = TblCoupon::where('coupon_code', $coupon_code)->first();
        $getCoupon = $request->session()->get('coupon');
        $getCoupon1 = $request->session()->get('searchCoupon');
        if(isset($getData)){
            if (isset($getCoupon)) {
                if (array_key_exists($getData['coupon_id'], $getCoupon)) {
                    return response()->json(['message' => 'Mã đã dùng']);
                } else {
                    $getCoupon[$getData['coupon_id']] = array(
                        'coupon_name' => $getData['coupon_name'],
                        'coupon_number' => $getData['coupon_number'],
                        'coupon_condition' => $getData['coupon_condition'],
                        'coupon_time' => $getData['coupon_time']
                    );

                    $getCoupon1[$getData['coupon_id']] = array(
                        'coupon_name' => $getData['coupon_name'],
                        'coupon_number' => $getData['coupon_number'],
                        'coupon_condition' => $getData['coupon_condition'],
                        'coupon_time' => $getData['coupon_time']
                    );
                     $request->session()->put('searchCoupon', $getCoupon1);
                     $request->session()->put('coupon', $getCoupon);
                }
            } else {
                $getCoupon[$getData['coupon_id']] = array(
                    'coupon_name' => $getData['coupon_name'],
                    'coupon_number' => $getData['coupon_number'],
                    'coupon_condition' => $getData['coupon_condition'],
                    'coupon_time' => $getData['coupon_time']
                );
                $getCoupon1[$getData['coupon_id']] = array(
                    'coupon_name' => $getData['coupon_name'],
                    'coupon_number' => $getData['coupon_number'],
                    'coupon_condition' => $getData['coupon_condition'],
                    'coupon_time' => $getData['coupon_time']
                );
            }
            $request->session()->put('coupon', $getCoupon);
            $request->session()->put('searchCoupon', $getCoupon1);
            return response()->json(['code' => 200]);
        } else {
            return response()->json(['message' => 'Sai mã code']);
        }
    }
}
