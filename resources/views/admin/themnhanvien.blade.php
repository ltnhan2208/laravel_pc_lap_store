@extends('admin.layout')
@section('content')

  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content">

        	<h3 class="text-info text-center"><br/>Thêm tài khoản nhân viên</h3>
				 <hr/>
        	<br/>
			<form class="row justify-content-around" action="{{URL::to('checkAddAdmin')}}" method="POST"  enctype="multipart/form-data">
				 {{ csrf_field() }}
			<div class="col-lg-1"></div>
			<div class="col-lg-4 info__mid">
				<br/>
				<h5 class="text-dark">THÔNG TIN</h5>
				
				<div class="form-group">
			    <label for="exampleInputPassword1" class="form-label">Tên nhân viên</label>
			    <input id="ip__name" name="adTen" onBlur="onName()" type="text" class="form-control">
			    <span id="name__err--update"></span>
			 
			    <br/>
			  
			    <label for="exampleInputPassword1" class="form-label">Tài khoản đăng nhập</label>
			    <input id="ip__acc" name="adTaikhoan" onBlur="onAcc()" type="text" class="form-control" >
				<span id="acc__err--update"></span>
			</div>


			<div class="form-group">
			    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
			    <input id="ip__pass" name="adMatkhau" onBlur="onPass()" type="password" class="form-control">
			    <span id="pass__err--update"></span>
			 
			 <br/>
			  
			    <label for="exampleInputPassword1" class="form-label">Số điện thoại</label>
			    <input id="ip__sdt" name="adSdt" onBlur="onSdt()" type="number" class="form-control" >
			     <span id="sdt__err--update"></span>
			  
			  </div>
			   <div class="form-group">
			    <label for="exampleInputPassword1" class="form-label">Email</label>
			    <input name="adEmail" type="email" class="form-control" id="adEmail">
			     <br/>
			   <label for="exampleInputPassword1" class="form-label">Số cmnd</label>
			    <input id="ip__cmnd" name="cmnd" type="number" onBlur="onCmnd()" class="form-control">
			    <span id="cmnd__err--update"></span>
			     <br/>
			  <label for="exampleInputPassword1" class="form-label">Dịa chỉ</label>
			    <input id="ip__diachi" name="adDiachi" type="text" onBlur="onDiachi()" class="form-control">
			    <span id="diachi__err--update"></span>
				    
			 <br/>
			    <label for="exampleInputPassword1" class="form-label">Quyền</label>
			    <select name="adQuyen">
			    	<option value="2">Quản lý</option>
			    	<option value="3">Thu ngân</option>
			    	<option value="4">Nhân viên</option>
			    </select>
			 
			 	<br/><br/>
			  	<div class="row justify-content-around">
			    <button class="btn btn-dark" type="button" onclick="back()">Trở về</button>	
			  <button id="btn__ok" class="btn btn-primary" type="submit" name="btn_add">Thực hiện</button>
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
					   		<span class="text">Chưa có ảnh</span>
					   		<img id="img" src="" alt="" />
					   	</div>
					   	<span id="btnCancel"><i class="fas fa-times" style="font-size: 20px;"></i></span>
					   	<div>
					    <input id="inputImg" name="adHinh" type="file" class="form-control">
					   
		 				<label for="exampleInputPassword1" class="form-label"></label>
					    <label id="btnImg" class="lb__adHinh" onclick="defaultAction()"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Thêm ảnh nhân viên</i></label>
						</div>
					</div>
				</div>
			  </div>
			  <div class="col-lg-1"></div>
			 
			</form>
			<br/>         
		</div>
	</div>
	<script src="{{url('public/style_admin/js/previewImgInputFile1.js')}}"></script>
<script src="{{url('public/fe/js/js-validate/validate-nv.js')}}"></script>
@endsection
