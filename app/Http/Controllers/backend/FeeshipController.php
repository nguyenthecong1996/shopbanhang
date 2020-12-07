<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Provice;
use App\Models\Wards;
use App\Models\TblFeeShip;


class FeeshipController extends Controller
{
    public function allTransport(){
    	$getCity = City::orderBy('name_thanhpho', 'asc')->get();
    	$getAdd = TblFeeShip::with('City', 'Provice', 'Wards')->get();
    	return view('backend.transport.all_transport', compact('getCity', 'getAdd'));
    }

    public function getAddress(Request $request){
    	$data = $request->all();
    	// dd($data);
    	$getAdd = [];
    	if(isset($data)){
	    	if($data['address'] == 'provice'){
	    		$getAdd['provice'] = Provice::where('matp', $data['matp'])->get();
	    		$getAdd['check_provice'] = 'check_provice';
	    	}elseif ($data['address'] == 'wards') {
	    		$getAdd['wards'] = Wards::where('maqh', $data['maqh'])->get();
	    		$getAdd['check_wards'] = 'check_wards';

	    	}
	    	return response()->json($getAdd);
    	}
    }

    public function addFee(Request $request) {
    	$data = $request->all();
    	$saveData = new TblFeeShip;
    	$saveData->fee_maxp = $data['wards'];
    	$saveData->fee_matp = $data['city'];
    	$saveData->fee_maqh = $data['provice'];
    	$saveData->fee_feesship = $data['fee_transport'];
    	$saveData->save();
    	return response()->json($saveData);
    }

    public function editFee(Request $request) {
    	$data = $request->all();
    	$flight = TblFeeShip::find($data['fee_transport_edit']);
		$flight->fee_feesship = $data['fee_feesship'];
		$flight->save();
    }
}
