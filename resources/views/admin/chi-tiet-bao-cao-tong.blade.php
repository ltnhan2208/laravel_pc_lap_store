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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Chi tiết báo cáo</h3>
                           <span></span><span></span>
                            <a class="btn btn-primary" href="{{URL::to('lap-bao-cao-tong')}}">+&nbsp;Lập báo cáo mới</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTableThu" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã báo cáo</th>
                                            <th>Ngày lập</th>
                                            <th>Từ ngày</th>
                                            <th>Đến ngày</th>
                                            <th>Tồn kho</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->bcMa}}</td>
                                            <td>
                                               {{$value->bcNgaylap}}
                                            </td>
                                            <td>
                                               {{$value->bcTungay}}
                                            </td>
                                            <td>
                                               {{$value->bcDenngay!=NULL?$value->bcDenngay:"Không"}}
                                            </td>
                                           <td>
                                               {{$value->bcTonkho}}
                                            </td>
                                        </tr>
                                    @endforeach
                                     <tr>
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
                                       </tr>
                                        @foreach($data3 as $v)
                                        <tr>
                                            <td>{{$v->hdMa}}</td>
                                            <td>{{$v->khTen}}</td>
                                            <td>{{$v->hdNgaytao}}</td>
                                             <td></td>
                                            <td></td>
                                        </tr>
                                         @endforeach
                                           <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                         <tr>
                                             <td class="btn-primary">Mã phiếu nhập</td>
                                            <td class="btn-primary">Người nhập</td>
                                            <td class="btn-primary">Ngày nhập</td> 
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
 