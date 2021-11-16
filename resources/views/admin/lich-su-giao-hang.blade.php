@extends('admin.layout')
@section('content')
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid"> 
                    <!-- DataTales Example -->
                    <div class="card shadow row">
                        <div class="card-header py-3">
                            <h2 class="m-0 font-weight-bold text-primary text-center">Lịch sử giao hàng</h2>
                            	
                        </div>
                    	<br/>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                           <th>Cá nhân thực hiện</th>
                                            <th>Chi tiết hoạt động</th>
                                            <th>Thời gian thực hiện</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;">
                                        <tr>
                                           <th>Cá nhân thực hiện</th>
                                            <th>Chi tiết hoạt động</th>
                                            <th>Thời gian thực hiện</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->adTaikhoan}}</td>
                                            <td>{{$value->alChitiet}}</td>
                                            <td>{{$value->alNgaygio}}</td>

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