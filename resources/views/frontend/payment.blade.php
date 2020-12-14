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
						<span> <button type="button" class="btn btn-link">+ Thêm địa chỉ mới</button></span><span><button type="button" class="btn btn-link">Thiết lập địa chỉ</button></span>
					</div>
				</div>
				<div class="setup_checkbox">
					<span>{{$getAdd['shipping_name'].' - '.$getAdd['shipping_phone']}}</b>&nbsp &nbsp {{$getAdd['shipping_address']}}</span> <span class="change_add">/ Thay đổi</span>
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
		<form action="{{(url('/admin/order-place'))}}" method="post">
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
					<input name="shipping_id" value="{{$getAdd['shipping_id']}}" type="hidden">
					<input  type="submit" class="btn btn-primary btn-sm" value="Đặt hàng">
				</div>
		</form>
	</div>
</section>
<script>
    var data = <?php echo json_encode($getAddAll); ?>;
    var data1 = <?php echo json_encode($getAdd); ?>;

</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.change_add',function(){	
			$('.setup_add').css('display', 'inline ');
			$(this).hide();
			var option = '';
			option +='<form>';
				for(i in data) {
					if (data[i]['shipping_id'] == data1['shipping_id']) {
						option += '<span><label class="radio-inline"><input name="payment_option" type="radio" value="'+data[i]['shipping_id']+'" checked>'+data[i]['shipping_name'] + ' - ' +data[i]['shipping_phone'] + '&nbsp &nbsp' +data[i]['shipping_address']+'</label></span><br>';
					} else {
						option += '<span><label class="radio-inline"><input name="payment_option" type="radio" value="'+data[i]['shipping_id']+'">'+data[i]['shipping_name'] + ' - ' +data[i]['shipping_phone'] + '&nbsp &nbsp' + data[i]['shipping_address']+'</label></span><br>';
					}
				}
			option +='</form>';
			option += '<br><button type="button" class="btn btn-warning">Thay đổi</button><button type="button" class="btn btn-secondary back_add">Trở về</button>'
			$(this).closest('.setup_checkbox').html(option);
		})

		$(document).on('click','.back_add',function(){
			var option = '<span>The cong 1996</span><span class="change_add"> / Thay đổi</span>'
			$('.setup_add').css('display', 'none');
			$(this).closest('.setup_checkbox').html(option)
		})
	})
</script>
@endsection