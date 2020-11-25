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
                      <th>Tên danh mục</th>
                      <th>Mô tả</th>
                      <th>Trạng thái</th>
                      <th>Thời gian</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getData as $value)
                    <tr>
                      <td>{{$value->category_name}}</td>
                      <td>{{$value->category_desc}}</td>
                      @if($value->category_status == 1)
                        <td>Hiện</td>
                      @else
                       <td>Ẩn</td> 
                      @endif
                      <td>{{date('d-m-Y H:i', strtotime($value['updated_at']))}}</td>
                      <td>
                        <a href="{{URL::to('/admin/edit-category/'.$value->category_id)}}" class="btn btn-info" role="button">Chỉnh sửa</a> 
                        <a href="{{URL::to('/admin/delete-category/'.$value->category_id)}}" class="btn btn-danger" role="button" onclick="confirm('Are you sure to delete?');">Xóa</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
<!-- <script>
    var data = <?php echo json_encode($getData); ?>;
</script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>

<script>
$(document).ready(function(){
	setTimeout(function(){
		$('.hidden-text').hide();
	}, 3000);

  //   _common.buildTable({
  //     data : data
  //   })
  // $('#create-new-category').on('click', function() {
  //    $('#tag-form-submit').val('Add');
  //    $('#exampleModal').modal('show');
  //    $('#exampleCategoryName').val('');
  //    $('#exampleFormControlTextarea1').val('');
  //    $('#titleError').val('');
  //    $('#descriptionError').val('');
  // });
  // $('#tag-form-submit').on('click', function(e) {
  //     e.preventDefault();
  //     var data =  $('#tag-form').serialize();
  //     var url = '/create-category';
  //     var methods = 'POST';
  //     var id = $("input[name='id_category']").val();
  //     if ($('#tag-form-submit').val() == 'Edit') {
  //       // data = $('#tag-form').serialize()+'&category_id='+id;
  //       url = '/update-category/'+id;
  //     }
  //     _common.request(url, data, methods)
  //     .then(function(result){
  //       if (result) {
  //         if ($('#tag-form-submit').val() == 'Add') {
  //           _common.buildTable({
  //             data : result,
  //             build_mode : 'append'
  //           });
  //         }
  //       }
      // });

     /* $.ajax({
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
      });*/
  //   });
  // });

  // function editPost(value){
  //   var id = $(value).attr("data-id");
  //   $.ajax({
  //     type:"GET",
  //     url:'/edit-category/' + id,
  //      success: function(response) {
  //       if (response){
  //         $('#exampleCategoryName').val(response.category_name);
  //         $('#exampleFormControlTextarea1').val(response.category_desc);
  //         $("input[name='id_category']").val(response.category_id);
  //         $('#tag-form-submit').val('Edit');
  //         $('#exampleModal').modal('show');
  //       }
  //      },
  //     error: function(response) {

  //     }
  //   });
  // }

  // function deletePost(value){
  //   var id = $(value).attr("data-id");
  //   console.log(id)
  //   $.ajax({
  //     type:"GET",
  //     url:'/delete-category/' + id,
  //      success: function(response) {
  //       if (response){
  //         $("#row_" + id).remove()
  //         $('#message-alert1').html(response.message).show();
  //         setTimeout(function() { $("#message-alert1").hide(); }, 5000);
  //       }
  //      },
  //     error: function(response) {

  //     }
    });
  // }  
</script>
@endsection