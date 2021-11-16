<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Trang chủ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
 	<link href="{{URL::asset("public/fe/css/bootstrap.css")}}" rel="stylesheet" type="text/css" media="all" />
 	<link href="{{URL::asset("public/welcome/style.css")}}" rel="stylesheet" type="text/css" media="all" /> 
	<link rel="stylesheet" type="text/css" href="{{URL::asset("public/fe/css/jquery-ui.css")}}">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="favicon.ico">
    
  </head>

  <body>
  	<i class="fas fa-chevron-up" id="scroll"></i>
  	<section class="container-fluid header__top">
  	@if($vt1Check != 0)
  	@foreach($vt1 as $vt1)
		<a class="col-lg-12 banner__header" href="{{url('chi-tiet-banner/'.$vt1->bnMa)}}" style="background-image: url({{URL::asset('public/images/banners/'.$vt1->bnHinh)}});background-size: cover;width: 100%;">
		</a>
		@endforeach
		@endif
	
  		<div class="row">
  			<div class="col-lg-6">
  				<div class="header__top--left">
  					@if($vt2Check != 0)
  					@foreach($vt2 as $vt2)
  					<img alt="WP Compu Care" style="width:280px;"  src="{{URL::asset('public/images/banners/'.$vt2->bnHinh)}}">
  					@endforeach
						@endif
  				</div>
  			</div>
  			<!--------menu mobile ----------->
  		<label for="show" class="menu__sm"><i class="fas fa-bars" style="font-size: 20px;"></i></label>
			<!----menu con --->
			<input id="show" type="checkbox" hidden/>
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
  		</div>
  		<!---Cart-->
	{{-- 	<a class="link__cart" href="{{URL::to('/checkout')}}">
  			<img id="img__cart" src="{{URL::asset('public/images/default/shopping-cart.png')}}" />
  			<span id="cart">{{Cart::count()}}</span>
		</a> --}}
		<!------>
  	</section>

  	<!--------------CONTENT-------------->
   	<section class="container-fluid wel__bg">
   		@if($vt3Check != 0)
   		@foreach($vt3 as $vt3)
   			<div class="col-lg-12 bg__video">
   				<video muted loop autoplay>
   					<source src="{{URL::asset('public/images/banners/'.$vt3->bnHinh)}}" type="video/mp4">
   				</video>
   			</div>
   			<div class="col-lg-6 bg__content">
   				<h2>{{$vt3->bnTieude}}</h2>
   			</div>
   			@endforeach
				@endif
   	</section>

   	<section class="container-fluid wel__content">
   		<div class="row">
   			<!----Vị trí 4---->
   		@if($vt4Check != 0)
   		@foreach($vt4 as $vt4)
   			<div class="col-lg-6 col-sm-12" style="margin: 0;padding: 0;">
	   			<div class="wel__content--left">
	   				<img src="{{URL::asset('public/images/banners/'.$vt4->bnHinh)}}" alt="">
	   				<div class="left__content">
	   					<div class="content__icon">
	   						<i class="fas fa-laptop" style="font-size: 60px;"></i>
	   					</div>
	   					
	   					<div class="content__text">
	   						<div>{{$vt4->bnTieude}}</div>
	   						<div class="bnNoidung">{!!$vt4->bnNoidung!!}</div>
	   						<div>
	   							<a href="{{url('chi-tiet-banner/'.$vt4->bnMa)}}">Xem thêm &emsp;<i class="fas fa-angle-right"></i></a>
	   						</div>
	   					</div>
	   				</div>
	   			</div>
	   			@endforeach
	   			@endif
   			</div>
   			<!----Vị trí 5---->
   			@if($vt5Check != 0)
   			@foreach($vt5 as $vt5)
   			<div  class="col-lg-6" style="margin: 0;padding: 0;">
	   			<div class="wel__content--right">
	   				<img src="{{URL::asset('public/images/banners/'.$vt5->bnHinh)}}" alt="">
	   				<div class="right__content">
	   					<div class="content__icon">
	   						<i class="fas fa-server" style="font-size: 60px;"></i>
	   					</div>

	   					<div class="content__text">
	   						<div>{{$vt5->bnTieude}}</div>
	   						<div class="bnNoidung">{!!$vt5->bnNoidung!!}</div>
	   						<div>
	   							<a href="{{url('chi-tiet-banner/'.$vt5->bnMa)}}">Xem thêm &emsp;<i class="fas fa-angle-right"></i></a>
	   						</div>
	   					</div>
	   				</div>
	   			</div>
   			</div>
   			@endforeach
   			@endif
   		</div>

   		<!--------------------->

   		<div class="row">
   			<div class="col-lg-2"></div>
   			<div class="col-lg-8 col-sm-12 welcome__text">
   				<h2>
   					<span>Chào mừng bạn đến với</span>
   					<span>{{$name->extraData}}</span>
   				</h2>
   				<div class="border__short"></div>
   				<div class="text">
   					Nunc feugiat augue non arcu iaculis dignissim. Curabitur laoreet elit non vestibulum ullamcorper. Ut fringilla pulvinar nibh, non suscipit justo lacinia vel. Aenean at dui pharetra est vulputate porttitor. In placerat sit amet ipsum a ullamcorper.
   				</div>
   			</div>
   			<div class="col-lg-2"></div>
   			</div><br/><br/>

   			<!---------PRODUCT---------->
   			<div class="row box__product">
   				<div class="container"><h3>SẢN PHẨM NỐI BẬT</h3></div>
   				<hr/>
   				<div id="left__arr"  class="col-lg-1 product__arrow">
   					<i class="fas fa-chevron-left" style="font-size: 48px;"></i>
   				</div>
   				
   				<div class="col-lg-10">
   					<div class="row list__product">
   						@foreach($db as $v)
   						<div class="product">
   							<div class="link__proInfo">
   								<a href="{{url('proinfo/'.$v->spMa)}}">Xem chi tiết</a>
   							</div>
   							<img src="{{URL::asset('public/images/products/'.$v->spHinh)}}" /><br/>
   							<span class="title__pro">{{$v->spTen}}</span><br/>
   							<h4 class="text-danger">{{number_format($v->spGia)}}VND</h4>
   					{{-- 		<button type="button" class="btn btn-primary btn__addCart" value="{{$v->spMa}}"><i class="far fa-cart-arrow-down" style="font-size: 18px;"></i>&nbsp;Thêm vào giỏ hàng</button> --}}
   						</div>
   						
   						@endforeach
   					</div>
   				</div>
   				<div id="right__arr" class="col-lg-1 product__arrow">
   					<i class="fas fa-chevron-right" style="font-size: 48px;"></i>
   				</div>
   			</div>
   		

   			<br/><br/>
   			<!-----------------CONTENT AND FOOTER----------------->
   			<div class="col-lg-12 mid__content">
   				<!-----------CONTENT------------->
   				<!--Vị trí 6-->
   				@if($vt6Check != 0)
   				@foreach($vt6 as $vt6)
   				<div class="row content__pro">
   					<div class="col-lg-6 content__pro--img">
   						<img src="{{URL::asset('public/images/banners/'.$vt6->bnHinh)}}" class="vc_single_image-img attachment-full"/>
   					</div>
			   		<div class="col-lg-1 content__pro--border">
			   		<div></div>
			   		</div>
   					<div class="col-lg-5 content__pro--text">
   						<h2>{{$vt6->bnTieude}}</h2>
   						<br/>
   						<div class="bnNoidung2">
   							{!!$vt6->bnNoidung!!}
   						</div>
   						
   						<a href="{{url('chi-tiet-banner/'.$vt6->bnMa)}}">Xem thêm</a>
   					</div>
   				</div>
   				@endforeach
   				@endif
   				<!--Vị trí 7-->
   				@if($vt7Check != 0)
   				@foreach($vt7 as $vt7)
   				<div class="row content__pro">
   					<div class="col-lg-5 content__pro--text">
   						<h2>{{$vt7->bnTieude}}</h2>
   						<br/>
   						<div class="bnNoidung2">
   							{!!$vt7->bnNoidung!!} 
   						</div>
   					
   						<a href="{{url('chi-tiet-banner/'.$vt7->bnMa)}}">Xem thêm</a>
   					</div>
   					<div class="col-lg-1 content__pro--border">
   						<div></div>
   					</div>
   					<div class="col-lg-6 content__pro--img">
   						<img src="{{URL::asset('public/images/banners/'.$vt7->bnHinh)}}" class="vc_single_image-img attachment-full"/>
   					</div>
   				</div>
   				@endforeach
   				@endif
   				<!--vị trí 8-->
   				@if($vt8Check != 0)
   				@foreach($vt8 as $vt8)
   				<div class="row content__pro">
   					<div class="col-lg-6 content__pro--img">
   						<img src="{{URL::asset('public/images/banners/'.$vt8->bnHinh)}}" class="vc_single_image-img attachment-full"/>
   					</div>
			   		<div class="col-lg-1 content__pro--border">
			   			<div></div>
			   		</div>
   					<div class="col-lg-5 content__pro--text">
   						<h2>{{$vt8->bnTieude}}</h2>
   						<br/>
   						<div class="bnNoidung2">
   							{!!$vt8->bnNoidung!!}
   						</div>
   					
   						<a href="{{url('chi-tiet-banner/'.$vt8->bnMa)}}">Xem thêm</a>
   					</div>
   				</div>
   				@endforeach
   				@endif

   				<!------------END CONTENT------------>
   				<!-----------FOOTER------------->   				{{-- chat box --}}
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
    {{--  --}}
   				<div class="container-fluid box__footer">
   					<div class="container">
   						<div class="row footer">
   							<div class="col-lg-3 list__footer">
   								<ul><h5>Hỗ trợ khách hàng</h5>
   									<div class="border__span"></div>
   									<li>Hotline chăm sóc khách hàng:<br/>
   										19000091
   									</li>
   									<li>Email liên hệ:</li>
   									<li>Hướng dẫn trả góp</li>
   								</ul>
   							</div>
   							<div class="col-lg-3 list__footer">
   								<ul><h5>Về  {{$name->extraData}}</h5>
   									<div class="border__span"></div>
   									<li>Giới thiệu  {{$name->extraData}}</li>
   									<li>Tuyển dụng</li>
   									<li>Chính sách đổi trả</li>
   									<li>Phương thức vận chuyển</li>
   								</ul>
   							</div>
   							
   					{{-- 		<div class="col-lg-3 list__footer">
   								<ul><h5>Kết nối với chúng tối</h5>
   									<div class="border__span"></div>
   									<li>
   										<a><i class="fab fa-facebook-square" style="font-size: 28px;color: #34A5F4"></i></a>&emsp;
   										<a><i class="fab fa-twitter-square" style="font-size: 28px;color: #34A5F4"></i></a>
   									</li>
   									
   								</ul>
   							</div> --}}
   								<div class="col-lg-5 list__footer">
   								<ul><h5>Cập nhật tin tức</h5>
   									<div class="border__span"></div>
   									<li>
   										Để cập nhật tin tức mới từ chung tôi bạn hãy nhập mail
   									</li>
   									<li>
   										<form class="row justify-content-around">
   											<div class="col-lg-8 col-sm-8">
   											<input type="email" name="email" id="email__tintucc" class="form-control" >
   										</div>
   										<div class="col-lg-4 col-sm-4">
   											<button type="submit" id="btnEmaill" class="btn btn-primary">Xác nhận</button>
   										</div>
   										</form>
   									</li>
   									
   								</ul>
   							</div>
   						</div>
   						<hr/>
   						<div class="row">
   							<div class="col-lg-6 footer">
   								<p>Địa chỉ cửa hàng: 180 Cao Lỗ, phường 10, Quận 8, thành phố Hồ Chí Minh</p>

                  <p> {{$name->extraData}} nhận đặt hàng trực tuyến và giao hàng tận nơi, và đội ngũ nhân viên hướng dẫn khách hàng mua hàng tận tình tại cửa hàng</p>
   							</div>
   						</div>
   						<hr/>
   						<div class="row">
   								<div class="col-lg-6 footer">
   								<p>© 2021 - Bản quyền của Công Ty Cổ Phần thương mại {{$name->extraData}} - cgnghia.com</p>
								<p>Giấy chứng nhận Đăng ký Kinh doanh số 0908712023 do Sở Kế hoạch và Đầu tư Thành phố Hồ Chí Minh cấp ngày 06/01/2021
								</p>
   							</div>
   							<div class="col-lg-6 footer" style="text-align: right;">
   								<img width="40" height="40" src="{{URL::asset('public/images/footer/bo-cong-thuong-2.png')}}" />
   								<img src="{{URL::asset('public/images/footer/bo-cong-thuong.svg')}}"/>
   							</div>
   						</div>
   					</div>
   				</div>
   				<!------------END FOOTER------------->
   			</div>
   		<!------------------>
   	</section>

	<!-- js -->
	

	<script type="text/javascript" src="{{URL::asset("public/fe/js/jquery-2.1.4.min.js")}}"></script>
	<script type="text/javascript" src="{{URL::asset('public/fe/js/bootstrap-3.1.1.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('public/welcome/js.js')}}"></script>
{{-- 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 --}}
<script src="{{URL::asset("public/fe/js/simpleCart.min.js")}}"></script>
{{-- <script type="text/javascript">
		$(document).on('click','.btn__addCart',function(e){
			e.preventDefault();
			
			var id = $(this).val();
			$.ajax({
				TYPE:"GET",
				url:'save-cart/'+id,
				dataType:'JSON',
				data:{id, 
				},
				success:function(response)
				{
					var cart = document.getElementById("cart").innerHTML;
					var x = Number(cart);
					var sum = x + 1;
					result = response.message;
					if(result== 0)
					{
						Swal.fire({
					  icon: 'success',
					  title: 'Thông báo: ',
					  text: 'Đã thêm sản phẩm vào giỏ hàng',
					  footer: '<a href="{{URL::to('checkout')}}" class="btn btn-outline-warning">Tới giỏ hàng</a></span>'
					});
						document.getElementById("cart").innerHTML = sum;
					}
					else
					{
						wal.fire({
					  icon: 'error',
					  title: 'Thông báo: ',
					  text: 'Sản phẩm đã hết hàng',
					});
					}
				}
			});

		});
</script> --}}
 <script type="text/javascript">
    	$(document).on('click','#btnEmaill',function(e){
    		e.preventDefault();
    		var id = document.getElementById("email__tintucc").value;
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
								  text:  'Email này đã tồn tại!',
								});
    				}
    			}
    		});
    	});
    </script>
  </body>
</html>
