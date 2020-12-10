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

		<div>
			<ol class="breadcrumb">
			  <li>Địa chỉ</li>
			  <li class="active"><b>{{$getAdd['shipping_name'].' - '.$getAdd['shipping_phone']}}</b>&nbsp &nbsp {{$getAdd['shipping_address']}}</li>
			</ol>
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
						<td></td>
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
							
						</td>
						<td class="cart_total">
							<p class="cart_total_price">{{number_format($item['product_price'] * $item['product_qty'])}}</p>
						</td>
						<td class="cart_delete">
							<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
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
								<li>Phí vận chuyển<span>Free</span></li>
								<li>Tổng tiền <span class="total_cart">{{$totalCart + 12}}</span></li>
							</ul>
							<button type="button" class="btn btn-default check_out"  data-toggle="modal" data-target="#exampleModalCenter">Thanh toán</button>
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
			<form action="{{(url('/order-place'))}}" method="post">
				{{ csrf_field() }}
				<div class="payment-options">
						<span>
							<label><input name="payment_option" value="1" type="checkbox"> Trả bằng thẻ ATM</label>
						</span>
						<span>
							<label><input name="payment_option" value="2" type="checkbox"> Nhận tiền mặt</label>
						</span>
						<span>
							<label><input name="payment_option" value="3" type="checkbox"> Thanh toán thẻ ghi nợ</label>
						</span>
						<input  type="submit" class="btn btn-primary btn-sm" value="Đặt hàng">
					</div>
			</form>
		</div>
	</section>
@endsection