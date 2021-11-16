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
                                            <th>Ngày lập</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->thuMa}}</td>
                                            <td>{{$value->adTen}}</td>
                                            <td>
                                               {{$value->thuNgaylap}}
                                            </td>
                                            <td>
                                               {{$value->thuNgaybd}}
                                            </td>
                                            <td>
                                               {{$value->thuNgaykt!=NULL?$value->thuNgaykt:"Không"}}
                                            </td> 
                                           <td><a href="{{URL::to('chi-tiet-bao-cao-thu/'.$value->thuMa)}}">chi tiết</a></td>
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
 