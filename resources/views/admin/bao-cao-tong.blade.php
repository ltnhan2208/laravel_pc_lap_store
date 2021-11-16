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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý báo cáo</h3>
                           <span></span><span></span>
                            <a class="btn btn-primary" href="{{URL::to('lap-bao-cao-tong')}}">+&nbsp;Lập báo cáo</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã</th>
                                            <th>Nhân viên lập</th>
                                            <th>Ngày lập</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;">
                                        <tr>
                                            <th>Mã</th>
                                            <th>Nhân viên lập</th>
                                            <th>Ngày lập</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->bcMa}}</td>
                                            <td>{{$value->adTen}}</td>
                                            <td>
                                               {{$value->bcNgaylap}}
                                            </td>
                                             <td>
                                               {{$value->bcTungay}}
                                            </td>
                                             <td>
                                               {{$value->bcDenngay}}
                                            </td>
                                           <td><a href="{{URL::to('chi-tiet-bao-cao-tong/'.$value->bcMa)}}">Chi tiết</a></td>
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
 