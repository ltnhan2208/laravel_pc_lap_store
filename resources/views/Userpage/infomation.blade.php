@extends('Userpage.layout')
@section('title')
Thông tin cá nhân
@endsection
@section('content')

<!-- banner -->
<br/>
<!---Content--->
<section class="infomation">
 <div class="container-fluid">
	<div class="row">
					@if($vt1Check != 0)
	@foreach($vt1 as $vt1)
<a href="{{url('chi-tiet-banner/'.$vt1->bnMa)}}"  class="quang__cao" style="width: 12.3%;background-image: url({{URL::asset('public/images/banners/'.$vt1->bnHinh)}});background-size: cover;"></a>
@endforeach
@endif
		<div class="col-lg-9">
			<h3>THÔNG TIN CỦA BẠN</h3>
				<hr/>
			@foreach($data as $v)
				<form class="col-lg-12 box__info" action="{{URL::to("edit_infomation/".$v->khMa)}}" method="POST" enctype="multipart/form-data">
					  {{csrf_field()}}

				<div class="information__img text-center">
					<span id="btnImg__cancel"><i class="fas fa-times" style="font-size: 30px;color: red;"></i></span>
					@if($v->khHinh!=null)
					 <img id="img__default" src="{{{'../public/images/khachhang/'.$v->khHinh}}}" />
					 @else
					 <div id="box__img">
					 	<span>Chưa có ảnh đại diện <br/> <i class="fas fa-portrait"></i></span>
					 </div>
					 @endif
					 <img id="img__change" src="" alt=""/>
					 <div id="file__name" class="row"></div>
					 <br/>
					 <input id="khHinh" name="khHinh" type="file" />
					 &nbsp;<label onclick="defaultAction()" id="lb__khHinh" class="lb__khHinh">
					 	<i class="fas fa-camera"></i>
					 </label>
					<br/><br/>
				</div>
				<!---------------end ảnh------------->
				<div class="row justify-content-between">
				<div class="col-lg-5">
				<div class="flex__info">
					<span class="info__icon"><i class="fas fa-user"></i>&nbsp;</span>
					<span class="info__item  info__item--title">Tên:</span>
					<span class="info__item">
						<input onblur="onName()" id="ip__name" class="ip" type="text" value="{{$v->khTen}}" name="khTen"/>
					</span>
					 <div>
						<br/>
						<br/>
						 <span style="color:red">{{$errors->first('khTen')}}</span>
					<span style="margin-left: -6rem;" id="name__err--regis"></span>
					</div>
				</div>
				<br/>
				<div class="flex__info">
					<span class="info__icon"><i class="fas fa-user-circle"></i>&nbsp;</span>
					<span class="info__item info__item--title">Tên đăng nhập:</span>
					
					<span  class="info__item">
						<input class="ip" type="text"  value="{{$v->khTaikhoan}}" name="khTaikhoan"/>
					</span>
					<span style="color:red">{{$errors->first('khTaikhoan')}}</span>
				</div>
				<br/><br/>
				<div class="flex__info">
					<span class="info__icon"><i class="fas fa-envelope"></i>&nbsp;</span>
					<span class="info__item  info__item--title">Email:</span>
					
					<span class="info__item">	
						<input readonly="" class="ip" type="email" value="{{$v->khEmail}}" name="khEmail"/>
					</span>
					 <span style="color:red">{{$errors->first('khEmail')}}</span>
				</div>
				<br/>
				<div class="flex__info">
						@if($v->khXtemail!=1)
						<span class="email__item " style="color: red;">Email chưa xác thực!</span>
						<span><a href="{{URL::to('verify-email/'.$v->khMa)}}" class="btn btn-warning">Xác thực Email</a></span>
						@else
						<input class="ip" hidden value="{{$v->khEmail}}" name="khEmail">
						<span class="email__item text-right"><a  class="btn btn-secondary" href="{{URL::to('changeEmail/'.$v->khMa)}}">Thay đổi Email</a>
						</span>
						@endif
					 @if(Session::has('Cemail_err'))
					  <span style="color:red">{{Session::get('Cemail_err')}}</span>
					 @endif
				</div>
				<br/>
				<br/><br/>
				 <a class="btn_editPass btn_editPass-hide" href="{{url('updatePass/'.$v->khMa)}}">Đổi mật khẩu</a>
				</div>
				<div class="col-lg-5">
				<div class="flex__info">
					<span class="info__icon"><i class="fas fa-mobile"></i>&nbsp;</span>
					<span class="info__item  info__item--title">Số điện thoại:</span>
				
					<span class="info__item" class="info__item">
						<input onblur="onSDT()" id="sdt" class="ip" type="text" value="{{$v->khSdt}}" name="khSdt"/>
					</span>
					<div>
						<br/>
						<br/>
						<span style="color:red">{{$errors->first('khSdt')}}</span>
					<span style="margin-left: -10rem;color: red;" id="sdt__err--regis"></span>
					</div>
				</div>
				<br/>
				<div class="flex__info">
					<span class="info__icon"><i class="fas fa-map-marker-alt"></i>&nbsp;</span>
					<span class="info__item  info__item--title">Địa chỉ:</span>
					
					<span  class="info__item" class="info__item">
						<input onblur="onAddress()" id="address" class="ip" type="text" value="{{$v->khDiachi}}" name="khDiachi"/>
					</span>
						<div>
						<br/>
						<br/>
						<span style="color:red">{{$errors->first('khDiachi')}}</span>
					<span style="margin-left: -10rem;" id="address__err--regis"></span>
					</div>
				</div>
				<br/>
				<div class="flex__info">
					<span class="info__icon"><i class="fas fa-birthday-cake"></i>&nbsp;</span>
					<span class="info__item  info__item--title">Ngày sinh:</span>
					
					<span  class="info__item" class="info__item">
						<input class="ip" type="date" value= "{{$v->khNgaysinh}}" name="khNgaysinh"/>
					</span>
					<span style="color:red">{{$errors->first('khNgaysinh')}}</span>
				</div>
				<br/>
				<div class="flex__info">
					<span class="info__item  info__item--title">Giới tính:</span>
					<span class="info__icon"></span>
					<span class="info__item">
						<input value="0" type="radio" {{$v->khGioitinh==0?"checked":"unchecked"}} name="khGioitinh"/><span style="font-size: 18px">Nữ</span> &emsp;
					 	<input value="1" type="radio" {{$v->khGioitinh==1?"checked":"unchecked"}} name="khGioitinh"/><span style="font-size: 18px">Nam</span>
					 </span>
				 </div>
				 <br/><br/>
				 <button id="btn__register" class="btn_editInfo btn_editInfo-hide" type="submit">Cập nhật thông tin</button>
				 <br/>
				<br/>
				</div>
			</div>
			<div class="btn_update_show">
				 <a class="btn_editPass" href="{{url('updatePass/'.$v->khMa)}}">Đổi mật khẩu</a>
				 <button id="btn__register" class="btn_editInfo" type="submit">Cập nhật thông tin</button>
			</div>
				 <br/>
				</form>
				 <br/>
		</div>
	
		@endforeach
		@if($vt8Check != 0)
	@foreach($vt8 as $vt8)
<a href="{{url('chi-tiet-banner/'.$vt8->bnMa)}}"  class="quang__cao2" style="width: 12.3%;background-image: url({{URL::asset('public/images/banners/'.$vt8->bnHinh)}});background-size: cover"></a>
	@endforeach
	@endif
	</div>
</div>
</section><br>
@if(Session::get("khHinh")!=null)
	<script src="{{url('public/fe/js/previewImgInputFile2.js')}}"></script>
@else
<script src="{{url('public/fe/js/previewImgInputFile1.js')}}"></script>
@endif
<script src="{{url('public/fe/js/js-validate/validate-register.js')}}"></script>










@if(Session::has('success'))
<script type="text/javascript" >
	Swal.fire({
		icon:'info',
  title: '{{Session::get('success')}}',
  showDenyButton: true,

  confirmButtonText: `Ok`,
  denyButtonText: `Để sau`,

}).then((result) => {
  if(result.isDenied) 
  {
    document.location.href="{{URL::to('cancelinfo')}}";
  }
})

</script> 

@endif
@endsection





