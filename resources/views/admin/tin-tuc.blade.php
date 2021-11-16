@extends('admin.layout')
@section('content')
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid"> 
                    <!-- DataTales Example -->
                    <div class="card shadow row">
                        <div class="card-header row justify-content-around">
                            <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý tin tức</h3>
                            <span></span> <span></span> <span></span>
                        <a href="{{URL::to('them-tin-tuc')}}" class="btn btn-primary">
                            <b>+&nbsp;Thêm tin tức</a></b>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Người đăng</th>
                                            <th>Tiêu đề</th>
                                            <th>Thông tin về</th>
                                            <th>Ngày viết</th>
                                            <th>Lượt xem</th>
                                            <th>Tình trạng</th>
                                            <th></th> 
                                             <th></th>  
                                        </tr>
                                    </thead>
                                   
                                     <tfoot  style="display:none;"> 
                                         <tr>
                                            <th>Người đăng</th>
                                            <th>Tiêu đề</th>
                                            <th>Thông tin về</th>
                                            <th>Ngày viết</th>
                                            <th>Lượt xem</th>
                                            <th>Tình trạng</th>
                                            <th></th> 
                                            <th></th>  
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr class="tt{{$value->ttMa}}">
                                            <td>{{$value->adTen}}</td>
                                            <td style="width: 15%">{{$value->ttTieude}}</td>
                                            <td>{{$value->ttLoai==1?"Cửa hàng":"Bên lề"}}</td>
                                            <td>{{$value->ttNgaydang}}</td>
                                            <td>{{$value->ttLuotxem}}</td>
                                            <td>{{$value->ttTinhtrang==0?"Hiện":"Ẩn"}}</td>
                                           <td>
                                            <a class="btn btn-primary" href="{{URL::to('cap-nhat-tin-tuc/'.$value->ttMa)}}">Cập nhật</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btnDel" value="{{$value->ttMa}}">
                                                  Xóa
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
               
                </div>
                <!-- /.container-fluid -->


<script>
   $(document).on('click','.btnDel',function(e){
    e.preventDefault();
    var id = $(this).val();
       $.ajax({
        type:"GET",
        cache:false,
        url:'xoa-tin-tuc/'+id,
        dataType:'JSON',
        data:{
            id:id
        },
        success:function(response){
            result = response.message;
           if(result == 0)
           {
            $(".tt"+id).remove();
            alert('Xóa thành công')
           }
       }
        });
   });
</script>

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