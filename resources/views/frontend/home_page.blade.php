@extends('frontend_layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    @foreach($all_product as $item)
        <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <form>
                            <input type="hidden" value="{{$item->product_image}}" class="cart_product_image_{{$item->product_id}}">
                            <input type="hidden" value="{{$item->product_name}}" class="cart_product_name_{{$item->product_id}}">
                            <input type="hidden" value="{{$item->product_price}}" class="cart_product_price_{{$item->product_id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$item->product_id}}">
                            <a href="{{URL::to('/product-detail/'.$item->product_id)}}">
                                <img src="{{('/uploads/'.$item->product_image)}}" alt="" width="100" height="200" />
                                <h2>{{number_format($item->product_price)}}</h2>
                                <p>{{$item->product_name}}</p>
                            </a>    
                            <button type="button" class="btn btn-default add-to-cart" data-id="{{$item->product_id}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </form>    
                    </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
        </div>
    @endforeach
</div><!--features_items-->
<script type="text/javascript">
    $(document).ready(function(){
      $(".add-to-cart").click(function(){
        var product_id = $(this).data('id');
        var cart_product_name = $('.cart_product_name_'+product_id).val();
        var cart_product_image = $('.cart_product_image_'+product_id).val();
        var cart_product_qty = parseInt($('.cart_product_qty_'+product_id).val());
        var cart_product_price = $('.cart_product_price_'+product_id).val();

        $.ajax({
            type: 'POST',
            url: '/cart-product',
            data: {'cart_product_name' : cart_product_name, 'cart_product_qty' : cart_product_qty,'cart_product_price': cart_product_price, 'cart_product_image': cart_product_image, 'product_id': product_id,  '_token': '{{ csrf_token() }}'},
            success: function(response) {
                if (Object.keys(response).length !== 0 && response.constructor === Object) {
                    $('#lblCartCount').html(Object.keys(response).length);
                }
                swal({
                  title: "Đã thêm vào giỏ hàng",
                  text: "Bạn có thể mua tiếp hoặc tới giỏ hàng để thanh toán",
                  showCancelButton: true,
                  confirmButtonClass: "btn-info",
                  cancelButtonText: "Xem tiếp",
                  confirmButtonText: "Đến giỏ hàng ",
                  closeOnConfirm: false
                },
                function(){
                  window.location.href = "{{url('/add-cart')}}"
                });
                },
            error: function(error) {
                console.log(error)
            }
          });
        });
    });
</script>
@endsection
