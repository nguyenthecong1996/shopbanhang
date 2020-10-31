@extends('admin_layout')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="#" class="btn btn-success btn-icon-split" id="create-new-category">
          <span class="icon text-white-50">
            <i class="fas fa-check"></i>
          </span>
          <span class="text">Thêm danh mục</span>
      </a>
    </div>
    <div id="message-alert1" class="text-success"></div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Tên thể loại</th>
              <th>Nôi dung</th>
              <th>Trạng thái</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($getData as $value)
            <tr id="row_{{$value->category_id}}">
              <td>{{$value->category_name}}</td>
              <td>{{$value->category_desc}}</td>
              @if($value->category_status == 1)
              <td>Hiện</td>
              @else
                <td>Ẩn</td>
              @endif
              <td><a href="javascript:void(0)" data-id="{{ $value->category_id }}" onclick="editPost(this)" class="btn btn-info">Edit</a>
                    <a href="javascript:void(0)" data-id="{{ $value->category_id }}" class="btn btn-danger" onclick="deletePost(this)">Delete</a>
              </td>      
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="tag-form">
           {{ csrf_field() }}
            <div class="form-group">    
              <label for="categoryName">Tên danh mục:</label>
              <input type="text" class="form-control" id="exampleCategoryName" placeholder="Nhập tên danh mục" name="category_name">
              <span id="titleError" class="alert-message alert-danger"></span>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Nôi dụng</label>
                <textarea class="form-control" name="category_desc" id="exampleFormControlTextarea1" rows="3"></textarea>
                 <span id="descriptionError" class="alert-message alert-danger"></span>
            </div>
           <div class="form-group">
            <label for="exampleFormControlSelect1">Trạng thái</label>
            <select class="form-control" id="exampleFormControlSelect1" name="category_status">
                  <option value="0">Ẩn</option>
                  <option value="1">Hiện</option>
            </select>
            </div>
        </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="tag-form-submit" class="btn btn-primary" value="Add">Send message</button>
            <input type="hidden" name="id_category" value="0">
          </div>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('#create-new-category').on('click', function() {
     $('#tag-form-submit').val('Add');
     $('#exampleModal').modal('show');
     $('#exampleCategoryName').val('');
     $('#exampleFormControlTextarea1').val('');
     $('#titleError').val('');
     $('#descriptionError').val('');
  });
  $('#tag-form-submit').on('click', function(e) {
      e.preventDefault();
      var data =  $('#tag-form').serialize();
      var url = '/create-category';
      var id = $("input[name='id_category']").val();
      if ($('#tag-form-submit').val() == 'Edit') {
        // data = $('#tag-form').serialize()+'&category_id='+id;
        url = '/update-category/'+id;
      }

      $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(response) {
           if(response.code == 200) {
                var link = '<tr id="row_'+response.data.category_id+'"><td>'+response.data.category_name+'</td><td>'+response.data.category_desc+'</td><td>'+(response.data.category_status == 1 ? "Hiện" : "Ẩn")+'</td><td><a href="javascript:void(0)" data-id="'+response.data.category_id+'" onclick="editPost(this)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.category_id+'" class="btn btn-danger" onclick="deletePost(this)">Delete</a></td></tr>';
                if ($('#tag-form-submit').val() == 'Add') {
                  $('table tbody').prepend(link);
                } else {
                  $('#row_'+response.data.category_id).replaceWith(link);
                }
              $('#exampleModal').modal('hide');
              $('#message-alert1').html(response.message).show();
            }
              setTimeout(function() { $("#message-alert1").hide(); }, 5000);
        },
        error: function(response) {
            $('#titleError').text(response.responseJSON.errors.category_name);
            $('#descriptionError').text(response.responseJSON.errors.category_desc);
        }
      });
    });
  });

  function editPost(value){
    var id = $(value).attr("data-id");
    $.ajax({
      type:"GET",
      url:'/edit-category/' + id,
       success: function(response) {
        if (response){
          $('#exampleCategoryName').val(response.category_name);
          $('#exampleFormControlTextarea1').val(response.category_desc);
          $("input[name='id_category']").val(response.category_id);
          $('#tag-form-submit').val('Edit');
          $('#exampleModal').modal('show');
        }
       },
      error: function(response) {

      }
    });
  }

  function deletePost(value){
    var id = $(value).attr("data-id");
    console.log(id)
    $.ajax({
      type:"GET",
      url:'/delete-category/' + id,
       success: function(response) {
        if (response){
          $("#row_" + id).remove()
          $('#message-alert1').html(response.message).show();
          setTimeout(function() { $("#message-alert1").hide(); }, 5000);
        }
       },
      error: function(response) {

      }
    });
  }  
</script>
@endsection