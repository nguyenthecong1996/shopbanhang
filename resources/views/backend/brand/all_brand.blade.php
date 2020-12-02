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
      	<a href="{{url('admin/create-brand')}}" class="btn btn-info" role="button">Thêm thương hiệu</a>
      </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Tên thương hiệu</th>
              <th>Mô tả</th>
              <th>Trạng thái</th>
              <th>Hình ảnh</th>
              <th>Thời gian</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($getData as $value)
            <tr>
              <td>{{$value->brand_name}}</td>
              <td>{{$value->brand_desc}}</td>
              <td>
                <img src="{{asset('/uploads/'.$value->brand_image)}}"  width="100" height="100">
              </td>
              @if($value->brand_status == 1)
                <td>Hiện</td>
              @else
               <td>Ẩn</td> 
              @endif
              <td>{{date('d-m-Y H:i', strtotime($value['updated_at']))}}</td>
              <td>
                <a href="{{URL::to('/admin/edit-brand/'.$value->brand_id)}}" class="btn btn-info" role="button">Chỉnh sửa</a> 
                <a href="{{URL::to('/admin/delete-brand/'.$value->brand_id)}}" class="btn btn-danger" role="button" onclick="confirm('Are you sure to delete?');">Xóa</a>
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