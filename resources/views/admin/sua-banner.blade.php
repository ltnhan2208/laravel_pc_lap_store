@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
           <div class="card-header py-3">
                <h2 class="m-0 font-weight-bold text-primary text-center">Cập nhật banner</h2>        
            </div>
        <div id="content" class="container">
        	<br/>
        @foreach($data as $v)
			<form class="row" action="{{URL::to('updateBanner/'.$v->bnMa)}}" method="POST" enctype="multipart/form-data">
				 {{ csrf_field()}}

				 	<div class="col-lg-2"></div>
				 	<div class="col-lg-8 info__mid">
					<div class="form-group">
						<br/>
						<label>Tiêu đề</label><br>
						<input name="bnTieude" class="form-control" type="text"/>
					</div>
					<div class="form-group">
						<label>Nội dung</label><br>
					<textarea id="bn__noidung" name="bnNoidung" style="width: 100%;height: 300px;"></textarea>
					<label>Trang thái banner</label><br>
					<input type="radio" name="bnTrangthai" value="0"/>&nbsp;Hiển thị trên website&emsp;
					<input type="radio" name="bnTrangthai" value="1" />&nbsp;Danh sách banner
					</div>
					@if($trang == 1 && $vitri == 3)
					<label>Video chủ đề</label><br>
					@else
					<label>Ảnh chủ đề</label><br>
					@endif
					@if($trang == 1 && $vitri == 1)
					<div class="form-group text-center">
					   	<div id="box__img" class="box__imgTT"  style="text-align: center;margin: 0;padding: 0;width: 100%;height: 60px;">
					   		<span class="text">Chưa có ảnh</span>
					   		<img id="imgtt" src="" alt="" style="width: 99%;height: 60px;" />
					   	</div>
					   	<span id="btnCanceltt" style="top:10px">
					   		<i class="fas fa-times" style="font-size: 20px;">&nbsp;Hủy</i>
					   	</span>
					   	<div>
					    <input id="inputImg" name="bnHinh" type="file" class="form-control" />
					   
		 				<label for="exampleInputPassword1" class="form-label"></label>
					    <label id="btnImg" class="lb__ttHinh" onclick="defaultAction()"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Thêm ảnh</i></label>
						</div>
					</div>

					@elseif($trang == 1 && $vitri == 2)
					<div class="form-group text-center">
					   	<div id="box__img" class="box__imgTT" style="text-align: center;margin: 0;padding: 0;width: 260px;height: 55px;position: relative;background: #1A1B50;">
					   		<span class="text" style="color: white;">Chưa có ảnh</span>
					   		<img id="imgtt" src="" alt="" style="width: 253px;height: 55px;position: relative;" />
					   	</div>
					   	<div>
					   		<span id="btnCanceltt" style="position: relative;top:0;left: -140px;">
					   		<i class="fas fa-times" style="font-size: 20px;">&nbsp;Hủy</i>
					   	</span>
					    <input id="inputImg" name="bnHinh" type="file" class="form-control" />
					   
		 				<label for="exampleInputPassword1" class="form-label"></label>
					    <label id="btnImg" class="lb__ttHinh" onclick="defaultAction()"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Thêm ảnh</i></label>
						</div>
					</div>
					@elseif($trang == 1 && $vitri == 3)
					<div class="form-group text-center">
					   	<div id="box__img" class="box__imgTT" style="text-align: center;margin: 0;padding: 0;width: 100%;height: 55px;position: relative;height: 400px">
					   		<span class="text">Chưa có dữ liệu</span>
					   		 <video id="imgtt" src="" type="video/mp4" style="height: 400px;" muted loop autoplay>
                   
                  </video>
					   	</div>
					   	<div>
					   	<span id="btnCanceltt" style="position: relative;top:0;">
					   		<i class="fas fa-times" style="font-size: 20px;">&nbsp;Hủy</i>
					   	</span>
					    <input id="inputImg" name="bnHinh" type="file" class="form-control" />
					   
		 				<label for="exampleInputPassword1" class="form-label"></label>
					    <label id="btnImg" class="lb__ttHinh" onclick="defaultAction()"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Thêm ảnh</i></label>
						</div>
					</div>
					@elseif($trang == 2 && $vitri == 1 || $trang == 2 && $vitri == 8)
					<label style="width: 24%;" id="btnImg" class="lb__ttHinh" onclick="defaultAction()"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Thêm ảnh</i></label>
					<div class="form-group text-center">
					   	<div id="box__img" class="box__imgTT" style="width: 166px;height: 495px;position: relative;">
					   		<span class="text">Chưa có ảnh</span>
					   		<img id="imgtt" src="" alt="" style="width: 166px;height: 495px;position: relative;"/>
					   	</div>
					   	<span id="btnCanceltt" style="position: relative;top:-20px;left:-150px">
					   		<i class="fas fa-times" style="font-size: 20px;">&nbsp;Hủy</i>
					   	</span>
					   	<div>
					    <input id="inputImg" name="bnHinh" type="file" class="form-control" />
						</div>
					</div>
					@else
					<div class="form-group text-center">
					   	<div id="box__img" class="box__imgTT">
					   		<span class="text">Chưa có ảnh</span>
					   		<img id="imgtt" src="" alt=""/>
					   	</div>
					   	<span id="btnCanceltt">
					   		<i class="fas fa-times" style="font-size: 20px;">&nbsp;Hủy</i>
					   	</span>
					   	<div>
					    <input id="inputImg" name="bnHinh" type="file" class="form-control" />
					   
		 				<label for="exampleInputPassword1" class="form-label"></label>
					    <label id="btnImg" class="lb__ttHinh" onclick="defaultAction()"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Thêm ảnh</i></label>
						</div>
					</div>
					@endif
					<br/>
					<button type="submit" class="btn btn-primary">Thực hiện</button>
					</div>

			</form>                        
		</div>
	</div>


<script src="{{url('public/style_admin/js/previewImgInputFile5.js')}}"></script>
<!-------checkdirto---->
<script src="{{url('public/style_admin/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('public/style_admin/ckfinder/ckfinder.js')}}"></script>
<script>
// CKEDITOR.replace( 'tintuc__noidung',
// {
// startupFocus : true,
// toolbar :
// [
// ['ajaxsave'],['Styles', 'Format', 'Font', 'FontSize'],
// ['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
// ['Cut','Copy','Paste','PasteText'],
// ['Undo','Redo','-','RemoveFormat'],
// ['TextColor','BGColor'],
// ['Maximize', 'Table']
// ],

// you must write path to filemanager where you have copied it.
// });
var editor = CKEDITOR.replace('bn__noidung');
CKFinder.setupCKEditor(editor);

        
</script>
<!---------end checkdirto--------------------->
@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Opss... ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif
@endsection

