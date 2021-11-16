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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý nhà cung cấp</h3>
                            <span></span><span></span><span></span>
                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                 <b>+ Thêm nhà cung cấp</b>
                </button>
                        </div>
                    	
                         <!-- Button trigger modal -->
              
                          <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm nhà cung cấp mới</h5>
                      </div>
                      <form id="formAdd">
                          {{ csrf_field() }}     
                         <div class="modal-body">
                       {{--  <form class="form-inline" action="{{URL::to('/checkAddNhucau')}}" method="GET"> --}}
                            <div class="form-group">
                        <label>Tên nhà cung cấp:</label>
                            <input id="nccTen" class="form-control"  type="text" name="nccTen" >
                            </div>

                    <div class="form-group">
                        <label>Số điện thoại:</label>
                        <input id="nccSdt" class="form-control"  type="number" name="nccSdt" >                   
                         </div>
                    <div class="form-group">
                        <label>Địa chỉ:</label>
                            <input id="nccDiachi" class="form-control"  type="text" name="nccDiachi"><br>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn_edit" class="btn btn-primary btnAdd">Thực hiện</button>
                       
                      </div>
                       </form>
                    </div>
                  </div>
                </div>
            </div>
                <br/>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã nhà cung cấp</th>
                                            <th>Tên nhà cung cấp</th>
                                            <th>Tình trạng</th>
                                            <th>Số điện thoại</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                   
                                     <tfoot style="display:none;"> 
                                         <tr>
                                            <th>Mã nhà cung cấp</th>
                                            <th>Tên nhà cung cấp</th>
                                            <th>Tình trạng</th>
                                            <th>Số điện thoại</th>
                                            <th></th>  
                                        </tr>
                                    </tfoot>
                                    <tbody id="tbody">

                                    @foreach($data as $value)
                                        <tr class="nhacungcap{{$value->nccMa}}">
                                            <td>{{$value->nccMa}}</td>
                                            <td>{{$value->nccTen}}</td>
                                            <td>{{$value->nccTinhtrang!=99?"Bình thường":"Đã khóa"}}</td>
                                            <td>{{$value->nccSdt}}</td>
                                           <td>
                                            <a class="btn btn-primary" href="{{URL::to('suaNhacungcappage/'.$value->nccMa)}}">Cập nhật</a>
                                             <button class="btn btn-danger btnDel" value="{{$value->nccMa}}" >
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
     //Thêm
   var tb = document.getElementById("tbody");
    $(document).on('click','.btnAdd',function(e){
    e.preventDefault();
    var ncTen = $('#nccTen').val();

       $.ajax({
        type:"GET",
        cache:false,
        url:'checkAddNcc',
        dataType:'JSON',
        data:$("#formAdd").serialize(),
        success:function(response){
            result = response.message;
            if(result==1)
            {
                Swal.fire({
                  icon: 'error',
                  title: 'Thông báo lỗi',
                  text: 'Thông tin không được trống!',
                });
            }
            else if(result == 2)
            {
                 Swal.fire({
                  icon: 'error',
                  title: 'Thông báo lỗi',
                  text: 'Địa chỉ không hợp lệ!',
                });
            }
            else if(result == 3)
            {
                 Swal.fire({
                  icon: 'error',
                  title: 'Thông báo lỗi',
                  text: 'Số điện thoại không hợp lệ!',
                });
            }
            else if(result == 4)
            {
                 Swal.fire({
                  icon: 'error',
                  title: 'Thông báo lỗi',
                  text: 'Nhà cung cấp này đã tồn tại!',
                });
            }
            else if(result == 5)
            {
                 Swal.fire({
                  icon: 'error',
                  title: 'Thông báo lỗi',
                  text: 'Đã có nhà cung cấp có số điện thoại này!',
                });
            }
            else if(result == 6)
            {
                 Swal.fire({
                  icon: 'error',
                  title: 'Thông báo lỗi',
                  text: 'Đã có nhà cung cấp có địa chỉ này!',
                });
            }
             else if(result == 7)
            {
                 Swal.fire({
                  icon: 'error',
                  title: 'Thông báo lỗi',
                  text: response.err,
                });
            }
            else
            {
                Swal.fire({
                  icon: 'succes',
                  text: 'Thành công!',
                });
              //tb.innerHTML+= addRow;
            location.reload();
            }
       }
        });
   });

     //Xóa
        $(document).on('click','.btnDel',function(e){
        e.preventDefault();
        var id = $(this).val();

           $.ajax({
            type:"GET",
            cache:false,
            url:'deleteNhacungcap/'+id,
            dataType:'JSON',
            data:{
                id:id,
            },
            success:function(response){
                result = response.message;
                if(result==1)
                {
                    Swal.fire({
                      icon: 'error',
                      text: 'Đã có sản phẩm thuộc nhà cung cấp này!',
                    });
                }
                else
                {
                     Swal.fire({
                      icon: 'success',
                      text: 'Đã xóa',
                    });
                    $(".nhacungcap"+id).remove();
                }
               
           }
            });
     });
</script>
  @endsection