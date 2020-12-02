@extends('admin_layout')
@section('content')
	<div class="panel-body">
	    <div class="position-center">
	        <form role="form" action="{{URL::to('/admin/update-brand/'.$showEdit->brand_id)}}" method="post" enctype="multipart/form-data">
	        	{{ csrf_field() }}
	        <div class="form-group">
	            <label for="exampleInputEmail1">Tên danh mục</label>
	            <input type="text" class="form-control" id="exampleInputEmail1"  name="brand_name" value="{{$showEdit->brand_name}}" placeholder="Tên danh mục">
	        </div>
	        <div class="form-group">
	            <label for="exampleInputPassword1">Mô tả danh mục</label>
	            <textarea style="resize: none;" rows="5" name="brand_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$showEdit->brand_desc}}</textarea>
	        </div>
	        <div class="form-group">
                <label for="exampleInputEmail1">Ảnh thương hiệu</label>
                <input type="file" class="form-control" name="brand_image">
                @if ($errors->has('brand_image'))
					<p class="text-danger">{{ $errors->first('brand_image') }}</p>
				@endif
            </div>
	        <div class="form-group">
	            <label for="exampleInputFile">Hiện thị</label>
	           	<select name="brand_status" class="form-control input-sm m-bot15">
	           		@foreach (config('common.status') as $key => $value)
	           			@if($showEdit->brand_status == $key)
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