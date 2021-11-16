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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý phiếu nhập</h3>
                            <span></span><span></span><span></span>
                             <a  href="{{URL::to('lap-phieu-nhap')}}" class="btn btn-primary" >
                                        <span class="text"><b>+&nbsp;Lập phiếu nhập</b></span>
                                    </a>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã phiếu nhập</th>
                                            <th>Người lập</th>
                                            <th>Ngày lập phiếu</th>
                                            <th>Tổng sản phẩm nhập</th>
                                            <th>Tổng chi phí</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;display: none;">
                                        <tr>
                                           <th>Mã phiếu nhập</th>
                                           <th>Người lập</th>
                                           <th>Ngày lập phiếu</th>
                                           <th>Tổng sản phẩm nhập</th>
                                           <th>Tổng chi phí</th>
                                           <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($pn as $v)
                                        <tr>
                                          <td>{{$v->pnMa}}</td>
                                          <td>{{$v->adTen}}</td>
                                          <td>{{$v->pnNgaylap}}</td>
                                          <td>{{$v->pnSoluongsp}}</td>
                                          <td>{{number_format($v->pnTongtien)}}&nbsp;VND</td>
                                          <td><a href="{{URL::to('chi-tiet-phieu-nhap/'.$v->pnMa)}}">Chi tiết</a></td>
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
 