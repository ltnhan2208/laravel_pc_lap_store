@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
           <div class="card-header py-3">
                <h2 class="m-0 font-weight-bold text-primary text-center">Thêm tin tức</h2>        
            </div>
        <div id="content" class="container">
        	<br/>
			<form class="row" action="{{URL::to('checkAddTT')}}" method="POST" enctype="multipart/form-data">
				 {{ csrf_field()}}

				 	<div class="col-lg-2"></div>
				 	<div class="col-lg-7 info__mid">
					<div class="form-group">
						<br/>
						<label>Tiêu đề</label><br>
						<input name="ttTieude" class="form-control" type="text"/>
						<br/>
						<label>Giới thiệu nội dung</label><br>
						<input name="ttGioithieu" class="form-control" type="text"/>
					</div>

					<div class="form-group">
						<label>Nội dung</label><br>
					<textarea id="tintuc__noidung" name="ttNoidung" style="width: 100%;height: 300px;"></textarea>
					<label>Loại tin tức</label><br>
					<input type="radio" name="ttLoai" value="1"/>&nbsp;Cửa hàng &emsp;
					 <input type="radio" name="ttLoai" value="2" />&nbsp;Bên lề
					</div>
				
					<label>Ảnh chủ đề</label><br>
					<div class="form-group text-center">
					   	<div id="box__img" class="box__imgTT">
					   		<span class="text">Chưa có ảnh</span>
					   		<img id="imgtt" src="" alt="" />
					   	</div>
					   	<span id="btnCanceltt"><i class="fas fa-times" style="font-size: 20px;"></i></span>
					   	<div>
					    <input id="inputImg" name="ttHinh" type="file" class="form-control" />
					   
		 				<label for="exampleInputPassword1" class="form-label"></label>
					    <label id="btnImg" class="lb__ttHinh" onclick="defaultAction()"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Thêm ảnh</i></label>
						</div>
					</div>
					<br/>
					<button type="submit" class="btn btn-primary">Thực hiện và gửi thông báo đến mail khách hàng</button>
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
var editor = CKEDITOR.replace('tintuc__noidung');
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

