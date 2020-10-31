@extends('admin_layout')
@section('content')
    <div class="container">
      <h2>Thêm danh mục sản phẩm</h2>
      <form action="/action_page.php">
        <div class="form-group">    
          <label for="categoryName">Tên danh mục:</label>
          <input type="text" class="form-control" id="email" placeholder="Nhập tên danh mục" name="category_name">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Nôi dụng</label>
            <textarea class="form-control" name="category_desc" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
       <div class="form-group">
        <label for="exampleFormControlSelect1">Trạng thái</label>
        <select class="form-control" id="exampleFormControlSelect1" name="category_status">
              <option value="0">Ẩn</option>
              <option value="1">Hiện</option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
@endsection