<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Smart Shop Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
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
<script type="text/javascript" src="{{URL::asset("public/fe/js/jquery-2.1.4.min.js")}}"></script>
{{-- ADD Bootstrap 5 --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

{{-- SweetAlert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<body id="form__body">

<section class="container-fluid header__top" style="background-color: #252d39;">
  		
	
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
  								<i class="fas fa-home" ></i>&nbsp;Trang ch???
  							</a>
  						</li>
  						<li class="menu__item">
  							<a href="{{URL::to('product')}}">
  							<i class="fas fa-tv" ></i>&nbsp;S???n ph???m
  							</a>
  						</li>
  						<!--php-->
  						@if(View::hasSection('login'))
					    	<li class="menu__item"><a href="{{URL::to('login')}}"><i class="fas fa-user-circle" ></i>&nbsp;@yield('login')</a></li>
					    	@endif
					    	@if(View::hasSection('register'))
					    	<li class="menu__item"><a href="{{URL::to('register')}}"><i class="fas fa-user-plus"></i>&nbsp;@yield('register')</a></li>
					    	@endif	
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
  								<i class="fas fa-home" ></i>&nbsp;Trang ch???
  							</a>
  						</li>
	  							<li>
	  								<a href="{{URL::to('product')}}"><i class="far fa-heart" ></i>&nbsp;S???n ph???m 
	  								</a>
	  							</li>
	  							<li>
	  								<a href="{{URL::to('checkSerialpage')}}">
			  								<i class="fas fa-info-circle" ></i>&nbsp;Ki???m tra s???n ph???m
										</a>
	  								</a>
	  							</li>
  						</li>
  						<li>
  							<a href="{{URL::to('danh-sach-tin-tuc')}}">
  							<i class="fas fa-tv" ></i>&nbsp;Tin t???c
  							</a>
  						</li>
  						<!--php-->
  						@if(Auth::guard('khachhang')->check())
  						<li>
	  							<li>
	  								<a href="{{url("/infomation/".Auth::guard('khachhang')->user()->khMa)}}">
					 				<i class="fas fa-info-circle" ></i>&nbsp;Th??ng tin c?? nh??n
					 				</a>
	  							</li>
	  							<li>
	  								<a href="{{URL::to('wishlist')}}"><i class="far fa-heart" ></i>&nbsp;S???n ph???m y??u th??ch
	  								</a>
	  							</li>
	  							<li>
	  								<a href="{{URL::to('listorder')}}"><i class="far fa-file-alt" ></i>&nbsp;????n h??ng
	  								</a>
	  							</li>
	  							<li>
	  								<a href="{{URL::to('logout')}}">
					 						<i class="fas fa-power-off" ></i>&nbsp;????ng xu???t
					 				</a>
	  							</li>
	  					</li>
  						@else
  						<li>
  							@if(View::hasSection('login'))
					    	<a href="{{URL::to('login')}}"><i class="fas fa-user-circle" ></i>&nbsp;@yield('login')</a>
					    	@endif
					    	@if(View::hasSection('register'))
					    <a href="{{URL::to('register')}}"><i class="fas fa-user-plus"></i>&nbsp;@yield('register')</a>
					    	@endif	
  							
  						</li>
  						@endif
				</ul>
			</div>

			<!----end menu con--->
  	</section>	
@yield('content');
		<!-----------FOOTER------------->
   				<div class="container-fluid box__footer" style="background-color: #252d39;">
   					<div class="container">
   						<div class="row footer">
   							<div class="col-lg-3 list__footer">
   								<ul><h5>H??? tr??? kh??ch h??ng</h5>
   									<div class="border__span"></div>
   									<li>Hotline ch??m s??c kh??ch h??ng:<br/>
   										19000091
   									</li>
   									<li>Email li??n h???:</li>
   									<li>H?????ng d???n tr??? g??p</li>
   								</ul>
   							</div>
   							<div class="col-lg-3 list__footer">
   								<ul><h5>V??? Compu-Care</h5>
   									<div class="border__span"></div>
   									<li>Gi???i thi???u Compu-Care</li>
   									<li>Tuy???n d???ng</li>
   									<li>Ch??nh s??ch ?????i tr???</li>
   									<li>Ph????ng th???c v???n chuy???n</li>
   								</ul>
   							</div>
   							{{-- <div class="col-lg-3 list__footer">
   								<ul><h5>S???n ph???m ???????c quan t??m</h5>
   									<div class="border__span"></div>
   									<li>
   										@foreach($dbrand as $v)
   										<a class="col-lg-6" href="{{url('proinfo/'.$v->spMa)}}">
   											<img src="{{URL::asset('public/images/products/'.$v->spHinh)}}" /><br/>
   											<span>{{$v->spTen}}</span>
   										</a>

   										@endforeach
   									
   									</li>
   								</ul>
   							</div> --}}
   								<div class="col-lg-5 list__footer">
   								<ul><h5>C???p nh???t tin t???c</h5>
   									<div class="border__span"></div>
   									<li>
   										????? c???p nh???t tin t???c m???i t??? chung t??i b???n h??y nh???p mail
   									</li>
   									<li>
   										<form class="row justify-content-around">
   											<div class="col-lg-8 col-sm-8">
   											<input type="email" name="email" id="email__tintuc" class="form-control" >
   										</div>
   										<div class="col-lg-4 col-sm-4">
   											<button type="submit" id="btnEmail" class="btn btn-primary">X??c nh???n</button>
   										</div>
   										</form>
   									</li>
   									
   								</ul>
   							</div>
   						</div>
   						
   						<div class="row footer__br"></div>
   						<div class="row" style="margin: 0;padding: 0;">
   							<div class="col-lg-6 footer" style="margin: 0;padding: 0;">
   								<p>?????a ch??? c???a h??ng: 180 Cao L???, ph?????ng 10, Qu???n 8, th??nh ph??? H??? Ch?? Minh</p>

                  <p>Compu-Care nh???n ?????t h??ng tr???c tuy???n v?? giao h??ng t???n n??i, v?? ?????i ng?? nh??n vi??n h?????ng d???n kh??ch h??ng mua h??ng t???n t??nh t???i c???a h??ng</p>
   							</div>
   						</div>
   						<div class="row footer__br"></div>
   						<div class="row" style="margin: 0;padding: 0;">
   								<div class="col-lg-6 footer" style="margin: 0;padding: 0;">
   								<p>?? 2021 - B???n quy???n c???a C??ng Ty C??? Ph???n Compu-Care - compucare.com</p>
								<p>Gi???y ch???ng nh???n ????ng k?? Kinh doanh s??? 0908712023 do S??? K??? ho???ch v?? ?????u t?? Th??nh ph??? H??? Ch?? Minh c???p ng??y 06/01/2021
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
		<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '6054997114540513',
      cookie     : true,
      xfbml      : true,
      version    : 'v11.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
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
							  text:  '????ng k?? email nh???n tin t???c th??nh c??ng!',
							});
    				}
    				else
    				{
    					Swal.fire({
								  icon: 'error',
								  text:  'Email n??y ???? t???n t???i!',
								});
    				}
    			}
    		});
    	});
    </script>
<!-- cart -->
</body>
</html>		