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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Tách đơn hàng</h3>
                            <span></span> <span></span> <span></span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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

                                   @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->hdMa}}</td>
                                            <td>{{$value->khTen}}</td>
                                            <td>{{$value->hdNgaytao}}</td>
                                            <td>{{$value->hdSoluongsp}}</td>
                                            <td>{{number_format($value->hdTongtien)}}&nbsp;VND</td>
                                            <td style="color:red">{{$value->hdTinhtrang==1?"Đang giao":"Đã thanh toán momo, đang giao"}}</td>
                                            <td>
                                                <a class="btn btn-primary" href="{{URL::to('xu-ly-tach-don/'.$value->hdMa)}}">Tách đơn</a>
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

  @endsection
 