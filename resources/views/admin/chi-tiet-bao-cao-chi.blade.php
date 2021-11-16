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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Chi tiết báo cáo chi</h3>
                           <span></span><span></span>
                            <a class="btn btn-primary" href="{{URL::to('lap-bao-cao-chi')}}">+&nbsp;Lập báo cáo chi</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTableThu" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã</th>
                                            <th>Ngày lập</th>
                                            <th>Từ ngày</th>
                                            <th>Đến ngày</th>
                                            <th>Tổng sản phẩm nhập</th>
                                            <th>Chi tiêu</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->chiMa}}</td>
                                            <td>
                                               {{$value->chiNgaylap}}
                                            </td>
                                            <td>
                                               {{$value->chiNgaybd}}
                                            </td>
                                            <td>
                                               {{$value->chiNgaykt!=NULL?$value->chiNgaykt:"Không"}}
                                            </td>
                                           <td>
                                               {{$value->chiSoluong}}
                                            </td>
                                            <td>
                                               {{number_format($value->chiTongtien)}}&nbsp;VND
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
                                           <td class="btn-primary"><b>Mã phiếu nhập</b></td>
                                           <td class="btn-primary"><b>Người nhập</b></td>
                                           <td class="btn-primary"><b>Ngày nhập</b></td>
                                           <td></td>
                                            <td></td>
                                            <td></td>
                                       </tr>
                                       @foreach($data2 as $v)
                                       <tr>
                                            <td>{{$v->pnMa}}</td>
                                            <td>{{$v->adTen}}</td>
                                            <td>{{$v->pnNgaylap}}</td>
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
 