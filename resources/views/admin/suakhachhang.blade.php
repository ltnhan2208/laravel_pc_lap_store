@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

@foreach($khMaCu as $key => $value)
			   		
            <!-- Main Content -->
         <div id="content">
         	<h3 class="text-info text-center"><br/>Cập nhật thông tin khách hàng</h3>
				 <hr/>
        	<br/>
			{{-- <form class="row justify-content-around" action="{{URL::to('/editKhachhang/'.$value->khMa)}}" method="POST" enctype="multipart/form-data"> --}}
				<form class="row justify-content-around">
				{{ csrf_field() }}
			<div class="col-lg-1"></div>
			<div class="col-lg-5 info__mid">
				<br/>
				<h5 class="text-dark">THÔNG TIN</h5>
			<div class="form-group">
			    <label for="exampleInputPassword1" class="form-label">Tên khách hàng</label>
			    <input onblur="onName()" id="ip__name" name="khTen" type="text" value="{{$value->khTen}}" class="form-control">
			    <span style="color:red">{{$errors->first('khTen')}}</span>
			    <span id="name__err--regis"></span>
			  <br/>
			    <label for="exampleInputPassword1" class="form-label">SDT</label>
			    <input onblur="onSDT()" id="sdt" name="khSdt" type="number" value="{{$value->khSdt}}" class="form-control">
			     <span style="color:red">{{$errors->first('khSdt')}}</span>
			     <span id="sdt__err--regis"></span>
			</div>

			<div class="form-group">
			   
			    <label for="exampleInputPassword1" class="form-label">Email</label>
			    <input name="khEmail" type="email" value="{{$value->khEmail}}" class="form-control" id="khEmail">
			     <span style="color:red">{{$errors->first('khEmail')}}</span>
			 <br/>
			    <label for="exampleInputPassword1" class="form-label">Tài khoản cho khách hàng</label>
			    <input onblur="onAcc()" id="ip__acc" name="khTaikhoan" type="text" value="{{$value->khTaikhoan}}" class="form-control">
			     <span style="color:red">{{$errors->first('khTaikhoan')}}</span>
			     <span id="acc__err--regis"></span>
			  </div>

			<div class="form-group">
			  {{--   <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
			    <input onblur="onPass1()" id="password" name="khMatkhau" type="password" value="{{$value->khMatkhau}}" class="form-control">
			     <span style="color:red">{{$errors->first('khMatkhau')}}</span>
			     <span id="pass__err"></span> --}}
			 <br/>
			    <label for="exampleInputPassword1" class="form-label">Ngày sinh</label><br/>
			    <input name="khNgaysinh" type="date" value="{{$value->khNgaysinh}}" class="dateInput" id="khNgaysinh">
			     <span style="color:red">{{$errors->first('khNgaysinh')}}</span>
			</div>

			<div class="form-group">
			    <label for="exampleInputPassword1" class="form-label">Địa chỉ</label>
			    <input onblur="onAddress()" id="address" name="khDiachi" type="text" value="{{$value->khDiachi}}" class="form-control">
			     <span style="color:red">{{$errors->first('khDiachi')}}</span>
			     <span id="address__err--regis"></span>
			     <br/>
			    <label for="exampleInputPassword1" class="form-label">Quyền</label>
			    <input name="khQuyen" value="{{$value->khQuyen}}" type="number" class="form-control" id="khQuyen">
			     <span style="color:red">{{$errors->first('khQuyen')}}</span>
			</div>
				<div class="form-group">
			    <label for="exampleInputPassword1" class="form-label">Giới tính</label>
			    <br/>
			    &emsp;<input name="khGioitinh" {{$value->khGioitinh==1?"checked":"unchecked"}} value="1" type="radio"  id="khGioitinh">Nam
			    &emsp;<input name="khGioitinh"  {{$value->khGioitinh==0?"checked":"unchecked"}} value="0" type="radio"  id="khGioitinh">Nữ
			    <span style="color:red">{{$errors->first('khGioitinh')}}</span>
			    <br/><br/>
			    <div class="row justify-content-around">
			  <button class="btn btn-dark" type="button" onclick="back()">Trở về</button>
			
			  {{-- <button id="btn__register" class="btn btn-primary" type="submit" name="btn_khd" >Thực hiện</button> --}}
			</div>
			</div>
		</div>
			
			<div class="col-lg-4 info__right">
				<br/>
				<h5>ẢNH</h5>
				<br/>
				<div class="row justify-content-around">
				<div class="col-lg-8">
			   	<div id="box__img" class="box__img">
			   		@if($value->khHinh!=null)
					<img id="imgDefault" src="{{URL::asset('public/images/khachhang/'.$value->khHinh)}}" />
					<img id="img" src="" alt="" />
					@else
					<span class="text">Chưa có ảnh</span>
			   		<img id="img" src="" alt="" />
					@endif
			   		
			   	</div>
			   	<span id="btnCancel"><i class="fas fa-times" style="font-size: 20px;"></i></span>
			   	<div>
			    <input id="inputImg" name="khHinh" type="file" class="form-control">
 				<label for="exampleInputPassword1" class="form-label"></label>
			 {{--    <label id="btnImg" class="lb__khHinh" onclick="defaultAction()"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Thêm ảnh khách hàng</i></label> --}}
			</div>
				</div>
			</div>
			 </div>
			  <div class="col-lg-1"></div>
			 
			</form>
			<br/>
                                
		</div>
		@if($value->khHinh!=null)
		<script src="{{url('public/style_admin/js/previewImgInputFile2.js')}}"></script>
		@else
		<script src="{{url('public/style_admin/js/previewImgInputFile1.js')}}"></script>
		@endif
		@endforeach
	</div>

@endsection
 <script src="{{url('public/fe/js/js-validate/validate-register.js')}}"></script>