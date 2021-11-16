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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý bảo hành</h3>
                            <span></span><span></span><span></span>
                             <a class="btn btn-primary" href="{{URL::to('addbaohanhview')}}"><b>+&nbsp;Bảo hành sản phẩm</b></a>
                        </div>
                        
                        <div class="card-body">
                   
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã bảo hành</th>
                                            <th>Serial sản phẩm</th>
                                            <th>Ngày bảo hành</th>
                                            <th>Số điện thoại khách</th>
                                            <th>Nội dung bảo hành</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                
                                    <tbody id="tbody">
                                        @foreach($log as $v)
                                            <tr>
                                             <td>{{$v->bhMa}}</td>
                                                <td>{{$v->serial}}</td>
                                                <td>{{$v->bhNgay}}</td>
                                                <td>{{$v->bhSdt}}</td>
                                                <td>{{$v->bhNoidung}}</td>
                                                    @if($v->bhTinhtrang ==0)
                                                    <td>
                                                        <span style="color: red; font-weight: bold;">Đã nhận sản phẩm bảo hành</span>
                                                        </td>
                                                         <td><a href="{{URL::to('xacnhantrahang/'.$v->bhMa)}}">Xác nhận trả hàng</a></td>
                                                    @else
                                                    <td>
                                                        <span style="color: green;font-weight: bold;">Đã trả hàng</span>
                                                    </td>
                                                    @endif
                                           
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
  @endsection