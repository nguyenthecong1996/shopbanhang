@extends('admin_layout')
@section('content')
	<div class="panel-body">
	    <div class="position-center">
	        <form role="form" action="{{URL::to('/admin/update-category/'.$showEdit->category_id)}}" method="post">
	        	{{ csrf_field() }}
	        <div class="form-group">
	            <label for="exampleInputEmail1">Tên danh mục</label>
	            <input type="text" class="form-control" id="exampleInputEmail1"  name="category_name" value="{{$showEdit->category_name}}" placeholder="Tên danh mục">
	        </div>
	        <div class="form-group">
	            <label for="exampleInputPassword1">Mô tả danh mục</label>
	            <textarea style="resize: none;" rows="5" name="category_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$showEdit->category_desc}}</textarea>
	        </div>
	        <div class="form-group">
	            <label for="exampleInputFile">Hiện thị</label>
	           	<select name="category_status" class="form-control input-sm m-bot15">
	           		@foreach (config('common.status') as $key => $value)
	           			@if($showEdit->category_status == $key)
	           				<option value="{{$key}}" selected>{{$value}}</option>
	           			@else
	           				<option value="{{$key}}">{{$value}}</option>
	           			@endif
	           		@endforeach
	    		</select>
	        </div>
	        <button type="submit" name="add_brand_product" class="btn btn-info">Cập nhật</button>
	    </form>
	    </div>

	</div>
@endsection