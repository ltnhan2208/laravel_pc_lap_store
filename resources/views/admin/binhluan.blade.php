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
                            <h2 class="m-0 font-weight-bold text-primary">Thông tin bình luận</h2>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Tên sản phẩm</td>
                                            <th>Thông báo</td>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;">
                                        <tr>
                                         

                                            <th>Tên sản phẩm</td>
                                            <th>Thông báo</td>
                                            <th>Hành động</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        @php
                                            $check = array()
                                        @endphp
                                         @foreach($data as $key => $value) 
                                         @if(in_array($value->spTen, $check)==null)
                                         @php 
                                            array_push($check, $value->spTen)
                                         @endphp 
                                        <tr>
                                            
                                            
                                             <td>{{$value->spTen}}</td>
                                            <td> 
                                                @if($value->dgTrangthai==1)
                                                <span style="color: red;">Có thông báo mới</span>
                                                @else
                                                <span style="color: green;">Không có thông báo mới</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a> <a href="{{URL::to('/viewBLSP/'.$value->spMa)}}" class="active" ui-toggle-class="">
                                                    Xem   
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                      
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

  @endsection