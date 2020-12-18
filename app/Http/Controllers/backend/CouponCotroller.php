<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TblCoupon;

class CouponCotroller extends Controller
{
    public function allCoupon() {
    	$getData = TblCoupon::orderBy('coupon_id', 'desc')->get();
    	return view('backend.coupon.all_coupon', compact('getData'));
    }

    public function addCoupon() {
    	return view('backend.coupon.add_coupon');
    }

    public function saveCoupon(Request $request) {
    	$data = $request->all();
    	$saveData = new TblCoupon;
    	$saveData->coupon_name = $data['coupon_name'];
    	$saveData->coupon_code = $data['coupon_code'];
    	$saveData->coupon_number = $data['coupon_number'];
    	$saveData->coupon_condition = $data['coupon_condition'];
    	$saveData->coupon_time = $data['coupon_time'];
    	$saveData->save();
    	return redirect('admin/all-coupon')->with('status', 'Tạo mã khuyến mãi thành công');
    }

    public function editCoupon($id){
    	$showEdit = TblCoupon::find($id);
    	return view('backend.coupon.edit_coupon')->with('showEdit', $showEdit);
    }

    public function updateCoupon(Request $request, $id){
    	$data = $request->all();
    	$saveCoupon = TblCoupon::find($id);
    	$saveCoupon->coupon_name = $data['coupon_name'];
    	$saveCoupon->coupon_code = $data['coupon_code'];
    	$saveCoupon->coupon_number = $data['coupon_number'];
    	$saveCoupon->coupon_condition = $data['coupon_condition'];
    	$saveCoupon->coupon_time = $data['coupon_time'];
    	$saveCoupon->save();
    	return redirect('admin/all-coupon')->with('status', 'Update mã khuyến mãi thành công');
    }

    public function deteleCoupon($id){
    	$item = TblCoupon::find($id);
    	$item->delete();
        return redirect('admin/all-coupon')->with('status', 'Xóa mã khuyến mãi thành công');

    }
}
