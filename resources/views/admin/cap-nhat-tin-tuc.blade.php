@extends('admin.layout')
@section('content')
    <div id="content-wrapper" class="d-flex flex-column" >
            <!-- Main Content -->
        <div id="content" class="container">
            <br/>
            @foreach($data as $value)
            <form class="row" action="{{URL::to('editTintuc/'.$value->ttMa)}}" method="POST" enctype="multipart/form-data">
                 {{ csrf_field()}}
                    <div class="col-lg-2"></div>
                    <div class="col-lg-7 info__mid">
                        <br/>
                <h5 class="text-dark text-center">THÔNG TIN</h5>
                    <div class="form-group">
                        <label>Tiêu đề</label><br>
                            <input name="ttTieude" class="form-control" type="text" value="{{$value->ttTieude}}"/>
                            <br/>
                        <label>Giới thiệu nội dung</label><br>
                        <input name="ttGioithieu" class="form-control" value="{{$value->ttGioithieu}}" type="text"/>
                    </div>

                    <div class="form-group">
                        <label>Nội dung</label><br>
                    <textarea id="tintuc__noidung" name="ttNoidung" style="width: 100%;height: 300px;">
                        {{$value->ttNoidung}}
                    </textarea>
                    <br/><br/>
                    <label>Thông tin về</label><br>
                    <input type="radio" name="ttLoai" {{$value->ttLoai == 1?"checked":"unchecked"}} value="1"/>&nbsp;Cửa hàng &emsp;
                     <input type="radio" name="ttLoai"  {{$value->ttLoai == 2?"checked":"unchecked"}} value="2" />&nbsp;Bên lề
                    <br/><br/>
                    <label>Trạng thái</label><br>
                    <input type="radio" name="ttTinhtrang" {{$value->ttTinhtrang == 0?"checked":"unchecked"}} value="0"/>&nbsp;Hiện &emsp;
                     <input type="radio" name="ttTinhtrang"  {{$value->ttTinhtrang == 1?"checked":"unchecked"}} value="1" />&nbsp;Ẩn
                    </div>
                        <label>Ảnh chủ đề</label><br>
                    <div class="form-group text-center">
                        <div id="box__img" class="box__imgTT">
                            @if($value->ttHinh!=null)
                                <img id="imgDefaultTT" src="{{URL::asset('public/images/tintuc/'.$value->ttHinh)}}" />
                                    <img id="imgtt" src="" alt="" />
                                @else
                                <span class="text">Chưa có ảnh</span>
                                <img id="imgtt" src="" alt="" />
                                @endif
                        </div>
                        <span id="btnCanceltt"><i class="fas fa-times" style="font-size: 20px;"></i></span>
                        <div>
                        <input id="inputImg" name="ttHinh" type="file" class="form-control" />
                       
                        <label for="exampleInputPassword1" class="form-label"></label>
                        <label id="btnImg" class="lb__ttHinh" onclick="defaultAction()"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Thêm ảnh</i></label>
                        </div>
                    </div>
                    <br/>
                    <button type="submit" class="btn btn-primary">Thực hiện</button>
                    </div>
            </form>    
            @if($value->ttHinh!=null)
        <script src="{{URL::to('public/style_admin/js/previewImgInputFile6.js')}}"></script>
        @else
        <script src="{{URL::to('public/style_admin/js/previewImgInputFile5.js')}}"></script>
        @endif
        
            @endforeach                   
        </div>
    </div>

<!-------checkdirto---->
<script src="{{URL::to('public/style_admin/ckeditor/ckeditor.js')}}"></script>
<script src="{{URL::to('public/style_admin/ckfinder/ckfinder.js')}}"></script>
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

<br/>