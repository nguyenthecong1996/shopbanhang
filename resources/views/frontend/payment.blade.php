@extends('frontend_layout')
@section('content')
<section id="cart_items">
	<div class="container" style="width: 950px">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Shopping Cart</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div>
					<h4>Địa chỉ :</h4>
					<div style="float: right;
					    position: relative;
					    top: -36px;
					    left: -13px;
					    display: none;" class="setup_add">
						<span> <button type="button" class="btn btn-link add-user "data-toggle="modal">+ Thêm địa chỉ mới</button></span><span><button type="button" class="btn btn-link">Thiết lập địa chỉ</button></span>
					</div>
				</div>
				<div class="setup_checkbox">
					<span>{{$getAdd['shipping_name'].' - '.$getAdd['shipping_phone']}} &nbsp &nbsp {{$getAdd['shipping_address']}}</span> <span class="change_add">/ Thay đổi</span>
				</div>
			</div>
		</div>
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Hình ảnh</td>
						<td class="description">Mô tả</td>
						<td class="price">Giá</td>
						<td class="quantity">Số lượng</td>
						<td class="total">Tổng tiền</td>
					</tr>
				</thead>
				<tbody>
				@if(session('cart'))
					@foreach(session('cart') as $item)
					<tr>
						<td class="cart_product">
							<a href=""><img src="{{asset('/uploads/'.$item['product_image'])}}"  width="50" alt=""></a>
						</td>
						<td class="cart_description">
							<h4><a href="">{{$item['product_name']}}</a></h4>
							<p>Ma ID: {{$item['session_id']}}</p>
						</td>
						<td class="cart_price">
							<p>{{number_format($item['product_price'])}}</p>
						</td>
						<td class="cart_quantity">
							{{$item['product_qty']}}
						</td>
						<td class="cart_total">
							<p class="cart_total_price">{{number_format($item['product_price'] * $item['product_qty'])}}</p>
						</td>
					</tr>
					@endforeach
				@endif	
				</tbody>
			</table>
		</div>
	</div>
</section>
<section id="do_action" >
	<div class="container" style="width: 950px">
		<div class="row">
			<div class="col-sm-6">
				<div class="total_area">
					<ul>
						<li>Tổng <span class="total_cart_not_fee">{{$totalCart}}</span></li>
						<li>Thuế <span class="total_fee">12</span></li>
						<li>Phí vận chuyển<span>{{$getAdd['fee_ship']}}</span></li>
						<li>Tổng tiền <span class="total_cart">{{$totalCart + 12 + $getAdd['fee_ship']}}</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="cart_items">
	<div class="container" style="width: 950px">
		<div class="review-payment">
			<h2>Review & Payment</h2>
		</div>
		<form method="post">
			{{ csrf_field() }}
			<div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="radio"> Trả bằng thẻ ATM</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="radio"> Nhận tiền mặt</label>
					</span>
					<span>
						<label><input name="payment_option" value="3" type="radio"> Thanh toán thẻ ghi nợ</label>
					</span>
					<input name="total_cart" value="{{$totalCart + 12 + $getAdd['fee_ship']}}" type="hidden">
					<button  type="button" class="btn btn-primary btn-sm payment_btn">Đặt hàng</button>
				</div>
		</form>
	</div>
</section>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle">Thông tin người nhận</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        	<form class="data-form">
		        		{{ csrf_field() }}
			            <input type="hidden" name="shipping_check_user" value="check_default_user">
			          	<div class="form-group">
			            	<label for="recipient-name" class="col-form-label">Name:</label>
			            	<input type="text" class="form-control form-control-sm empty-value" name="shipping_name">
			          	</div>
			          	<div class="form-group">
			            	<label for="recipient-email" class="col-form-label">Email:</label>
			            	<input type="text" class="form-control form-control-sm empty-value" name="shipping_email">
			          	</div>
			          	<div class="form-group">
			            	<label for="recipient-phone" class="col-form-label">Phone:</label>
			            	<input type="text" class="form-control form-control-sm empty-value" name="shipping_phone">
			          	</div>
			          	<div class="form-group">
				            <label for="message-text" class="col-form-label">Message:</label>
				            <textarea class="form-control form-control-sm empty-value" id="message-text" name="shipping_content"></textarea>
			          	</div>

					   <div class="form-group">
					    <label for="exampleFormControlSelect1">Thành phố</label>
					    <select class="form-control form-control-sm choose empty-value" id="exampleFormControlSelect1" address="provice" name="city">
					    	<option value="">Chọn thành phố</option>
					    	@foreach($getCity as $key => $value)
					      		<option value="{{$value->matp}}">{{$value->name_thanhpho}}</option>
					      	@endforeach	
					    </select>
					  </div>
					  <div class="form-group">
					    <label for="exampleFormControlSelect2">Quận/Huyện</label>
					    <select class="form-control form-control-sm choose provice empty-value" id="exampleFormControlSelect2" address="wards" name="provice" disabled>
					    	<option value="">Chọn quận huyện</option>
					    </select>
					  </div>
					  <div class="form-group">
					    <label for="exampleFormControlSelect3">Xã/Phường</label>
					    <select class="form-control form-control-sm wards empty-value" id="exampleFormControlSelect3" name="wards" disabled>
					      <option value="">Chọn xã phường</option>
					    </select>
					  </div>
			        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-default add-address">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>
<script>
    var data = <?php echo json_encode($getAddAll); ?>;
    var data1 = <?php echo json_encode($getAdd); ?>;
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var check_id = data1['shipping_id'];
		$('.add-user').click(function(e){
			$('#exampleModalCenter').modal('show');
		})

		$('.add-address').click(function(e){
			var data = $('.data-form').serialize();
		    var url = '/shipping_info';
		    var opiton = 'POST';
		     _common.request(url, data, opiton)
		    .then(function(response){
		    	if (response.code == 200) {
		    		var option = '<span><label class="radio-inline"><input name="add_option" type="radio" value="'+response.getShipping['shipping_id']+'">'+response.getShipping['shipping_name'] + ' - ' +response.getShipping['shipping_phone'] + '&nbsp &nbsp' + response.getShipping['shipping_address']+'</label></span><br>';
		    		$('.form-add').append(option);
		    		$('#exampleModalCenter').modal('hide');
		    		location.reload();
		    	}
		    })
		})

		$(document).on('click','.change_add',function(){	
			$('.setup_add').css('display', 'inline ');
			$(this).hide();
			var option = '';
			option +='<form class="form-add">';
				for(i in data) {
					if (data[i]['shipping_id'] == check_id) {
						option += '<span><label class="radio-inline"><input name="add_option" type="radio" value="'+data[i]['shipping_id']+'" checked>'+data[i]['shipping_name'] + ' - ' +data[i]['shipping_phone'] + '&nbsp &nbsp' +data[i]['shipping_address']+'</label></span><br>';
					} else {
						option += '<span><label class="radio-inline"><input name="add_option" type="radio" value="'+data[i]['shipping_id']+'">'+data[i]['shipping_name'] + ' - ' +data[i]['shipping_phone'] + '&nbsp &nbsp' + data[i]['shipping_address']+'</label></span><br>';
					}
				}
			option +='</form>';
			option += '<br><button type="button" class="btn btn-warning change_setup">Thay đổi</button><button type="button" class="btn btn-secondary back_add">Trở về</button>'
			$(this).closest('.setup_checkbox').html(option);
		})

		$(document).on('click','.back_add',function(){
			var option = '';
			option += '<span>'+ data1['shipping_name'] +" - "+ data1['shipping_phone'] + ' &nbsp &nbsp' + data1['shipping_address'] +'</span><span class="change_add"> / Thay đổi</span>'
			$('.setup_add').css('display', 'none');
			$(this).closest('.setup_checkbox').html(option)
		})

		$(document).on('click','.change_setup',function(){
			var add_option = $('input[name=add_option]:checked').val();
			check_id =add_option;
			var option = "";
			for(i in data){
				if (data[i]['shipping_id'] == check_id) {
					option += '<span>'+ data[i]['shipping_name'] +" - "+ data[i]['shipping_phone'] + ' &nbsp &nbsp' + data[i]['shipping_address'] +'</span><span class="change_add"> / Thay đổi</span>';
				}
			}
			$('.setup_add').css('display', 'none');
			$(this).closest('.setup_checkbox').html(option)
		})

		$('.payment_btn').click(function(){
			var add_option = check_id;
			var payment_option = $('input[name=payment_option]:checked').val();
			var total_cart = $('input[name=total_cart]').val();
			var url = '/admin/order-place';
		    var opiton = 'post';
		    var data = {
		    	'shipping_id' : add_option,
		    	'payment_option' : payment_option,
		    	'total_cart' : total_cart,
		    	'_token': '{{ csrf_token() }}'
		    };

		     _common.request(url, data, opiton)
		    .then(function(response){
		    	if (response.code == 200) {
		    		window.location.href = "{{url('/hand-cash')}}"
		    	}
		    })
		})
	})
</script>
@endsection