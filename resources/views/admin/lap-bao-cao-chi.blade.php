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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Lập báo cáo</h3>
                           <span></span><span></span><span></span>
                        </div>
                    </div>
                    <br/>
                        <div>
                            <form id="form__baocao">
                                 <span>Ngày bắt đầu:</span>&nbsp;
                                 <input class="btn btn-outline-dark" type="date" id="start" name="ngayBatdau"/>
                               &emsp;&emsp;
                                 <span>Ngày kết thúc(nếu có):</span>&nbsp;
                                 <input class="btn btn-outline-dark" type="date" id="end" name="ngayKetthuc"/>
                                 <button id="btnSearch" class="btn btn-outline-dark" type="submit">Tìm</button>
                                </form>
                                  <br/><br/> <br/><br/>
                                  <form action="{{URL::to('them-bao-cao-chi')}}" method="POST">
                                    {{ csrf_field()}}
                                 <table id="tb__baocao" class="tb__baocao" border="1">
                                 </table>
                                
                                </form>
                        </div>
                </div>




<script>
    var table = document.getElementById("tb__baocao");
   
    $(document).on('click','#btnSearch',function(e){
        e.preventDefault();
        var start = document.getElementById('start').value;
        var end = document.getElementById('end').value;
        if(end != 0 && start == 0)
        {
            Swal.fire({
             icon: 'error',
            text: 'Vui lòng nhập ngày bắt đầu!',
             });
        }
        else if(start > end && end != 0)
        {
            Swal.fire({
             icon: 'error',
            text: 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu!',
             });  
        }
        else if(start == 0 && end == 0)
        {
            Swal.fire({
             icon: 'error',
            text: 'Vui lòng chọn ngày cần xem!',
             });  
        }
        else{
        $.ajax({
            type:"GET",
            url:'tim-bao-cao-chi',
            dataType:"JSON",
            data:{
                start:start,
                end:end,
            },
            success:function(response)
            {
                var content = `
                         <thead>
                                <tr>
                                    <td>Số lượng nhập kho</td>
                                    <td>Tổng chi phí phải trả</td>
                                    <td>Ghi chú</td>
                                </tr>
                                    </thead>
                                    <tbody>
                                         <tr>
                                         <td>
                                            <input hidden id="ip__bc--sl" type="number" name="chiSoluong"/>
                                            <span id="text__bc--sl"></span>
                                         </td>
                                         <td>
                                              <input hidden id="ip__bc--tt"type="number" name="chiTongtien"/>
                                              <span id="text__bc--tt"></span>&nbsp;VND
                                         </td>
                                         <td> <input class="ip__ghichu" name="chiGhichu" type="text"  placeholder="Nhập ghi chú nếu có..." /></td>
                                         <td hidden>
                                            <input hidden id="chiNgaybd" name="chiNgaybd" type="date" />
                                            <input hidden id="chiNgaykt" name="chiNgaykt" type="date" />
                                         </td/>
                                     </tr>
                                      <tr>
                                        <td colspan="4">
                                              <button type="submit" class="btn btn-primary">Xác nhận</button>
                                        </td>
                                     </tr>
                                    </tbody>`;
                table.innerHTML= content;
                var ip_bc_sl = document.getElementById("ip__bc--sl");
                var ip_bc_tt = document.getElementById("ip__bc--tt");
                var text_bc_sl = document.getElementById("text__bc--sl");
                var text_bc_tt = document.getElementById("text__bc--tt");
                result = response.message;
                if(result == 0)
                {
                    ip_bc_sl.value = response.tongsp;
                    text_bc_sl.innerHTML = response.tongsp;
                    ip_bc_tt.value = response.tongtien;
                    text_bc_tt.innerHTML = response.tongtien;
                    document.getElementById("chiNgaybd").value = response.start;
                    document.getElementById("chiNgaykt").value = response.end;
                }
            }
        });
        }
    });
</script>
  @endsection
 