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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Xử lý</h3>
                            <span></span> <span></span> <span></span>
                        </div>
                    </div>
                    <br/><br/>
                 
                    @foreach($data as $data)
                    <div class="text-left">Mã đơn:&nbsp;<b>{{$data->hdMa}}</b></div>
                    <div class="text-left">Tên khách hàng:&nbsp;<b>{{$data->khTen}}</b></div>
                    <div class="text-left">Địa chỉ:&nbsp;<b>{{$data->hdDiachi}}</b></div><div><div class="text-left">Số điện thoại:&nbsp;<b>{{$data->hdSdtnguoinhan}}</b></div></div>
                  <div class="text-left">Tình trạng đơn hàng:&nbsp;<b>{{$data->hdTinhtrang==1?"Đang giao, chưa thanh toán":"Đã thanh toán online, đang giao"}}</b></div>
                    <div class="text-left">Nhân viên giao hàng:&nbsp;<b>{{$data->adTen}}</b></div>
                    @if($data->vcMa!=NULL)
                    <div class="text-left">Mã vocher áp dụng:&nbsp;<b>{{$data->vcMa}}</b></div>
                    <div class="text-left">Giá được giảm theo vocher:&nbsp;<b>{{number_format($data->hdGiakhuyenmai)}}VND</b></div>
                    @endif
                    <div class="text-left">Ghi chú:&nbsp;<b>{{$data->hdGhichu}}</b></div>
                    <br/>
                    <table border="1" style="width: 100%;">
                        <thead>
                            <tr>
                                <td>Sản phẩm hỏng</td>
                                <td>Sản phẩm bình thường</td>
                                <td>Mã serial</td>
                                <td>Tên sẩn phẩm, dịch vụ</td>
                                <td>Đơn giá</td>
                                <td>Giá sau khuyến mãi</td>
                                <td>Thành tiền</td>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{URL::to('tien-hanh-tach-don/'.$data->hdMa)}}" method="POST">
                                {{ csrf_field() }}
                            @foreach($data2 as $key => $ct)
                            <tr>
                                <td><input name="spHong[]" type="checkbox" value="{{$ct->serMa}}"/></td>
                                <td><input name="spBinhthuong[]" type="checkbox" value="{{$ct->serMa}}"/></td>
                                <td>{{$ct->serMa}}</td>
                                <td>{{$ct->spTen}}</td>
                                <td><input name="dongia[]" type="text" hidden readonly value="{{$ct->cthdGia}}"/>{{number_format($ct->cthdGia)}}&nbsp;VND</td>
                                <td>
                                    @if(strlen($ct->cthdTrigiakm)<=2 && strlen($ct->cthdTrigiakm)>=1)
                                    {{$ct->cthdTrigiakm}}%
                                    @elseif(strlen($ct->cthdTrigiakm)>2)
                                    {{number_format($ct->cthdTrigiakm)}}VND
                                    @else
                                    0
                                    @endif
                                </td>
                                <td>
                                    @if($ct->cthdTrigiakm != null)
                                    @if(strlen($ct->cthdTrigiakm)<=2 && strlen($ct->cthdTrigiakm)>=1)
                                        {{number_format($ct->cthdGia-($ct->cthdGia*($ct->cthdTrigiakm*0.01)))}}VND
                                    @elseif(strlen($ct->cthdTrigiakm)>2)
                                        {{number_format($ct->cthdGia-$ct->cthdTrigiakm)}}VND
                                    @endif
                                    @endif
                                     @if($ct->cthdTrigiakm == null || $ct->cthdTrigiakm ==0)
                                     {{number_format($ct->cthdGia)}}&nbsp;VND
                                     @endif
                                </td>
                            </tr>
                            @endforeach
                    </table>
                    <br/>

                    <div class="col-lg-12 text-right">
                       <span>
                        Tổng tiền hàng:&nbsp;{{number_format($data->hdTongtien)}}&nbsp;VND
                        </span>
                    </div>
                     <div class="row justify-content-around">
                         <a class="btn btn-dark" href="{{URL::to('don-hang')}}">Trở về</a>
                        @if($data->hdTinhtrang !=4 )
                        <a class="btn btn-danger" href="{{URL::to('huy-don-hang/'.$data->hdMa)}}">Hủy toàn đơn</a>
                        @endif
                        <button class="btn btn-success" value="update" name="button">Cập nhật lại đơn hàng</button>
                        <button type="submit" class="btn btn-primary" value="split" name="button">Tiến hành tách đơn</button>
                    </div>
                </form>  
                    @endforeach
                        </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

  @endsection
 