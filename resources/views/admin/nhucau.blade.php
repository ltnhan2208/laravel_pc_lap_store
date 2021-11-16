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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý nhu cầu</h3>
                            <span></span>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                 <b>+ Thêm nhu cầu</b>
                </button>
                        </div>

                 <!-- Button trigger modal -->
             
                          <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm nhu cầu mới</h5>
                      </div>
                      <form id="formAdd">
                         <div class="modal-body">
                       {{--  <form class="form-inline" action="{{URL::to('/checkAddNhucau')}}" method="GET"> --}}
                        
                             {{ csrf_field() }}     
                            <label for="exampleInputPassword1" class="form-label">Nhu cầu sử dụng</label>
                            &emsp;
                            <input name="ncTen" type="text" class="form-control" id="ncTen">
                                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name="btn_edit" class="btn btn-primary btnAdd">Thực hiện</button>
                       
                      </div>
                       </form>
                    </div>
                  </div>
                </div>
                        <br/>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã nhu cầu</th>
                                            <th>Tên nhu cầu</td>
                                            <th></th>
                                          
                                        </tr>
                                    </thead>
                                    <tfoot  style="display:none;">
                                        <tr>
                                            <th>Mã nhu cầu</th>
                                            <th>Tên nhu cầu</td>
                                            <th></th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody id="tbody">
                                        @foreach($data as $value)
                                        <tr class="nhucau{{$value->ncMa}}">
                                            <td>{{$value->ncMa}}</td>
                                            <td>{{$value->ncTen}}</td>
                                   {{--  <form action="{{URL::to('/editNhucau/'.$value->ncMa)}}" method="GET">
                                         {{ csrf_field() }}
                                            <td><input name="ncTen" value="{{$value->ncTen}}"/></td>
                                            <td>
                                               <button class="btn btn-primary" ui-toggle-class="">Cập nhật </button>
                                           </td> --}}
                                           <td>
                                            <button class="btn btn-danger btnDel" value="{{$value->ncMa}}" >
                                                    Xóa
                                            </button>
                                            </td>
                                        {{-- </form> --}}
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
    var ncTen = $('#ncTen').val();

       $.ajax({
        type:"GET",
        cache:false,
        url:'checkAddNhucau',
        dataType:'JSON',
        data:$("#formAdd").serialize(),
        success:function(response){
            result = response.message;
            if(result==1)
            {
                Swal.fire({
                  icon: 'error',
                  title: 'Thông báo lỗi',
                  text: 'Nhu cầu không được rỗng!',
                });
            }
            else if(result == 2)
            {
                 Swal.fire({
                  icon: 'error',
                  title: 'Thông báo lỗi',
                  text: 'Nhu cầu này đã tồn tại!',
                });
            }
             else if(result == 3)
            {
                 Swal.fire({
                  icon: 'error',
                  title: 'Thông báo lỗi',
                  text: 'Nhu cầu quá dài!',
                });
            }
            else
            {
                Swal.fire({
                  icon: 'succes',
                  title: 'Thông báo lỗi',
                  text: 'Thành công!',
                });
                var addRow = `
                    <tr style="border: 0;">
                    <td>
                        ${response.ncMa}
                    </td>
                    <td>
                        ${response.ncTen}
                    </td>
                    <td>
                    <button class="btn btn-danger btnDel" value="${response.ncMa}">
                                                    Xóa
                                                </button>
                    </td>
                    </tr>`;
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
            url:'deleteNhucau/'+id,
            dataType:'JSON',
            data:{
                id:id
            },
            success:function(response){
                result = response.message;
                if(result==1)
                {
                    Swal.fire({
                      icon: 'error',
                      title: 'Thông báo lỗi',
                      text: 'Đã có sản phẩm thuộc nhu cầu này!',
                    });
                }
                else
                {
                     Swal.fire({
                      icon: 'success',
                      title: 'Xóa thành công',
                      text: '',
                    });
                    $(".nhucau"+id).remove();
                }
               
           }
            });
     });
  
</script>
  @endsection