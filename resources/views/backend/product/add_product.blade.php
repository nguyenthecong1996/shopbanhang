@extends('admin_layout')
@section('content')
	<div class="panel-body">
	    <div class="position-center">
	        <form role="form" action="{{URL::to('/admin/save-product')}}" method="post" enctype="multipart/form-data">
	        	{{ csrf_field() }}
	        <div class="form-group">
	            <label for="exampleInputEmail1">Tên sản phẩm</label>
	            <input type="text" class="form-control" id="exampleInputEmail1"  name="product_name" placeholder="Tên danh mục">
	            @if ($errors->has('product_name'))
					<p class="text-danger">{{ $errors->first('product_name') }}</p>
				@endif
	        </div>
	        <div class="form-group">
	            <label for="exampleInputPassword1">Mô tả danh mục</label>
	            <textarea style="resize: none;" rows="5" name="product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
	             @if ($errors->has('product_desc'))
					<p class="text-danger">{{ $errors->first('product_desc') }}</p>
				@endif
	        </div>
	        <div class="form-group">
	            <label for="exampleInputPassword1">Nội dung danh mục</label>
	            <textarea style="resize: none;" rows="5" name="product_content" class="form-control" id="exampleInputPassword1" placeholder="Nội dung danh mục"></textarea>
	            @if ($errors->has('product_content'))
					<p class="text-danger">{{ $errors->first('product_content') }}</p>
				@endif
	        </div>
	        <div class="form-group">
                <label for="exampleInputEmail1">Ảnh sản phẩm</label>
                <input type="file" class="form-control" name="product_image">
                @if ($errors->has('product_image'))
					<p class="text-danger">{{ $errors->first('product_image') }}</p>
				@endif
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Giá sản phẩm</label>
                <input type="text" class="form-control" id="exampleInputEmail1"  name="product_price" placeholder="Giá sản phảm">
                @if ($errors->has('product_price'))
					<p class="text-danger">{{ $errors->first('product_price') }}</p>
				@endif
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                <input type="text" class="form-control" id="exampleInputEmail1"  name="product_qty" placeholder="Số lượng">
                @if ($errors->has('product_qty'))
					<p class="text-danger">{{ $errors->first('product_qty') }}</p>
				@endif
            </div>
            <div class="form-group">
	            <label for="exampleInputFile">Danh mục</label>
	           	<select name="category_id" class="form-control input-sm m-bot15">
	           		@foreach ($getCategory as $value)
	           			<option value="{{$value->category_id}}">{{$value->category_name}}</option>
	           		@endforeach
	    		</select>
	        </div>
	        <div class="form-group">
	            <label for="exampleInputFile">Thương hiệu</label>
	           	<select name="brand_id" class="form-control input-sm m-bot15">
	           		@foreach ($getBrand as $value)
	           			<option value="{{$value->brand_id}}">{{$value->brand_name}}</option>
	           		@endforeach
	    		</select>
	        </div>
	        <div class="form-group">
	            <label for="exampleInputFile">Hiện thị</label>
	           	<select name="product_status" class="form-control input-sm m-bot15">
	           		@foreach (config('common.status') as $key => $value)
	           			<option value="{{$key}}">{{$value}}</option>
	           		@endforeach
	    		</select>
	        </div>
	        <button type="submit" name="add_product_product" class="btn btn-info">Thêm</button>
	    </form>
	    </div>
	</div>
@endsection