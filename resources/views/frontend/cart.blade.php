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
							@foreach($showCart as $item)
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
									<div class="cart_quantity_button">
										<div class="cart_quantity_up add-up"> + </div>
										<form>
											<input type="hidden" name="product_id" class="product_id_change_qty" value="{{$item['product_id']}}">
											<input class="cart_quantity_input" type="text" name="quantity_update" value="{{$item['product_qty']}}" autocomplete="off" size="2">
										</form>	
										<div class="cart_quantity_down add-down"> - </div>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">{{number_format($item['product_price'] * $item['product_qty'])}}</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="{{url('/remove-item/'.$item['session_id'])}}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							@endforeach
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
								<li>Tổng <span>12</span></li>
								<li>Thuế <span>12</span></li>
								<li>Phí vận chuyển<span>Free</span></li>
								<li>Tổng tiền <span>12</span></li>
							</ul>
							@if(Auth::check())
								<a class="btn btn-default check_out" href="{{url('/checkout')}}">Thanh toán</a>
							@else
								<a class="btn btn-default check_out" href="{{url('/login-checkout')}}">Thanh toán</a>
							@endif	
						</div>
					</div>
				</div>
			</div>
		</section><!--/#do_action-->
<script type="text/javascript">
	$(document).ready(function(){
		const minus = $('.add-down');
  		const plus = $('.add-up');
  		var product_id_change_qty = $('.product_id_change_qty').val()
  		plus.click(function(e) {
		    e.preventDefault();
		    const input = $(this).closest(".cart_quantity_button").find(".cart_quantity_input");
		    var setThis = $(this);
		    var value = input.val();
		    value++;
		    console.log(value)

		    $.ajax({
            type: 'POST',
            url: '/change-qty',
            data: {'change_product_qty' : value, 'product_id': product_id_change_qty, '_token': '{{ csrf_token() }}'},
            success: function(response) {
            	if (response) {
            		setThis.css("display", "block");
            		input.val(value);
            	}
                },
            error: function(error) {
                console.log(error)
            }
          });
	 	});

  		minus.click(function(e) {
		    e.preventDefault();
		    const input = $(this).closest(".cart_quantity_button").find(".cart_quantity_input");
		    var setThis = $(this);
		    var value = input.val();
		    if (value > 1) {
		      value--;
		    }
		    $.ajax({
            type: 'POST',
            url: '/change-qty',
            data: {'change_product_qty' : value, 'product_id': product_id_change_qty, '_token': '{{ csrf_token() }}'},
            success: function(response) {
            	if (response) {
            		setThis.css("display", "block");
            		input.val(value);
            	}
                },
            error: function(error) {
                console.log(error)
            }
          });
	  });
	});	
</script>		
@endsection