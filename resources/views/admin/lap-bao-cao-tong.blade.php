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
                                  <form action="{{URL::to('them-bao-cao-tong')}}" method="POST">
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
            url:'tim-bao-cao-tong',
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
                                    <td>Tổng hàng xuất</td>
                                    <td>Tổng hàng nhập</td>
                                    <td>Ghi chú</td>
                                </tr>
                                    </thead>
                                    <tbody>
                                         <tr>
                                         <td>
                                            <input hidden id="ip__bc--hx" type="number" name="bcTonghangxuat"/>
                                            <span id="text__bc--hx"></span>
                                         </td>
                                         <td>
                                              <input hidden id="ip__bc--hn"type="number" name="bcTonghangnhap"/>
                                              <span id="text__bc--hn"></span>
                                         </td>
                                         <td> <input class="ip__ghichu" name="bcGhichu" type="text"  placeholder="Nhập ghi chú nếu có..." /></td>
                                         <td hidden>
                                            <input hidden id="bcNgaybd" name="bcTungay" type="date" />
                                            <input hidden id="bcNgaykt" name="bcDenngay" type="date" />
                                             <input hidden id="chiSoluong" name="chiSoluong" type="number" />
                                            <input hidden id="chiTongtien" name="chiTongtien" type="number" />
                                             <input hidden id="thuSoluong" name="thuSoluong" type="number" />
                                            <input hidden id="thuTongtien" name="thuTongtien" type="number" />
                                         </td/>
                                     </tr>
                                     <tr>
                                        <td colspan="4">
                                              <button type="submit" class="btn btn-primary">Xác nhận</button>
                                        </td>
                                     </tr>
                                    </tbody>`;
                table.innerHTML= content;
                var ip_bc_hn = document.getElementById("ip__bc--hn");
                var ip_bc_hx = document.getElementById("ip__bc--hx");
                var text_bc_hn = document.getElementById("text__bc--hn");
                var text_bc_hx = document.getElementById("text__bc--hx");
                result = response.message;
                if(result == 0)
                {
                    ip_bc_hn.value = response.tongnhap;
                    text_bc_hn.innerHTML = response.tongnhap;
                    ip_bc_hx.value = response.tongxuat;
                    text_bc_hx.innerHTML = response.tongxuat;
                    document.getElementById("chiSoluong").value = response.spChi;
                    document.getElementById("chiTongtien").value = response.ttChi;
                    document.getElementById("thuSoluong").value = response.spXuat;
                    document.getElementById("thuTongtien").value = response.ttThu;
                    document.getElementById("bcNgaybd").value = response.start;
                    document.getElementById("bcNgaykt").value = response.end;
                }
            }
        });
        }
    });
</script>
  @endsection
 