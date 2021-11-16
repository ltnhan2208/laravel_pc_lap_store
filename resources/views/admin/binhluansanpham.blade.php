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
                            <h2 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h2>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Mã khách hàng</th>
                                           
                                            <th>Thông báo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;">
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Mã khách hàng</th>
                                           
                                           
                                            <th>Thông báo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                       
                                         @foreach($dg as $dg) 
                                           
                                        <tr>
                                             <td>{{$dg->spMa}}</td>
                                            <td>{{$dg->khTen}}</td>
                                            
                                            <td> 
                                                @if($dg->dgTrangthai==1)
                                                <span style="color: red;">Có thông báo mới</span>
                                                @else
                                                <span style="color: green;">Không có thông báo mới</span>

                                                @endif
                                            </td>
                                            <td>
                                                <a> <a href="{{URL::to('/chitietBLSP/'.$dg->dgMa)}}" class="active" ui-toggle-class="">
                                                    Xem chi tiết  
                                                </a>
                                            </td>
                                        </tr>
                                        
                                        @endforeach
                                      
                                       
                                    </tbody>
                                </table>
                                <br/>
                                <button class="btn btn-info" type="button" onclick="back()">Trở về</button>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

  @endsection