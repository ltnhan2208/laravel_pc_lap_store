@extends('admin.layout')
@section('content')

      <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                     <div class="card-body">
                        <div id="content__print" class="table-responsive">
                             <table class="table table-bordered" width="100%" cellspacing="0">
                        @foreach($data as $data)
                        
                        <thead>
                            <tr>
                                <td colspan="5" style="text-align: left;">
                                   <h2 class="m-0 font-weight-bold text-primary" style="text-align: center;">Chi tiết phiếu nhập</h2> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align: left;"><label>Mã phiếu nhập:&nbsp;{{$data->pnMa}}</label><br/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align: left;"> <label>Ngày lập:&nbsp;{{$data->pnNgaylap}}</label><br/>
                                </td>
                            </tr>
                             <tr>
                                <td colspan="5" style="text-align: left;">  <label>Tên người lập:&nbsp;{{$data->adTen}}</label><br/>
                                </td>
                            </tr>
                                    <tr>
                                        <td>Mã serial</td>
                                        <td>Sản phẩm</td>
                                        <td>Nhà cung cấp</td>
                                        <td>Số lượng</td>
                                        <td>Đơn giá</td>
                                    </tr>
                                </thead>
                                <tbody>
                                     
                                            @foreach($data2 as $data2)
                                            <tr>
                                                <td>{{$data2->serMa}}</td>
                                                <td>{{$data2->spTen}}</td>
                                                <td>{{$data2->nccTen}}</td>
                                                <td>{{$data2->ctpnSoluong}}</td>
                                                <td>{{number_format($data2->ctpnDongia)}}&nbsp;VND</td>
                                            </tr>
                                            @endforeach
                                         
                                  
                                    <tr>
                                        <td colspan="5" style="text-align: right">Tổng sản phẩm:&nbsp;{{$data->pnSoluongsp}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"  style="text-align: right">Tổng chi phí:&nbsp;{{number_format($data->pnTongtien)}}&nbsp;VND</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach
                         </div>
                    </div>
                  
                   
                  
                    <button class="btn btn-info" type="button" onclick="back()">Trở về</button>
                    &emsp; <button class="btn btn-secondary" onclick="printt('content__print')">In phiếu nhập</button>
                </div>
            </div>
            
      </div>


<script>
   
    function printt(content__print)
    {
        var restorepage = document.body.innerHTML; 
         var content = document.getElementById(content__print).innerHTML;
         document.body.innerHTML = content;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>

@endsection