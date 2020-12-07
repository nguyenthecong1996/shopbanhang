@extends('admin_layout')
@section('content')
	<div class="card shadow mb-4">
    @if (session('status'))
    <div class="alert alert-success hidden-text">
      	{{ session('status') }}
    </div>
    @endif
    <div class="card-header py-3">
    <form class="data-form">	
    	{{ csrf_field() }}
	      <div class="form-group">
		    <label for="exampleFormControlSelect1">Thành phố</label>
		    <select class="form-control form-control-sm choose" id="exampleFormControlSelect1" address="provice" name="city">
		    	<option value="">Chọn thành phố</option>
		    	@foreach($getCity as $key => $value)
		      		<option value="{{$value->matp}}">{{$value->name_thanhpho}}</option>
		      	@endforeach	
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlSelect2">Quận/Huyện</label>
		    <select class="form-control form-control-sm choose provice" id="exampleFormControlSelect2" address="wards" name="provice">
		    	<option value="">Chọn quận huyện</option>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlSelect3">Xã/Phường</label>
		    <select class="form-control form-control-sm choose" id="exampleFormControlSelect3" name="wards">
		      <option value="">Chọn xã phường</option>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Phí vận chuyển</label>
		    <input type="text" class="form-control form-control-sm" id="exampleFormControlInput4" name="fee_transport" placeholder="phí...">
		  </div>
	  </form>

	  <button type="submit" name="add_brand_product" class="btn btn-info submit_form">Thêm</button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Tên thành phố</th>
              <th>Tên quận/huyện</th>
              <th>Tên phường/xã</th>
              <th>Phí vận chuyển</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($getAdd as $item)
	            <tr>
	        		@if(isset($item['City']))
	              		<td>{{$item['City']['name_thanhpho']}}</td>
	              	@endif
	              	@if(isset($item['Provice']))
	              		<td>{{$item['Provice']['name_quanhuyen']}}</td>
	              	@endif
	              	@if(isset($item['Wards']))
	              		<td>{{$item['Wards']['name_xa']}}</td>
	              	@endif
	              	<td data-id="{{$item['fee_id']}}" class="edit_fee">
	              		<input type="text" class="form-control form-control-sm"  value="{{$item['fee_feesship']}}" name="fee_transport_edit">
	              	</td>
	            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".choose").change(function(){
		  var setThis = $(this);
		  var url = '';
		  var opiton = '';
		  var data = {};
		  // console.log(address)
		  if (setThis.attr('address') == 'provice') {
		  	data = {
		  		matp: setThis.val(),
		  		address : 'provice'
		  	};
		  	url = '/admin/get-address';
		  	opiton = 'GET';
		  } else if (setThis.attr('address') == 'wards') {
		  		data = {
		  		maqh: setThis.val(),
		  		address : 'wards'
		  	};
		  	url = '/admin/get-address';
		  	opiton = 'GET';
		  }

		     _common.request(url, data, opiton)
		    .then(function(response){
		    	var options = "";
		    	if (response['check_provice'] == 'check_provice') {
		    		options += '<option value="">Chọn quận huyện</option>';
					for(i in response['provice']) {
					    options += '<option value= "' + response['provice'][i]['maqh'] + '">' + response['provice'][i]['name_quanhuyen'] + '</option>';
					}
					$('#exampleFormControlSelect2').html(options);
		    	} else {
		    		options += '<option value="">Chọn xã phường</option>';
					for(i in response['wards']) {
					    options += '<option value= "' + response['wards'][i]['xaid'] + '">' + response['wards'][i]['name_xa'] + '</option>';
					}
					$('#exampleFormControlSelect3').html(options);
		    	}
		    })
		});

		$(".submit_form").click(function(){
			 var data = $('.data-form').serialize();
		  	 var url = '/admin/add-fee';
		  	 var opiton = 'post';
		  	  _common.request(url, data, opiton)
		    .then(function(response){
		    	window.location.href = "{{url('/admin/all-transport')}}"
		    })
		})

		$('input[name="fee_transport_edit"]').change(function(e){
			e.preventDefault();
			var setThis = $(this);
			var id = setThis.closest('.edit_fee').data('id');
			var value = setThis.val();
			 var data = {
			 	'fee_transport_edit' : id,
			 	'fee_feesship' : value,
			 	'_token': '{{ csrf_token() }}'
			 }
		  	 var url = '/admin/edit-fee';
		  	 var opiton = 'post';
		  	  _common.request(url, data, opiton)
		    .then(function(response){
		    	
		    })
		})
	});


</script>
@endsection