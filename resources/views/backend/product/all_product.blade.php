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
      	<a href="{{url('admin/create-product')}}" class="btn btn-info" role="button">Thêm sản phẩm</a>
      </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Tên sản phẩm</th>
              <th>Mô tả</th>
              <th>Giá</th>
              <th>Số lượng</th>
              <th>Thể loại</th>
              <th>Thương hiệu</th>
              <th>Trạng thái</th>
              <th>Hình ảnh</th>
              <th>Thời gian</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($getData as $value)
            <tr>
              <td>{{$value->product_name}}</td>
              <td>{{$value->product_desc}}</td>
              <td>{{$value->product_price}}</td>
              <td>{{$value->product_qty}}</td>
              <td>{{$value['CategoryProduct']->category_name}}</td>
              <td>{{$value['Brand']->brand_name}}</td>
              <td>
                <img src="{{asset('/uploads/'.$value->product_image)}}"  width="100" height="100">
              </td>
              @if($value->product_status == 1)
                <td>Hiện</td>
              @else
               <td>Ẩn</td> 
              @endif
              <td>{{date('d-m-Y H:i', strtotime($value['updated_at']))}}</td>
              <td>
                <a href="{{URL::to('/admin/edit-product/'.$value->product_id)}}" class="btn btn-info" role="button">Chỉnh sửa</a> 
                <a href="{{URL::to('/admin/delete-product/'.$value->product_id)}}" class="btn btn-danger" role="button" onclick="confirm('Are you sure to delete?');">Xóa</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>
<script>
$(document).ready(function(){
  	setTimeout(function(){
  		$('.hidden-text').hide();
  	}, 3000);
});
</script>
@endsection