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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý sản phẩm</h3>
                            <span></span><span></span><span></span>
                           <a  href="{{URL::to('/themsanpham')}}" class="btn btn-primary">
                                       
                                        <span class="text"><b>+&nbsp;Thêm sản phẩm</b></span>
                                    </a>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã</th>
                                            <th>Hình</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Đang khuyến mãi</th>
                                            <th>Nhà cung cấp</th>
                                            
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot  style="display:none;">
                                        <tr>
                                             <th>Mã sản phẩm</th>
                                             <th>hình</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                           <th>Đang khuyến mãi</th>
                                            <th>Nhà cung cấp</th>
                                            
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         @foreach($data as $value)
                                        <tr>
                                           <th>{{$value->spMa}}</th>
                                           <th><img src="{{{"public/images/products/".$value->spHinh}}}" width="45" height="45"></th>
                                            <th>{{$value->spTen}}</th>
                                            <th>{{number_format($value->spGia)}}&nbsp;VND</th>
                                           {{--  <th>{{$value->kmMa!=null?"$value->kmMa":" - "}}</th> --}}
                                            <th>{{$value->spSlkmtoida!=null?"$value->spSlkmtoida":" - "}}</th>
                                            <th>{{$value->nccTen}}</th> 
                                        <th>  
                                            @if($value->spTinhtrang == 0)
                                                 <a href="{{URL::to('an-hien-sp/'.$value->spMa)}}" class="btn btn-dark" ui-toggle-class="">Ẩn</a>
                                                  @else
                                                   <a href="{{URL::to('an-hien-sp/'.$value->spMa)}}" class="btn btn-success" ui-toggle-class="">Hiện</a>
                                                  @endif
                                                &nbsp;
                                                <a href="{{URL::to('updateSanpham/'.$value->spMa)}}" class="btn btn-primary" ui-toggle-class="">
                                                   Cập nhật
                                                </a>&nbsp;
                                                <a class="btn btn-danger" href="{{URL::to('deleteSanpham/'.$value->spMa)}}" >
                                                  Xóa
                                                </a>
                                        </th>

                                        </tr>
                                        
                                        @endforeach
{{--  da nhap --}}
                                      {{--   @foreach($exist as $value) --}}
                                    {{--     <tr>
                                           <th>{{$value->spMa}}</th>
                                           <th><img src="{{{"public/images/products/".$value->spHinh}}}" width="45" height="45"></th>
                                            <th>{{$value->spTen}}</th>
                                            <th>{{number_format($value->spGia)}}&nbsp;VND</th>
                                            <th>{{$value->spSlkmtoida!=null?"$value->spSlkmtoida":" - "}}</th>
                                            <th>{{$value->nccTen}}</th> --}}
                                     {{--    <td>Đang sử dụng</td> --}}
                                 {{--     <td>
                                                  @if($value->spTinhtrang == 0)
                                                 <a href="{{URL::to('an-hien-sp/'.$value->spMa)}}" class="btn btn-dark" ui-toggle-class="">Ẩn</a>
                                                  @else
                                                   <a href="{{URL::to('an-hien-sp/'.$value->spMa)}}" class="btn btn-success" ui-toggle-class="">Hiện</a>
                                                  @endif
                                                &nbsp;
                                           <a href="{{URL::to('updateSanpham/'.$value->spMa)}}" class="btn btn-primary" ui-toggle-class="">
                                                   Cập nhật
                                                </a>&nbsp;
                                          
                                     </td>
                                        </tr> --}}
                                        
                                      {{--   @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
 
                </div>
                <!-- /.container-fluid -->

  @endsection