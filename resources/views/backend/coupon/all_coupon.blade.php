@extends('admin_layout')
@section('content')
  <div class="card shadow mb-4">
  			@if (session('status'))
		    <div class="alert alert-success hidden-text">
		        	{{ session('status') }}
		    	</div>
			@endif
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
              	<a href="{{url('admin/add-coupon')}}" class="btn btn-info" role="button">Thêm danh mục</a>
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tên Mã giảm giá</th>
                      <th>Tên code</th>
                      <th>Số lần giảm</th>
                      <th>Kiểu giảm</th>
                      <th>Số tiền</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getData as $value)
                    <tr>
                      <td>{{$value->coupon_name}}</td>
                      <td>{{$value->coupon_code}}</td>
                      <td>{{$value->coupon_number}}</td>
                      <td>
                      	{{config('common.coupon_option.'.$value->coupon_condition)}}</td>
                      <td>{{$value->coupon_number}}</td>
                      <td>
                        <a href="{{URL::to('/admin/edit-coupon/'.$value->coupon_id)}}" class="btn btn-info" role="button">Chỉnh sửa</a> 
                        <a href="{{URL::to('/admin/delete-coupon/'.$value->coupon_id)}}" class="btn btn-danger" role="button" onclick="confirm('Are you sure to delete?');">Xóa</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection