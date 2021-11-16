@extends('admin.layout')
@section('content')

<div id="content-wrapper" class="d-flex flex-column">
<!-- Main Content -->
    <div id="content">
                <!-- Begin Page Content -->
                <br/>
        <div class="container">
                @foreach($data as $data)
            <div class="row">
            <div id="content__print" class="col-lg-12 text-center">
                <div class="row">
                <div class="col-lg-2">
                    @foreach($logo as $lg)
                    <img src="{{URL::asset('public/images/banners/'.$lg->bnHinh)}}">
                    @endforeach
                </div>
                <div class="col-lg-8">
                     @if($donhuy!=1)
                     <h2 class="text-center"><b>ĐƠN HÀNG BÁN HÀNG</b></h2>
                     @elseif($donhuy==1)
                      <h2 class="text-center"><b>ĐƠN HÀNG ĐÃ HỦY</b></h2>
                      @endif
                </div>
                </div>
                 @if($donhuy!=1)
                      <div id="time" class="row justify-content-around"></div>
                @endif
                <div id="time" class="row justify-content-around"></div>
                <div class="row justify-content-around">Mã đơn hàng:&nbsp;{{$data->hdMa}}</div>
                <div class="row justify-content-around"><b>Hotline:0203344301</b></div>
                <br/><br/>
                <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="text-left">Đơn vị bán hàng:&nbsp;<b>STUCRF</b></div>
                    @if($data->hdBosung!=NULL)
                        <div class="text-left">Đơn hàng được cập nhật từ đơn:&nbsp;<b>{{$data->hdBosung}}</b></div>
                    @endif
                    <div class="text-left">Tên khách hàng:&nbsp;<b>{{$data->khTen}}</b></div>
                    <div class="text-left">Địa chỉ:&nbsp;<b>{{$data->hdDiachi}}</b></div><div><div class="text-left">Số điện thoại:&nbsp;<b>{{$data->hdSdtnguoinhan}}</b></div></div>
                  
                    <div class="text-left">Nhân viên giao hàng:&nbsp;<b>{{$data->adTen}}</b></div>
                   
                    <div class="text-left">Ghi chú:&nbsp;<b>{{$data->hdGhichu}}</b></div>
                    <br/>
                    <table border="1" style="width: 100%;">
                        <thead>
                            <tr>
                                <td>STT</td>
                                <td>Tên sẩn phẩm, dịch vụ</td>
                                <td>Đơn giá</td>
                                <td>Giá sau khuyến mãi</td>
                                <td>Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data2 as $key => $ct)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$ct->spTen}}</td>
                                <td>{{number_format($ct->cthdGia)}}&nbsp;VND</td>
                                <td>{{$ct->cthdTrigiakm == null?'0':$ct->cthdTrigiakm."%"}}</td>
                                <td>
                                    @if($ct->cthdTrigiakm != null)
                                        {{$ct->cthdGia-($ct->cthdGia*($ct->cthdTrigiakm*0.01))}}VND
                                    @else
                                    {{number_format($ct->cthdGia)}}&nbsp;VND
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                    </table>
                    <div class="col-lg-12 text-right">
                       <span>
                        Tổng tiền hàng:&nbsp;{{number_format($data->hdTongtien)}}&nbsp;VND
                        </span>
                    </div>
                    @if(!empty($hdOld))
                    @foreach($hdOld as $old)
                        @if($data->hdTinhtrang==8)
                        <div class="col-lg-12 text-right">Khách đã thanh toán trước:&nbsp;{{number_format($old->hdTongtien)}}&nbsp;VND</div>
                        @if($old->hdTongtien > $data->hdTongtien)
                        <div class="col-lg-12 text-right">Số tiền phải trả lại khách là:&nbsp;{{number_format($old->hdTongtien-$data->hdTongtien)}}&nbsp;VND</div>
                        @elseif($old->hdTongtien < $data->hdTongtien)
                         <div class="col-lg-12 text-right">Số tiền khách phải trả thêm là:&nbsp;{{number_format($data->hdTongtien-$old->hdTongtien)}}&nbsp;VND</div>
                          @elseif($old->hdTongtien == $data->hdTongtien)
                           <div class="col-lg-12 text-right">Khách đã thanh toán đầy đủ</div>
                        @else
                         
                           @endif
                        @endif
                       
                     
                        
                   
                    @endforeach
                    @endif
                    <br/><br/>
                    @if($donhuy != 1)
                    <div class="row justify-content-around">
                        <div >
                            <span>Khách hàng</span><br/>
                            <span>(Ký, họ tên)</span>
                        </div>
                        <div >
                            <span>Người giao</span><br/>
                            <span>(Ký, họ tên)</span>
                        </div>
                        <div >
                            <span>Chủ cửa hàng</span><br/>
                            <span>(Ký, họ tên)</span>
                        </div>
                    </div>
                    @endif
                    <br/><br/><br/>
                </div>
                 <div class="col-lg-1"></div>
                </div>
                </div>
                </div>
                <br/>
        </div>
        <br/><br/>
            <div class="row justify-content-around">
            <button class="btn btn-info" type="button" onclick="back()">Trở về</button>
             @if($data->hdTinhtrang==0 || $data->hdTinhtrang==3 || $data->hdTinhtrang==5 || $data->hdTinhtrang==7)
            <button type="submit" name="btn_add" class="btn btn-primary">Bắt đầu giao hàng</button>
             @else
            <button onclick="printt('content__print')" class="btn btn-dark" >In ra phiếu thu</button>
             @endif
         </div>
         @endforeach
    </div>
    <br/>
</div>

    
                                     
           
                               
                              
<script>
    function printt(content__print)
    {
        var restorepage = document.body.innerHTML; 
         var content = document.getElementById('content__print').innerHTML;
         document.body.innerHTML = content;
        window.print();
        document.body.innerHTML = restorepage;
    }
    var time = document.getElementById('time');
    var date = new Date();
    var dd = date.getDate();
    var mm = date.getMonth()+1;
    var yy = date.getFullYear();
    time.innerHTML = "Ngày: "+dd+"-"+mm+"-"+yy;
</script>
@endsection