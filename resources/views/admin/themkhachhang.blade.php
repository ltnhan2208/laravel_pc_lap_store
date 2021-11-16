@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content">
        	<h3 class="text-info text-center"><br/>Thêm thông tin nhân viên</h3>
				 <hr/>
        	<br/>
			<form class="row justify-content-around" action="{{URL::to('/checkAddKhachhang')}}" method="POST"  enctype="multipart/form-data">
				 {{ csrf_field() }}
			<div class="col-lg-1"></div>
			<div class="col-lg-5 info__mid">
				<br/>
				<h5 class="text-dark">THÔNG TIN</h5>
				
			<div class="form-group">
			    <label for="exampleInputPassword1" class="form-label">Tên khách hàng</label>
			    <input onblur="onName()" id="ip__name" name="khTen" type="text" class="form-control" >
			   
			    <span id="name__err--regis"></span>
			  <br/>
			    <label for="exampleInputPassword1" class="form-label">Số điện thoại</label>
			    <input onblur="onSDT()" id="sdt" name="khSdt" type="number" class="form-control" id="adSdt">
			    
			      <span id="sdt__err--regis"></span>
			
			</div>
			  <div class="form-group">
			 
			    <label for="exampleInputPassword1" class="form-label">Email</label>
			    <input name="khEmail" type="email" class="form-control">
			   
			 <br/>
			    <label for="exampleInputPassword1" class="form-label">Tài khoản đăng nhập</label>
			    <input onblur="onAcc()" id="ip__acc" name="khTaikhoan" type="text" class="form-control">
			    
			     <span id="acc__err--regis"></span>
			 
			</div>
			<div class="form-group">
			  
			    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
			    <input onblur="onPass1()" id="password" name="khMatkhau" type="password" class="form-control">
			  
			     <span id="pass__err"></span>
			  <br/>
			    <label for="exampleInputPassword1" class="form-label">Ngày sinh</label><br/>
			    <input name="khNgaysinh" type="date" class="dateInput" id="khNgaysinh">
			    
			 
			</div>


			<div class="form-group">
			   
			    <label for="exampleInputPassword1" class="form-label">Địa chỉ</label>
			    <input onblur="onAddress()" name="khDiachi" type="text" class="form-control" id="address">
			    
			      <span id="address__err--regis"></span>
			<br/>
			   {{--  <label for="exampleInputPassword1" class="form-label">Quyền</label>
			    <input name="khQuyen" type="number" value="0" class="form-control" id="khQuyen">
			     <span style="color:red">{{$errors->first('khQuyen')}}</span> --}}
			
			</div>

			<div class="form-group">
				 
			    <label for="exampleInputPassword1" class="form-label">Giới tính</label>
			    <br/>
			    &emsp;<input name="khGioitinh" value="1" type="radio"  id="khGioitinh">Nam
			    &emsp;<input name="khGioitinh"  value="0" type="radio"  id="khGioitinh">Nữ
			   
			</div>
			<div class="row justify-content-around">
			  <button class="btn btn-dark" type="button" onclick="back()">Trở về</button>
			 
			  <button id="btn__register" class="btn btn-primary" type="submit" name="btn_khd" >Thực hiện</button>
			</div>
		</div>

			<div class="col-lg-4 info__right">
				<br/>
				<h5>ẢNH</h5>
				<br/>
				<div class="row justify-content-around">
				<div class="col-lg-8">
				
			   	<div id="box__img" class="box__img">
			   		<span class="text">Chưa có ảnh</span>
			   		<img id="img" src="" alt="" />
			   	</div>
			   	<div>
			   		<span id="btnCancel"><i class="fas fa-times" style="font-size: 20px;"></i></span>
			    <input id="inputImg" name="khHinh" type="file" class="form-control">
 				<label for="exampleInputPassword1" class="form-label"></label>
			    <label id="btnImg" class="lb__khHinh" onclick="defaultAction()"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Thêm ảnh khách hàng</i></label>
				</div>
				</div>
			</div>
			 </div>
			  <div class="col-lg-1"></div>
			  <br/>
		
			</form>
			<br/>
                    
		</div>
	</div>
	</div>
	<script src="{{url('public/style_admin/js/previewImgInputFile1.js')}}"></script>
	 <script src="{{url('public/fe/js/js-validate/validate-register.js')}}"></script>
@endsection
