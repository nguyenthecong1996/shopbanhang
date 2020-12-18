<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{asset('/fontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/fontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('/fontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('/fontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('/fontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/fontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('/fontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('/fontend/css/sweetalert.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('/fontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

    <script src="{{asset('/common.js')}}"></script>
    
    <script src="{{asset('/fontend/js/jquery.js')}}"></script>
    <script src="{{asset('/fontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/fontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('/fontend/js/price-range.js')}}"></script>
    <script src="{{asset('/fontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('/fontend/js/main.js')}}"></script>
    <script src="{{asset('/fontend/js/sweetalert.js')}}"></script>
    <style type="text/css">
        .badge {
          padding-left: 9px;
          padding-right: 9px;
          -webkit-border-radius: 9px;
          -moz-border-radius: 9px;
          border-radius: 9px;
        }

        .label-warning[href],
        .badge-warning[href] {
          background-color: #c67605;
        }
        #lblCartCount {
            font-size: 12px;
            background: #ff0000;
            color: #fff;
            padding: 0 5px;
            vertical-align: top;
            margin-left: -3px; 
        }
        
            .cart_quantity_up{
                background: #F0F0E9;
                color: #696763;
                display: inline-block;
                font-size: 16px;
                height: 28px;
                overflow: hidden;
                text-align: center;
                width: 35px;
                float: left;
            }

            .cart_quantity_down{
                background: #F0F0E9;
                color: #696763;
                display: inline-block;
                font-size: 16px;
                height: 28px;
                overflow: hidden;
                text-align: center;
                width: 35px;
                float: left;
            }    
    </style>

</head><!--/head-->
<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="{{asset('/fontend/images/logo.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            
                            <ul class="nav navbar-nav">
                                <li><a href="{{url('/login-checkout')}}"><i class="fa fa-user"></i> Tài khoản</a></li>
                                <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
                                <!-- @if(Auth::check() && Session::get('shipping_id') ==NULL)
                                <li><a href="{{url('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                @elseif(Auth::check() && Session::get('shipping_id'))
                                 <li><a href="{{url('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                @else
                                 <li><a href="{{url('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                @endif -->
                                <li><a href="{{url('/show-cart')}}">
                                        <i class="fa fa-shopping-cart"></i>
                                        Giỏ hàng
                                        <span class='badge badge-warning' id='lblCartCount'> 
                                            @if(session('cart'))
                                                {{count(session('cart'))}} 
                                            @endif    
                                        </span>
                                    </a>
                                 </li>
                               <!--  @if(Auth::check())
                                <li><a href="{{url('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                @else
                                 <li><a href="{{url('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                @endif -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('trang-chu')}}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                    
                                </li> 
                                <li><a href="404.html">Giỏ hàng</a></li>
                                <li><a href="contact-us.html">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <input type="text" placeholder="Search"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('/fontend/images/girl1.jpg')}}" class="girl img-responsive" alt="" />
                                    <img src="{{asset('/fontend/images/pricing.png')}}"  class="pricing" alt="" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>100% Responsive Design</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('/fontend/images/girl2.jpg')}}" class="girl img-responsive" alt="" />
                                    <img src="{{asset('/fontend/images/pricing.png')}}"  class="pricing" alt="" />
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free Ecommerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('/fontend/images/girl3.jpg')}}" class="girl img-responsive" alt="" />
                                    <img src="{{asset('/fontend/images/pricing.png')}}" class="pricing" alt="" />
                                </div>
                            </div>
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <!-- <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Womens
                                        </a>
                                    </h4>
                                </div>
                                <div id="womens" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Fendi</a></li>
                                            <li><a href="#">Guess</a></li>
                                            <li><a href="#">Valentino</a></li>
                                            <li><a href="#">Dior</a></li>
                                            <li><a href="#">Versace</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                            @foreach($getCategory as $item)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{URL::to('/category/'.$item->category_id)}}">{{$item->category_name}}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div><!--/category-products-->
                    
                        <!--/brands_products-->
                        
                        <!-- <div class="price-range">
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div> -->
                        
                        <!-- <div class="shipping text-center">
                            <img src="images/home/shipping.jpg" alt="" />
                        </div>
                     -->
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    @yield('content')                    
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('/fontend/images/iframe1.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('/fontend/images/iframe2.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('/fontend/images/iframe3.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('/fontend/images/home/iframe4.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{asset('/fontend/images/map.png')}}" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
</body>
<script type="text/javascript">
    $(".choose").change(function(){
          var setThis = $(this);
          var url = '';
          var opiton = '';
          var data = {};
          // console.log(address)
          if (setThis.attr('address') == 'provice') {
            $('.provice').prop("disabled", true);
            $('.wards').prop("disabled", true);
            $('.wards').find('option').remove().end().append('<option value="">Chọn xã phường</option>')
            data = {
                matp: setThis.val(),
                address : 'provice'
            };
          } else if (setThis.attr('address') == 'wards') {
                data = {
                maqh: setThis.val(),
                address : 'wards'
            };
          }
          url = '/admin/get-address';
          opiton = 'GET';

             _common.request(url, data, opiton)
            .then(function(response){
                var options = "";
                if (response['check_provice'] == 'check_provice') {
                    options += '<option value="">Chọn quận huyện</option>';
                    for(i in response['provice']) {
                        options += '<option value= "' + response['provice'][i]['maqh'] + '">' + response['provice'][i]['name_quanhuyen'] + '</option>';
                    }
                    $('#exampleFormControlSelect2').html(options);
                    $('.provice').prop("disabled", false);
                } else {
                    options += '<option value="">Chọn xã phường</option>';
                    for(i in response['wards']) {
                        options += '<option value= "' + response['wards'][i]['xaid'] + '">' + response['wards'][i]['name_xa'] + '</option>';
                    }
                    $('#exampleFormControlSelect3').html(options);
                    $('.wards').prop("disabled", false);
                }
            })
        });

        $(".modal").on("hidden.bs.modal", function(){
            $('.wards').find('option').remove().end().append('<option value="">Chọn xã phường</option>').prop("disabled", true);
            $('.provice').find('option').remove().end().append('<option value="">Chọn quận huyện</option>').prop("disabled", true);
            $('.empty-value').each(function() {
                $(this).val('');
            })

            $('.data-form1').html('');
        });
</script>
</html>