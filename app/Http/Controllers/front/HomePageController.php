<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TblProduct;
use App\Models\TblBrand;
use App\Models\TblCategory;

class HomePageController extends Controller
{
	public function __construct()
    {
        $this->category = TblCategory::select('category_name', 'category_id', 'category_image')->where('category_status', 1)->orderBy('updated_at', 'desc')->get();
        $this->brand = TblBrand::select('brand_name', 'brand_id', 'brand_image')->where('brand_status', 1)->orderBy('updated_at', 'desc')->get();
    }
	public function index(){
		$getCategory = $this->category;
    	$getBrand =  $this->brand;
    	$all_product = TblProduct::orderBy('updated_at', 'desc')->where('product_status', 1)->get();
		return view('frontend.home_page', compact('getCategory', 'getBrand', 'all_product'));
	}

	public function cartProduct(Request $request) {
		$data = $request->all();
		$qty = (int)$data['cart_product_qty'];
		// $request->session()->forget('cart');

		// $session = $request->session();
		// dd($session);
		$getCart = $request->session()->get('cart');
		// dd($getCart);
		if (isset($getCart)) {
			if (array_key_exists($data['product_id'], $getCart)) {
				$getCart[$data['product_id']]['product_qty']++;
			} else {
				$session_id = rand(10,100);
				$getCart[$data['product_id']] = array(
					'session_id' => $session_id,
					'product_id' => $data['product_id'],
					'product_name' => $data['cart_product_name'],
					'product_image' => $data['cart_product_image'],
					'product_price' => $data['cart_product_price'],
					'product_qty' => $qty,
				);	
			}
		} else {
			$session_id = rand(10,100);
			$getCart[$data['product_id']] = array(
				'session_id' => $session_id,
				'product_id' => $data['product_id'],
				'product_name' => $data['cart_product_name'],
				'product_image' => $data['cart_product_image'],
				'product_price' => $data['cart_product_price'],
				'product_qty' => $qty,
			);
		}
		$request->session()->put('cart', $getCart);
		return response()->json($getCart);

	}
}
