@extends('admin_layout')
@section('content')
	<div class="panel-body">
	    <div class="position-center">
	        <form role="form" action="{{URL::to('/admin/save-category')}}" method="post" enctype="multipart/form-data">
	        	{{ csrf_field() }}
	        <div class="form-group">
	            <label for="exampleInputEmail1">Tên danh mục</label>
	            <input type="text" class="form-control" id="exampleInputEmail1"  name="category_name" placeholder="Tên danh mục">

	            @if ($errors->has('category_name'))
					<p class="text-danger">{{ $errors->first('category_name') }}</p>
				@endif
	        </div>
	        <div class="form-group">
	            <label for="exampleInputPassword1">Mô tả danh mục</label>
	            <textarea style="resize: none;" rows="5" name="category_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
	             @if ($errors->has('category_desc'))
					<p class="text-danger">{{ $errors->first('category_desc') }}</p>
				@endif
	        </div>
	        <div class="form-group">
                <label for="exampleInputEmail1">Ảnh thể loại</label>
                <input type="file" class="form-control" name="category_image">
                @if ($errors->has('category_image'))
					<p class="text-danger">{{ $errors->first('category_image') }}</p>
				@endif
            </div>
	        <div class="form-group">
	            <label for="exampleInputFile">Hiện thị</label>
	           	<select name="category_status" class="form-control input-sm m-bot15">
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