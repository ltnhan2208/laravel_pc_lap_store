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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Danh sách đơn hàng</h3>
                             <span></span><span></span>
                             <a class="btn btn-primary" style="width:200px" href="{{URL::to('taodonhangview')}}">
                            <i class="fas fa-plus"></i>  Tạo đơn hàng mới</a>
                        </div>
                         <br/>
                             <ul class="menu__donhang">
                                <li onclick="show_xong()" id="btn__xong">Đơn hàng hoàn thành</li>
                                    @if(Session::get('hdTinhtrang')!=null)
                                    <li onclick="show_moi()" style="color:red;" id="btn__moi">Đơn hàng mới({{$noteDonhang}})</li>
                                    @else
                                     <li onclick="show_moi()" id="btn__moi">Đơn hàng mới</li>
                                     @endif
                                </li>
                                <li onclick="show_giao()" id="btn__giao">Đơn hàng đang giao</li>
                                <li onclick="show_tach()" id="btn__tach">Đơn hàng đã cập nhật</li>
                                 @if(Session::get('hdTinhtrang1')!=null)
                                <li onclick="show_huy()" id="btn__huy" style="color: red;">Đơn hàng khách hủy({{$noteDonhang1}})</li>
                                 @else
                                     <li  onclick="show_huy()" id="btn__huy">Đơn hàng khách hủy</li>
                                @endif

                            </ul>
                            <div id="don_hang_huy" class="card-body" style="display: none;">
                            <div class="table-responsive">
                                <h3>Đơn hàng đã bị hủy</h3>
                                <table class="table table-bordered" id="dataTable4" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            
                                            <th>Người đặt</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;">
                                        <tr>
                                           <th>Mã đơn hàng</th>
                                         
                                            <th>Người đặt</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data4 as $value)
                                        <tr>
                                            <td>{{$value->hdMa}}</td>
                                            <td>{{$value->khTen}}</td>
                                            <td>{{$value->hdNgaytao}}</td>
                                            <td>{{$value->hdSoluongsp}}</td>
                                            <td>{{number_format($value->hdTongtien)}}&nbsp;VND</td>
                                            <td style="color:red">{{$value->hdTinhtrang==9?"Khách hàng đã hủy":""}}</td>
            
                                            <td>
                                                <a class="btn btn-primary" href="{{URL::to('chi-tiet-phieu-thu/'.$value->hdMa)}}">Chi tiết</a>
                                            </td>    
                                        </tr>
                                    @endforeach
                                    @foreach($data5 as $value)
                                        <tr>
                                            <td>{{$value->hdMa}}</td>
                                            <td>{{$value->khTen}}</td>
                                            <td>{{$value->hdNgaytao}}</td>
                                            <td>{{$value->hdSoluongsp}}</td>
                                            <td>{{number_format($value->hdTongtien)}}&nbsp;VND</td>
                                            <td style="color:red">{{$value->hdTinhtrang==10?"Đã hủy":""}}</td>
            
                                            <td>
                                                <a class="btn btn-primary" href="{{URL::to('chi-tiet-phieu-thu/'.$value->hdMa)}}">Chi tiết</a>
                                            </td>    
                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!---------------------------------------2----------------------------------------------->
                          
                        <div id="don_hang_moi" class="card-body" style="display: none;">
                            <div class="table-responsive">
                                 <h3>Đơn hàng chưa thanh toán</h3>
                                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                     <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Người đặt</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                     <tfoot style="display:none;">
                                        <tr>
                                           <th>Mã đơn hàng</th>
                                            <th>Người đặt</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data1 as $donmoi)
                                        <tr>
                                            <td>{{$donmoi->hdMa}}</td>
                                            <td>{{$donmoi->khTen}}</td>
                                            <td>{{$donmoi->hdNgaytao}}</td>
                                            <td>{{$donmoi->hdSoluongsp}}</td>
                                            <td>{{$donmoi->hdTongtien}}</td>
                                            <td style="color:red">{{$donmoi->hdTinhtrang==0?"Đơn hàng mới, chưa thanh toán":"Đơn hàng mới, đã thanh toán"}}</td>
                                           
                                            <td><a class="btn btn-primary" href="{{URL::to('xu-ly-don-moi/'.$donmoi->hdMa)}}">Bắt đầu giao</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                         <!---------------------------------------3----------------------------------------------->
                               
                            <div class="card-body">
                            <div  id="don_hang_giao" class="table-responsive" style="display: none;">
                                <h3>Đơn hàng đang giao</h3>
                                <table class="table table-bordered" id="dataTable3" width="100%" cellspacing="0">
                                     <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Nhân viên giao</th>
                                            <th>Người đặt</th>
                                            <th>Ngày tạo</th>
                                          {{--   <th>Số lượng</th> --}}
                                           {{--  <th>Tổng tiền</th> --}}
                                            <th>Cập nhật từ đơn</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                     <tfoot style="display:none;">
                                        <tr>
                                           <th>Mã đơn hàng</th>
                                           <th>Nhân viên giao</th>
                                            <th>Người đặt</th>
                                            <th>Ngày tạo</th>
                                          {{--   <th>Số lượng</th> --}}
                                           {{--  <th>Tổng tiền</th> --}}
                                           <th>Cập nhật từ đơn</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                              <th></th>
                                              <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data2 as $value)
                                        <tr>
                                            <td>{{$value->hdMa}}</td>
                                            <td>{{$value->adTen}}</td>
                                            <td>{{$value->khTen}}</td>
                                            <td>{{$value->hdNgaytao}}</td>
                                             <td>{{$value->hdBosung!=NULL?$value->hdBosung:"Không có"}}</td>
                                          {{--   <td>{{$value->hdSoluongsp}}</td> --}}
                                           {{--  <td>{{number_format($value->hdTongtien)}}&nbsp;VND</td> --}}
                                            <td>@if($value->hdTinhtrang==1 || $value->hdTinhtrang==6)
                                                Đang giao, chưa thanh toán
                                                @elseif($value->hdTinhtrang==4 || $value->hdTinhtrang==8)
                                                Đang giao, đã thanh toán
                                            @endif
                                            </td>
                                            <td><a href="{{URL::to('thanhtoan/'.$value->hdMa)}}">{{$value->hdTinhtrang==1||$value->hdTinhtrang==4||$value->hdTinhtrang==6||$value->hdTinhtrang==8?"Xác nhận đã giao":""}}</a></td>
                                            <td> <a class="btn btn-primary" href="{{URL::to('xu-ly-tach-don/'.$value->hdMa)}}">Tách đơn</a></td>
                                            <td><a class="btn btn-primary" href="{{URL::to('chi-tiet-phieu-thu/'.$value->hdMa)}}">Chi tiết</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                            </div></div>
                             <!---------------------------------------4----------------------------------------------->
                            <div  id="don_hang_xong">
                            <div class="table-responsive">
                                <h3>Đơn hàng đã hoàn thành</h3>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                     <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Nhân viên giao</th>
                                            <th>Người đặt</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                     <tfoot style="display:none;">
                                        <tr>
                                           <th>Mã đơn hàng</th>
                                           <th>Nhân viên giao</th>
                                            <th>Người đặt</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data3 as $value)
                                        <tr>
                                            <td>{{$value->hdMa}}</td>
                                            <td>{{$value->adTen}}</td>
                                            <td>{{$value->khTen}}</td>
                                            <td>{{$value->hdNgaytao}}</td>
                                            <td>{{$value->hdSoluongsp}}&nbsp;sản phẩm</td>
                                            <td>{{number_format($value->hdTongtien)}}&nbsp;VND</td>
                                            <td style="color:green">{{$value->hdTinhtrang==2?"Đã thanh toán":""}}</td>
                                            <td>
                                                <a class="btn btn-primary" href="{{URL::to('chi-tiet-phieu-thu/'.$value->hdMa)}}">Chi tiết</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>

                              <!---------------------------------------4----------------------------------------------->
                            <div  id="don_hang_tach">
                            <div class="table-responsive">
                                <h3>Đơn hàng đã tách</h3>
                                <table class="table table-bordered" id="dataTable5" width="100%" cellspacing="0">
                                     <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Cập nhật từ đơn hàng</th>
                                            <th>Người đặt</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng</th>
                                           
                                            <th>Tình trạng</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                     <tfoot style="display:none;">
                                        <tr>
                                           <th>Mã đơn hàng</th>
                                            <th>Đơn hàng được cập nhật</th>
                                          
                                            <th>Người đặt</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng</th>
                                          
                                            <th>Tình trạng</th>
                                            <th></th>
                                            {{-- <th></th> --}}
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data6 as $value)
                                        <tr>
                                            <td>{{$value->hdMa}}</td>
                                            <td>{{$value->hdBosung}}</td>
                                            <td>{{$value->khTen}}</td>
                                            <td>{{$value->hdNgaytao}}</td>
                                            <td>{{$value->hdSoluongsp}}&nbsp;sản phẩm</td>
                                            {{-- <td>{{number_format($value->hdTongtien)}}&nbsp;VND</td> --}}
                                             <td>{{$value->hdTinhtrang==5?"Đơn bổ sung, chưa thanh toán":"Đơn bổ sung, đã thanh toán"}}</td>
                                               <td><a class="btn btn-primary" href="{{URL::to('xu-ly-don-moi/'.$value->hdMa)}}">Bắt đầu giao</a>
                                            </td>
                                          {{--   <td>
                                                <a class="btn btn-primary" href="{{URL::to('chi-tiet-phieu-thu/'.$value->hdMa)}}">Chi tiết</a>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

@if(Session::has('success'))
<script type="text/javascript">
    Swal.fire({
    icon: 'success',
    title: 'Thông báo: ',
    text: '{{Session::get('success')}}',
    });
</script>
@endif
<script src="{{URL::asset("public/style_admin/js/js3.js")}}"></script>
  @endsection