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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý báo cáo thu</h3>
                           <span></span><span></span>
                            <a class="btn btn-primary" href="{{URL::to('lap-bao-cao-thu')}}">+&nbsp;Lập báo cáo thu</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTableThu" width="100%" cellspacing="0" border="1">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã</th>
                                            <th>Ngày lập</th>
                                            <th>Từ ngày</th>
                                            <td>Đến ngày</th>
                                            <th>Sản phẩm bán được</th>
                                            <th>Vốn thu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->thuMa}}</td>
                                            <td>
                                               {{$value->thuNgaylap}}
                                            </td>
                                            <td>
                                               {{$value->thuNgaybd}}
                                            </td>
                                            <td>
                                               {{$value->thuNgaykt!=NULL?$value->thuNgaykt:"Không"}}
                                            </td>
                                           <td>
                                               {{$value->thuSoluong}}
                                            </td>
                                            <td>
                                               {{number_format($value->thuTongtien)}}&nbsp;VND
                                            </td>
                                        </tr>
                                    @endforeach
                                       <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                      <tr>
                                           <td class="btn-primary"><b>Mã đơn hàng</b></td>
                                           <td class="btn-primary"><b>Khách hàng</b></td>
                                           <td class="btn-primary"><b>Ngày mua</b></td>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                       </tr>
                                       @foreach($data2 as $v)
                                       <tr>
                                            <td>{{$v->hdMa}}</td>
                                            <td>{{$v->khTen}}</td>
                                            <td>{{$v->hdNgaytao}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        
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
 