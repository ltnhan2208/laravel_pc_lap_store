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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý kho</h3>
                            <span></span> <span></span> <span></span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;">
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->spTen}}</td>
                                            <td>
                                               {{$value->khoSlsphong}}
                                            </td>
                                           <td><a href="{{URL::to('chi-tiet-kho-hong/'.$value->spMa)}}">Chi tiết</a></td>
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
 