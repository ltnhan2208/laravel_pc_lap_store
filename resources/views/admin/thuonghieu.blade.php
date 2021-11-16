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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý thương hiệu</h3>
                            <span></span> <span></span> <span></span>
                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                 <b>+ Thêm thương hiệu</b>
                </button>
                        </div>
                        <!-- Button trigger modal -->
              

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm thương hiệu mới</h5>
                      </div>
                      <div class="modal-body">
                        <form id="formAdd">
                      {{--  <form class="form-inline" action="{{URL::to('checkAddThuonghieu')}}" method="GET"> --}}
                                 {{ csrf_field() }}
                                
                                <label for="exampleInputPassword1" class="form-label">Tên thương hiệu</label>
                                &emsp;
                                <input name="thTen" type="text" class="form-control" id="thTen">
                              &emsp;
                                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button style="outline: none;" type="submit" name="btn_edit" class="btn btn-primary btnAdd">Thực hiện</button>
                         </form>
                      </div>
                    </div>
                  </div>
                </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã thương hiệu</th>
                                            <th>Tên thương hiệu</th>
                                         
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot  style="display:none;">
                                        <tr>
                                            <th>Mã thương hiệu</th>
                                            <th>Tên thương hiệu</th>
                                           
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="tbody">
                                        @foreach($data as $value)
                                        <tr class="thuonghieu{{$value->thMa}}">
                                           <td>{{$value->thMa}}
                                           </td>
                                           <td>{{$value->thTen}}</td>
                                           {{-- <form action="{{URL::to('/editThuonghieu/'.$value->thMa)}}" method="GET">
                                         {{ csrf_field() }}
                                            <td><input name="thTen" value="{{$value->thTen}}" /></td> --}}
                                           {{--  <td>
                                                <button onclick="update({{$value->thMa}})" type="submit" class="btn btn-primary " ui-toggle-class="">Cập nhật</button>
                                            </td> --}}
                                            <td>
                                             <button class="btn btn-danger btnDel" value="{{$value->thMa}}">
                                                    Xóa
                                                </button></td>
                                       {{--  </form> --}}
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
    table = document.getElementById("dataTable");
   var tb = document.getElementById("tbody");
    $(document).on('click','.btnAdd',function(e){
    e.preventDefault();
    var thTen = $('#thTen').val();

       $.ajax({
        type:"GET",
        cache:false,
        url:'checkAddThuonghieu',
        dataType:'JSON',
        data:$("#formAdd").serialize(),
        success:function(response){
            result = response.message;
            if(result==1)
            {
                Swal.fire({
                  icon: 'error',
                  title: 'Thông báo lỗi',
                  text: 'Thương hiệu không được rỗng!',
                });
            }
            else if(result == 2)
            {
                 Swal.fire({
                  icon: 'error',
                  title: 'Thông báo lỗi',
                  text: 'Thương hiệu này đã tồn tại!',
                });
            }
            else if(result == 3)
            {
                 Swal.fire({
                  icon: 'error',
                  title: 'Thông báo lỗi',
                  text: 'Thương hiệu quá dài!',
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
                        ${response.thMa}
                    </td>
                    <td>
                        ${response.thTen}
                    </td>
                    <td>
                    <button class="btn btn-danger btnDel" value="${response.thMa}">
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
    var btnD = document.getElementsByClassName("btnDel");
    for(var t = 0; t<tb.rows.length;t++)
    {
       tb.rows[t].cells[2].onclick = function()
        {
            var index =this.parentElement.rowIndex;
            var id = this.children[0].value;
      
           $.ajax({
            type:"GET",
            cache:false,
            url:'deleteThuonghieu/'+id,
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
                      text: 'Đã có sản phẩm thuộc thương hiệu này!',
                    });
                }
                else
                {
                     Swal.fire({
                      icon: 'success',
                      title: 'Xóa thành công',
                      text: '',
                    });
                    $(".thuonghieu"+id).remove();
                      //tb.deleteRow(index-1);  
                }
               
           }
            });
        }
    }
    
        // $(document).on('click',btnD[n],function(){
        // e.preventDefault();
        
        
        // var id = $(this).val();
        //    $.ajax({
        //     type:"GET",
        //     cache:false,
        //     url:'deleteThuonghieu/'+id,
        //     dataType:'JSON',
        //     data:{
        //         id:id
        //     },
        //     success:function(response){
        //         result = response.message;
        //         if(result==1)
        //         {
        //             Swal.fire({
        //               icon: 'error',
        //               title: 'Thông báo lỗi',
        //               text: 'Đã có sản phẩm thuộc thương hiệu này!',
        //             });
        //         }
        //         else
        //         {
        //              Swal.fire({
        //               icon: 'success',
        //               title: 'Xóa thành công',
        //               text: '',
        //             });
        //             $(".thuonghieu"+id).remove();
        //         }
               
        //    }
        //     });
     // });
  // }
</script>
  @endsection