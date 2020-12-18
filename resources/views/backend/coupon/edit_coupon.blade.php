@extends('admin_layout')
@section('content')
	<div class="panel-body">
	    <div class="position-center">
	        <form role="form" action="{{URL::to('/admin/update-coupon/'.$showEdit->coupon_id)}}" method="post">
	        	{{ csrf_field() }}
	        <div class="form-group">
	            <label for="exampleInputEmail1">Tên Mã giảm giá</label>
	            <input type="text" class="form-control" id="exampleInputEmail1"  name="coupon_name" placeholder="nhập..." value="{{$showEdit->coupon_name}}">
	            @if ($errors->has('coupon_name'))
					<p class="text-danger">{{ $errors->first('coupon_name') }}</p>
				@endif
	        </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tên code</label>
                <input type="text" class="form-control" id="exampleInputEmail1"  name="coupon_code" placeholder="nhập..." value="{{$showEdit->coupon_code}}">
                @if ($errors->has('coupon_code'))
					<p class="text-danger">{{ $errors->first('coupon_code') }}</p>
				@endif
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Số lượng code</label>
                <input type="text" class="form-control" id="exampleInputEmail1"  name="coupon_time" placeholder="nhập..." value="{{$showEdit->coupon_time}}">
                @if ($errors->has('coupon_time'))
					<p class="text-danger">{{ $errors->first('coupon_time') }}</p>
				@endif
            </div>
            <div class="form-group">
	            <label for="exampleInputFile">Kiểu giảm giá</label>
	           	<select name="coupon_condition" class="form-control input-sm m-bot15">
	           		@foreach (config('common.coupon_option') as $key => $value)
	           			@if($key == $showEdit->coupon_condition)
	           				<option value="{{$key}}" selected>{{$value}}</option>	
	           			@else
	           				<option value="{{$key}}">{{$value}}</option>
	           			@endif
	           		@endforeach
	    		</select>
	        </div>
	        <div class="form-group">
                <label for="exampleInputEmail1">Nhập số % hoặc số tiền cần giảm</label>
                <input type="text" class="form-control" id="exampleInputEmail1"  name="coupon_number" placeholder="nhập..." value="{{$showEdit->coupon_number}}">
                @if ($errors->has('coupon_number'))
					<p class="text-danger">{{ $errors->first('coupon_number') }}</p>
				@endif
            </div>
	        <button type="submit" name="add_product_product" class="btn btn-info">Thêm</button>
	    </form>
	    </div>
	</div>
@endsection