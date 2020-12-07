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
			            <input type="text" class="form-control" name="shipping_name">
			          </div>
			          <div class="form-group">
			            <label for="recipient-email" class="col-form-label">Email:</label>
			            <input type="text" class="form-control" name="shipping_email">
			          </div>
			          <div class="form-group">
			            <label for="recipient-phone" class="col-form-label">Phone:</label>
			            <input type="text" class="form-control" name="shipping_phone">
			          </div>
			          <div class="form-group">
			            <label for="recipient-address" class="col-form-label">Address:</label>
			            <input type="text" class="form-control" name="shipping_address">
			          </div>
			          <div class="form-group">
			            <label for="message-text" class="col-form-label">Message:</label>
			            <textarea class="form-control" id="message-text" name="shipping_content"></textarea>
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
<script type="text/javascript">
	$(document).ready(function(){

		const minus = $('.add-down');
  		const plus = $('.add-up');

  		$('.submit-shipping').click(function(e) {
  			e.preventDefault();
  			var data = $('.data-form').serialize();
		    var url = '/shipping_info';
		    var opiton = 'POST';

		     _common.request(url, data, opiton)
		    .then(function(response){
		    	
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