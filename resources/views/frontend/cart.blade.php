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
							@if(session('cart'))
								@foreach($showCart as $key => $item)
								<tr class="cart_delete_{{$item['product_id']}}">
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
										<div class="cart_quantity_button" data-id="{{$item['product_id']}}">
											<div class="cart_quantity_up add-up"> + </div>
											<form>
												<input class="cart_quantity_input change_cart_quantity_{{$item['product_id']}}" type="text" name="quantity_update" value="{{$item['product_qty']}}" autocomplete="off" size="2">
											</form>	
											<div class="cart_quantity_down add-down"> - </div>
										</div>
									</td>
									<td class="cart_total">
										<p class="cart_total_price total_price_{{$item['product_id']}}">{{number_format($item['product_price'] * $item['product_qty'])}}</p>
									</td>
									<td class="cart_delete"  data-id="{{$item['product_id']}}">
										<a class="cart_quantity_delete remove_item_{{$item['product_id']}}"><i class="fa fa-times"></i></a>
									</td>
								</tr>
								@endforeach
							@endif	
						</tbody>
					</table>
				</div>
			</div>
		</section>
		@php
			$totalCoupon = 0;
		@endphp
		<section id="do_action" >
			<div class="container" style="width: 950px">
				<div class="row">
					<div class="col-sm-6">
						<div class="total_area" style="border: 1px solid #E6E4DF;
						    color: #696763;
						    padding: 0px 25px 30px 0;
						    margin-bottom: 80px;">
						    @if(session('coupon'))
						    	<div>
						    		<ul>
						    			@foreach(session('coupon') as $value)
						    				@if($value['coupon_condition'] == 1)
						    					@php
						    						$totalCoupon += ($value['coupon_number']*$totalCart)/100
						    					@endphp
												<li>{{$value['coupon_name']}}<span>{{$value['coupon_number']}} %</span></li>
											@elseif($value['coupon_condition'] == 2)
												@php
						    						$totalCoupon += $value['coupon_number']
						    					@endphp
												<li>{{$value['coupon_name']}}<span>{{$value['coupon_number']}} VNĐ</span></li>	
											@endif
										@endforeach
									</ul>
						    	</div>
								<div style="border-bottom: 1px solid black;">
									<button type="button" class="btn btn-link coupon_click">Chọn Voucher khác</button></span>	
								</div>
							@else
								<div style="border-bottom: 1px solid black;">
									<button type="button" class="btn btn-link coupon_click">Chọn Hoặc Nhập Mã</button></span>	
								</div>	
							@endif
							<ul>
								<li>Tổng <span class="total_cart_not_fee">{{$totalCart}}</span></li>
								<li>Thuế <span class="total_fee">12</span></li>
								<li>Phí vận chuyển<span>Free</span></li>
								<li>Tổng giảm<span>{{$totalCoupon}}</span></li>
								<li>Tổng tiền <span class="total_cart">{{$totalCart + 12}}</span></li>
							</ul>
							<button type="button" class="btn btn-default check_out check-user" data-toggle="modal">Thanh toán</button>
						</div>
					</div>
				</div>
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
		        <button type="button" class="btn btn-default submit-shipping">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle1" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle">Các mã khuyến mãi</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form class="data-form2">
		      		<div class="form-row align-items-center">
					    <div class="col-sm-6 my-1">
					      <label class="sr-only" for="inlineFormInputName">Tìm kiếm</label>
					      <input type="text" class="form-control" id="inlineFormInputName" placeholder="Mã Voucher">
					    </div>
					    <div class="col-auto my-1">
					      <button type="button" class="btn btn-info bnt_coupon_code">Áp dụng</button>
					    </div>
					</div>
				</form>	
					<br>
		        	<form class="data-form1">
		        		
			        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-default submit_coupon">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>
<script type="text/javascript">
	$(document).ready(function(){
		const minus = $('.add-down');
  		const plus = $('.add-up');
  		var couponId = [];

  		$('.coupon_click').click(function(){
  			var url = '/get-coupon';
		    var opiton = 'get';
		    var data = {};

		     _common.request(url, data, opiton)
		    .then(function(response){
		    	if(response.code == 200) {
		    		return response.data;
		    	}
		    })
		    .then(function(response){
		    	$('#exampleModalCenter1').modal('show');
		    	var opiton = "";
		    	for(i in response){
		    		opiton += '<div class="form-check form-check-inline">'
		    		opiton += '<input class="form-check-input" type="checkbox" id="inlineCheckbox'+response[i]['coupon_id']+'" value="'+response[i]['coupon_id']+'"><label class="form-check-label" for="inlineCheckbox'+response[i]['coupon_id']+'">'+'&nbsp &nbsp' +response[i]['coupon_name'] +'</label>';
		    		opiton += '</div>';
		    	}
 		    	$('.data-form1').append(opiton)
		    })
  		})

  		$(document).on('click','input[type="checkbox"]',function(){
            if($(this).prop("checked") == true){
                couponId.push($(this).val())
            }
            else if($(this).prop("checked") == false){
            	var index = couponId.indexOf($(this).val());
            	console.log(index)
               if (index > -1) {
				  couponId.splice(index, 1);
				}
            }
        })

  		$(document).on('click','.submit_coupon',function(){
  			var url = '/check-coupon';
		    var opiton = 'post';
		    var data = {
		    	'arr_id_coupon' : couponId,
		    	'_token': '{{ csrf_token() }}'
		    }

		     _common.request(url, data, opiton)
		    .then(function(response){
		    	if(response.code == 200) {
		    		console.log(response.data);
		    	}
		    })
  		})

  		$('.check-user').click(function(e){
  			e.preventDefault();
		    var url = '/check-user';
		    var opiton = 'get';
		    var data = {};

		     _common.request(url, data, opiton)
		    .then(function(response){
		    	if (response) {
		    		window.location.href = "{{url('/payment')}}"
		    	} else {
		    		$('#exampleModalCenter').modal('show');
		    	}
		    })

  		})

  		$('.submit-shipping').click(function(e) {
  			e.preventDefault();
  			var data = $('.data-form').serialize();
		    var url = '/shipping_info';
		    var opiton = 'POST';

		     _common.request(url, data, opiton)
		    .then(function(response){
		    	if (response.code == 200) {
		    		window.location.href = "{{url('/payment')}}"
		    	}
		    })
  		});

  		plus.click(function(e) {
		    e.preventDefault();
		    var setThis = $(this);
		    var cart_quantity_button = setThis.closest(".cart_quantity_button");
		    var product_id_change_qty = cart_quantity_button.data('id');
		    const input = cart_quantity_button.find(".cart_quantity_input");
		    var value = input.val();
		    value++;

		    var data = {
		    	'change_product_qty' :value,
		    	'product_id' : product_id_change_qty,
		    	'_token': '{{ csrf_token() }}'
		    }
		    var url = '/change-qty';
		    var opiton = 'POST';

		    _common.request(url, data, opiton)
		    .then(function(response){
		    	if (response.check_qty) {
            		input.val(value);
            		$('.total_price_'+product_id_change_qty).text(formatNumber(response.changePrice));
            		$('.total_cart_not_fee').text(formatNumber(response.totalCart));
            		var fee = $('.total_fee').text();
            		var totalCart = formatNumber(parseInt(response.totalCart) + parseInt(fee));
            		$('.total_cart').text(totalCart);

            	}
		    })
		    // $.ajax({
      //       type: 'POST',
      //       url: '/change-qty',
      //       data: data,
      //       success: function(response) {
      //       	if (response.check_qty) {
      //       		input.val(value);
      //       		$('.total_price_'+product_id_change_qty).text(formatNumber(response.changePrice));
      //       	}
      //           },
      //       error: function(error) {
      //           console.log(error)
      //       }
      //     });
	 	});

  		minus.click(function(e) {
		    e.preventDefault();
		    var setThis = $(this);
		    var cart_quantity_button = setThis.closest(".cart_quantity_button");
		    var product_id_change_qty = cart_quantity_button.data('id');
		    const input = cart_quantity_button.find(".cart_quantity_input");
		    var value = input.val();
		    if (value > 1) {
		      value--;
		    }

		    var data = {
		    	'change_product_qty' :value,
		    	'product_id' : product_id_change_qty,
		    	'_token': '{{ csrf_token() }}'
		    }
		    var url = '/change-qty';
		    var opiton = 'POST';

		    _common.request(url, data, opiton)
		    .then(function(response){
		    	if (response.check_qty) {
            		input.val(value);
            		$('.total_price_'+product_id_change_qty).text(formatNumber(response.changePrice));
            		$('.total_cart_not_fee').text(formatNumber(response.totalCart));
            		var fee = $('.total_fee').text();
            		var totalCart = formatNumber(parseInt(response.totalCart) + parseInt(fee));
            		$('.total_cart').text(totalCart);
            		// var totalCart = response.totalCart + 
            	}
		    })
		    // $.ajax({
      //       type: 'POST',
      //       url: '/change-qty',
      //       data: {'change_product_qty' : value, 'product_id': product_id_change_qty, '_token': '{{ csrf_token() }}'},
      //       success: function(response) {
      //       	if (response.check_qty) {
      //       		input.val(value);
      //       		$('.total_price_'+product_id_change_qty).text(formatNumber(response.changePrice));
      //       	}
      //           },
      //       error: function(error) {
      //           console.log(error)
      //       }
      //     });
	  	});

	  	$(".cart_quantity_input").change(function(){
	  		setThis = $(this)
	  		// var change_qty_input = $(this).val();
		    var product_id_change_qty = setThis.closest(".cart_quantity_button").data('id');
	  		var value = $(".change_cart_quantity_"+product_id_change_qty).val();

	  		var data = {
		    	'change_product_qty' :value,
		    	'product_id' : product_id_change_qty,
		    	'_token': '{{ csrf_token() }}'
		    }
		    var url = '/change-qty';
		    var opiton = 'POST';

	  		_common.request(url, data, opiton)
		    .then(function(response){
            	$('.total_price_'+product_id_change_qty).text(formatNumber(response.changePrice));
            	$('.total_cart_not_fee').text(response.totalCart);
            	var fee = $('.total_fee').text();
        		var totalCart = formatNumber(parseInt(response.totalCart) + parseInt(fee));
        		$('.total_cart').text(totalCart);
		    })

	    	// $.ajax({
      //       type: 'POST',
      //       url: '/change-qty',
      //       data: {'change_product_qty' : value, 'product_id': product_id_change_qty, '_token': '{{ csrf_token() }}'},
	     //        success: function(response) {
	     //        		$('.total_price_'+product_id_change_qty).text(formatNumber(response.changePrice));
	     //            },
	     //        error: function(error) {
	     //            console.log(error)
	     //        }
	     //      });
	  	});

	  	$('.cart_quantity_delete').click(function(){
	  		var setThis = $(this);
	  		var id_remove = setThis.closest('.cart_delete').data('id');
	  		// console.log(setThis.closest('cart_delete_'+id_remove))
	  		var data = {
		    	'id_remove' :id_remove
		    }

		    var url = '/remove-item';
		    var opiton = 'GET';

	  		_common.request(url, data, opiton)
		    .then(function(response){
            	setThis.closest('.cart_delete_'+id_remove).remove()
            	$('.total_cart_not_fee').text(formatNumber(response.totalCart));
            	var fee = $('.total_fee').text();
        		var totalCart = formatNumber(parseInt(response.totalCart) + parseInt(fee));
        		$('.total_cart').text(totalCart);
		    })
	  		 // $.ajax({
      //       type: 'get',
      //       url: '/remove-item',
      //       data: {'id_remove' : id_remove},
      //       success: function(response) {
      //       		setThis.closest('.cart_delete_'+id_remove).remove()
            		
      //           },
      //       error: function(error) {
      //           console.log(error)
      //       }
      //     });
	  	})

	  	function formatNumber(x) {
		    if(!x) x = 0;
		    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	  	}
	});	
</script>		
@endsection