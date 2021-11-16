@extends('admin.layout')
@section('content')
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shkhow row">
                        <div class="card-header row justify-content-around">
                            <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý khách hàng</h3>
                             <span></span> <span></span> <span></span>
                             <a  href="{{URL::to('/themkhachhang')}}" class="btn btn-primary" >
                                       <b>+&nbsp;Thêm khách hàng</b>
                                    </a>
                           
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Hình</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                             <th>Số điện thoại</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;">
                                        <tr>
                                             <th>Hình</th>
                                            <th>Tên khách hàng</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <th><img width="100" height="100" src="{{{'public/images/khachhang/'.$value->khHinh}}}" alt="Chưa có ảnh"/></th>
                                            <th>{{$value->khTen}}</th>
                                            <th>{{$value->khEmail}}</th>
                                            <th>{{$value->khSdt}}</th>
                                            <td>
                                              {{--   <a> <a href="{{URL::to('updateKhachhang/'.$value->khMa)}}" class="active" ui-toggle-class="">
                                                    <i class="fa far fa-edit"></i>
                                                </a>&nbsp;|
                                                <a  href="{{URL::to('deleteKhachhang/'.$value->khMa)}}">
                                                    <i class="fa fas fa-trash" style="color: red;"></i>
                                                </a></a> --}}
                                                @if($value->khQuyen==0)
                                                <a href="{{URL::to('khoa-khach-hang/'.$value->khMa)}}" class="btn btn-dark">
                                                   Khóa
                                                </a>
                                                @else
                                                 <a href="{{URL::to('khoa-khach-hang/'.$value->khMa)}}" class="btn btn-success">
                                                  Mở khóa
                                                </a>
                                                @endif
                                                &nbsp;
                                                <a href="{{URL::to('updateKhachhang/'.$value->khMa)}}" class="btn btn-primary">
                                                    Chi tiết
                                                </a>
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