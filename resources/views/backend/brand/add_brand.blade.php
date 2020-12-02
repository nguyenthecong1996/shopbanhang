@extends('admin_layout')
@section('content')
	<div class="panel-body">
	    <div class="position-center">
	        <form role="form" action="{{URL::to('/admin/save-brand')}}" method="post" enctype="multipart/form-data">
	        	{{ csrf_field() }}
	        <div class="form-group">
	            <label for="exampleInputEmail1">Tên thương hiệu</label>
	            <input type="text" class="form-control" id="exampleInputEmail1"  name="brand_name" placeholder="Tên danh mục">

	            @if ($errors->has('brand_name'))
					<p class="text-danger">{{ $errors->first('brand_name') }}</p>
				@endif
	        </div>
	        <div class="form-group">
	            <label for="exampleInputPassword1">Mô tả danh mục</label>
	            <textarea style="resize: none;" rows="5" name="brand_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
	             @if ($errors->has('brand_desc'))
					<p class="text-danger">{{ $errors->first('brand_desc') }}</p>
				@endif
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
	           			<option value="{{$key}}">{{$value}}</option>
	           		@endforeach
	    		</select>
	        </div>
	        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm</button>
	    </form>
	    </div>
	</div>
@endsection