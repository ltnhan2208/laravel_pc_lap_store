<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Smart Shop Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

{{-- scroll top --}}
{{-- <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script> --}}
{{--  --}}

<!-- //for-mobile-apps -->
<link href="{{URL::asset('public/style_admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" >
  <script src="{{URL::asset('public/style_admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('public/style_admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
  <script src="{{URL::asset('public/style_admin/js/demo/datatables-demo.js')}}"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<link href="{{URL::asset("public/fe/css/bootstrap.css")}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{URL::asset("public/fe/css/nghia_custom.css")}}" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{URL::asset("public/fe/css/jquery-ui.css")}}">
<link href="{{URL::asset("public/fe/css/style.css")}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{URL::asset("public/fe/css/css.css")}}" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('public/fe/css/modelpopup.css')}}">
<!-- //for bootstrap working -->
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic' rel='stylesheet' type='text/css'>
<script src="{{URL::asset('public/fe/js/jquery.easing.min.js')}}"></script>
{{-- ADD Bootstrap 5 --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

{{-- SweetAlert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
{{-- Semantic UI --}}
<link rel="stylesheet" type="text/css" href="{{URL::asset('node_modules/Semantic-UI-master/dist/semantic.min.css')}}">
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="{{URL::asset('node_modules/Semantic-UI-master/dist/semantic.min.js')}}"></script>
{{--  --}}
</head>
<body>
	<i class="fas fa-chevron-up" id="scroll"></i>

<section class="container-fluid header__top">
  	<div class="row">
  			@if($vtHeadCheck != 0)
  	@foreach($vtHead as $vtHead)
		<a href="{{url('chi-tiet-banner/'.$vtHead->bnMa)}}"  class="col-lg-12 banner__header" style="background-image: url({{URL::asset('public/images/banners/'.$vtHead->bnHinh)}});background-size: cover;width: 100%;">
		</a>
		@endforeach
		@endif
  	</div>

  		<div class="row">
  			<div class="col-lg-6">
  				<div class="header__top--left">
  					@if($vtLogoCheck != 0)
  					@foreach($vtLogo as $vtLogo)
  					<img alt="WP Compu Care" style="width:280px;"  src="{{URL::asset('public/images/banners/'.$vtLogo->bnHinh)}}">
  					@endforeach
						@endif
  				</div>
  			</div>

  			<div class="col-lg-6 header__top--right">
  					<ul class="top__right--menu">
  						<li class="menu__item">
  							<a href="{{URL::to('/')}}">
  								<i class="fas fa-home" ></i>&nbsp;Trang chủ
  							</a>
  						</li>
  						<li class="menu__item">
  							<a href="{{URL::to('product')}}">
  							<i class="fas fa-tv" ></i>&nbsp;Sản phẩm
  							</a>
  							<ul class="item__menu--child">
	  							<li class="item__triangle"></li>
	  							<div class="box__list--item">
	  							<li class="menu__child--item">
	  								<a href="{{URL::to('product')}}"><i class="far fa-heart" ></i>&nbsp;Sản phẩm 
	  								</a>
	  							</li>
	  							<li class="menu__child--item">
	  								<a href="{{URL::to('checkSerialpage')}}">
			  								<i class="fas fa-info-circle" ></i>&nbsp;Kiểm tra sản phẩm
										</a>
	  								</a>
	  							</li>
	  						</div>
	  						</ul>
  						</li>
  						<li class="menu__item">
  							<a href="{{URL::to('danh-sach-tin-tuc')}}">
  							<i class="fas fa-tv" ></i>&nbsp;Tin tức
  							</a>
  						</li>
  						<!--php-->
  						@if(Auth::guard('khachhang')->check())
  						<li class="menu__item">
	  						<a  href="{{url("/infomation/".Auth::guard('khachhang')->user()->khMa)}}">
	  							@if(Auth::guard('khachhang')->user()->khHinh!=null)
									<img style="width: 30px;height: 30px;border-radius: 360px;" src="{{URL::asset('public/images/khachhang/'.Auth::guard('khachhang')->user()->khHinh)}}" />
									@else
						   			<i class="fas fa-user-circle" style="font-size: 28px;color: lightgrey;position: relative;top:3px"></i>
									@endif 
									&nbsp;{{Auth::guard('khachhang')->user()->khTen}}
	  						</a>
	  						<ul class="item__menu--child">
	  							<li class="item__triangle"></li>
	  							<div class="box__list--item">
	  							<li class="menu__child--item">
	  								<a href="{{url("/infomation/".Auth::guard('khachhang')->user()->khMa)}}">
					 				<i class="fas fa-info-circle" ></i>&nbsp;Thông tin cá nhân
					 				</a>
	  							</li>
	  							<li class="menu__child--item">
	  								<a href="{{URL::to('wishlist')}}"><i class="far fa-heart" ></i>&nbsp;Sản phẩm yêu thích
	  								</a>
	  							</li>
	  							<li class="menu__child--item">
	  								<a href="{{URL::to('listorder')}}"><i class="far fa-file-alt" ></i>&nbsp;Đơn hàng
	  								</a>
	  							</li>
	  							<li class="menu__child--item">
	  								<a href="{{URL::to('logout')}}">
					 						<i class="fas fa-power-off" ></i>&nbsp;Đăng xuất
					 				</a>
	  							</li>
	  						</div>
	  						</ul>
	  					</li>
  						@else
  						<li class="menu__item">
  							<a href="{{URL::to('login')}}">
  								<i class="fas fa-user-circle" ></i>&nbsp;Đăng nhập
  							</a>
  						</li>
  						@endif
  						<!--endphp-->
  					</ul>
  			</div>
  		</div>
  					<!--------menu mobile ----------->
				<input id="show" type="checkbox" hidden />
  		<label for="show" class="menu__sm"><i class="fas fa-bars" style="font-size: 20px;"></i></label>
			<!----menu con --->
			<div class="box__menu">
				<h3> 
					@if(Auth::guard('khachhang')->check())
						<a href="{{url("/infomation/".Auth::guard('khachhang')->user()->khMa)}}">
	  							@if(Auth::guard('khachhang')->user()->khHinh!=null)
									<img style="width: 30px;height: 30px;border-radius: 360px;" src="{{URL::asset('public/images/khachhang/'.Auth::guard('khachhang')->user()->khHinh)}}" />
									@else
						   			<i class="fas fa-user-circle" style="font-size: 28px;color: lightgrey;position: relative;top:3px"></i>
									@endif 
									&nbsp;<span>{{Auth::guard('khachhang')->user()->khTen}}</span>
	  						</a>
	  				@endif

	  					<label for="show" class="exit__menu">
						<span>Menu</span>&nbsp;<i class="fas fa-sign-out-alt"></i>
						</label>
				</h3>
				<hr/>
				<ul class="menu__sm--child">
						<li>
  							<a href="{{URL::to('/')}}">
  								<i class="fas fa-home" ></i>&nbsp;Trang chủ
  							</a>
  						</li>
	  							<li>
	  								<a href="{{URL::to('product')}}"><i class="far fa-heart" ></i>&nbsp;Sản phẩm 
	  								</a>
	  							</li>
	  							<li>
	  								<a href="{{URL::to('checkSerialpage')}}">
			  								<i class="fas fa-info-circle" ></i>&nbsp;Kiểm tra sản phẩm
										</a>
	  								</a>
	  							</li>
  						</li>
  						<li>
  							<a href="{{URL::to('danh-sach-tin-tuc')}}">
  							<i class="fas fa-tv" ></i>&nbsp;Tin tức
  							</a>
  						</li>
  						<!--php-->
  						@if(Auth::guard('khachhang')->check())
  						<li>
	  							<li>
	  								<a href="{{url("/infomation/".Auth::guard('khachhang')->user()->khMa)}}">
					 				<i class="fas fa-info-circle" ></i>&nbsp;Thông tin cá nhân
					 				</a>
	  							</li>
	  							<li>
	  								<a href="{{URL::to('wishlist')}}"><i class="far fa-heart" ></i>&nbsp;Sản phẩm yêu thích
	  								</a>
	  							</li>
	  							<li>
	  								<a href="{{URL::to('listorder')}}"><i class="far fa-file-alt" ></i>&nbsp;Đơn hàng
	  								</a>
	  							</li>
	  							<li>
	  								<a href="{{URL::to('logout')}}">
					 						<i class="fas fa-power-off" ></i>&nbsp;Đăng xuất
					 				</a>
	  							</li>
	  					</li>
  						@else
  						<li>
  							<a href="{{URL::to('login')}}">
  								<i class="fas fa-user-circle" ></i>&nbsp;Đăng nhập
  							</a>
  						</li>
  						@endif
				</ul>
			</div>

			<!----end menu con--->
  	</section>
  	<!---Cart-->
		<a class="link__cart" href="{{URL::to('/checkout')}}">
  			<img id="img__cart" src="{{URL::asset('public/images/default/shopping-cart.png')}}" />
  			<span id="cart">{{Cart::count()}}</span>
		</a>
		<!------>
@yield('content')

		<!-----------FOOTER------------->
    
    {{--  --}}
   					<div class="container-fluid box__footer" style="background-color: #252d39;">
   					<div class="container">
   						<div class="row footer">
   							<div class="col-lg-3 list__footer">
   								<ul><h5>Hỗ trợ khách hàng</h5>
   									<div class="border__span"></div>
   									<li>Hotline chăm sóc khách hàng:<br/>
   										19000091
   									</li>
   									<li>Email liên hệ:<b> nguyenchinghia199916@gmail.com</b></li>
   								</ul>
   							</div>
   							<div class="col-lg-3 list__footer">
   								<ul><h5>Về STUCPT</h5>
   									<div class="border__span"></div>
   									<li><a href="{{URL::to('')}}">Giới thiệu STUCPT</a></li>
   									<li>Tuyển dụng</li>
   									<li>Chính sách đổi trả</li>
   									<li>Phương thức vận chuyển</li>
   								</ul>
   							</div>
   							
   						{{-- 	<div class="col-lg-3 list__footer">
   								<ul><h5>Kết nối với chúng tối</h5>
   									<div class="border__span"></div>
   									<li>
   										<a><i class="fab fa-facebook-square" style="font-size: 28px;color: #34A5F4"></i></a>&emsp;
   										<a><i class="fab fa-twitter-square" style="font-size: 28px;color: #34A5F4"></i></a>
   									</li>
   									
   								</ul>
   							</div> --}}
   							<div class="col-lg-5 list__footer">
   								<ul><h5>Đăng ký nhận tin tức từ cửa hàng:</h5>
   									<div class="border__span"></div>
   									<li>
   										
   									</li>
   									<li>
   										<form class="row justify-content-around">
   											<div class="col-lg-8 col-sm-8">
   											<input type="email" name="email" id="email__tintuc" class="form-control" >
   										</div>
   										<div class="col-lg-4 col-sm-4">
   											<button type="submit" id="btnEmail" class="btn btn-primary">Xác nhận</button>
   										</div>
   										</form>
   									</li>
   									
   								</ul>
   							</div>
   						</div>
   						
   						<div class="row footer__br"></div>
   						<div class="row" style="margin: 0;padding: 0;">
   							<div class="col-lg-6 footer" style="margin: 0;padding: 0;">
   								<br/>
   								<p>Địa chỉ cửa hàng: 180 Cao Lỗ, phường 10, Quận 8, thành phố Hồ Chí Minh</p>

                  <p>STUCPT nhận đặt hàng trực tuyến và giao hàng tận nơi, và đội ngũ nhân viên hướng dẫn khách hàng mua hàng tận tình tại cửa hàng</p>
                  <br/>
   							</div>
   						</div>
   						<div class="row footer__br"></div>
   						<div class="row" style="margin: 0;padding: 0;">
   								<div class="col-lg-6 footer" style="margin: 0;padding: 0;">
   									<br/>
   								<p>© 2021 - Bản quyền của Công Ty Cổ Phần STUCPT - STUCPT.com</p>
								<p>Giấy chứng nhận Đăng ký Kinh doanh số 0908712023 do Sở Kế hoạch và Đầu tư Thành phố Hồ Chí Minh cấp ngày 06/01/2021
								</p>
   							</div>
   							<div class="col-lg-6 footer" style="text-align: right;margin: 0;padding: 0;">
   								<img width="40" height="40" src="{{URL::asset('public/images/footer/bo-cong-thuong-2.png')}}" />
   								<img src="{{URL::asset('public/images/footer/bo-cong-thuong.svg')}}"/>
   							</div>
   						</div>
   					</div>
   				</div>
   				<!------------END FOOTER------------->
<!-- js -->
<script type="text/javascript" src="{{URL::asset("public/fe/js/jquery-2.1.4.min.js")}}"></script>

<!-- //js -->
<!-- cart -->
	<script src="{{URL::asset("public/fe/js/simpleCart.min.js")}}"></script>
	<script type="text/javascript" src="{{URL::asset('public/fe/js/bootstrap-3.1.1.min.js')}}"></script>
<!-- cart -->
<script src="{{URL::asset("public/fe/js/js.js")}}"></script>
<script src="{{URL::asset("public/fe/js/slideproduct.js")}}"></script>
<script type="text/javascript">
	// SCROLL TOP
    
     var nut = document.getElementById("scroll");
        //Truy xuất icon
        nut.onclick = function(){
            var chieucaoht = self.pageYOffset;
            // lấy chiều cao hiện tại của trang
            var set = chieucaoht;
            var run = setInterval(function(){
                chieucaoht = chieucaoht - 0.05*set;
                window.scrollTo(0,chieucaoht);    
                if(chieucaoht <= 0){
                    clearInterval(run);
                }        
            },15)
        }
</script>
<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "695422581287442");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <script type="text/javascript">
    	$(document).on('click','#btnEmail',function(e){
    		e.preventDefault();
    		var id = document.getElementById("email__tintuc").value;
    		$.ajax({
    			type:"GET",
    			url:"add-email-tin-tuc/"+id,
    			dataType:"JSON",
    			data:{
    				id,
    			},
    			success:function(response)
    			{
    				var result = response.message;
    				if(result == 0)
    				{
    					Swal.fire({
							  icon: 'success',
							  text:  'Đăng ký email nhận tin tức thành công!',
							});
    				}
    				else
    				{
    					Swal.fire({
								  icon: 'error',
								  text:  'Email này đã đăng ký!',
								});
    				}
    			}
    		});
    	});
    </script>
    
	@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('err')}}',
})
</script> 
@endif
		 
	
	
		

</body>
</html>