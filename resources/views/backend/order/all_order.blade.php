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
              	<a href="{{url('admin/create-category')}}" class="btn btn-info" role="button">Thêm danh mục</a>
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     	<th>Tên người gửi</th>
			            <th>Tổng tiền</th>
			            <th>Trạng thái</th>
			            <th>Hiện thị</th>
			            <th>Thời gian</th>
                      	<th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getData as $value)
                    <tr>
                      <td>{{$value['TblUser']['name']}}</td>
                      <td>{{$value['order_total']}}</td>
                      <td>
                      	@foreach (config('common.order_status') as $key => $item)
                      		@if($value['order_status'] == $key)
                      			{{$item}}
                      		@endif
                      	@endforeach
                      </td>
                      <td>
                      	@foreach (config('common.payment_option') as $key => $item)
                      		@if($value['payment_status'] == $key)
                      			{{$item}}
                      		@endif
                      	@endforeach
                      </td>
                      <td>{{date('d-m-Y H:i', strtotime($value['updated_at']))}}</td>
                      <td>
                        <a href="{{URL::to('/admin/detail-order/'.$value->order_id)}}" class="btn btn-info" role="button">Chi tiết</a> 
                        <a href="{{URL::to('/admin/delete-category/'.$value->order_id)}}" class="btn btn-danger" role="button" onclick="confirm('Are you sure to delete?');">Xóa</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection