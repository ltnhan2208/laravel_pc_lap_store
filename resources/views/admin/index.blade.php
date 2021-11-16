@extends('admin.layout')
@section('content')
        <!-- Content Wrapper -->
        <div class="container-fluid" style="background-color: #161E43;">
             <br/>
        <div class="row justify-content-around">
              <h4 class="text-white">Số liệu cửa hàng</h4>
                  {{-- <form id="formTime" action="{{URL::to('searchThongke')}}" method="get"> --}}
            <form id="formTime" class="row justify-content-around">
                {{ csrf_field()}}
                <div>
                <span class="text-white">Bắt đầu:&nbsp;</span><input class="btn btn-light" name="start" type="date" />&emsp;
                <span class="text-white">Kết thúc:&nbsp;</span><input class="btn btn-light" name="end" type="date" /> &emsp;
                <button id="btnSearch" class="btn btn-outline-light">Xem</button>
            </div>
            </form>
        </div>
             <hr style="border: 1px solid white;" />
        
       <div class="box__width">
        <div class="width__responsive">
       <section id="content__1">
           <div class="row">
               <div class="content__1--item">
                   <label> <i class="fas fa-window-maximize"></i>&nbsp;Tổng đơn hàng</label>
                       @if($dh != null)
                       <div id="total_dh">{{$dh}}&nbsp;đơn</div> 
                       @endif
               </div>
               <div class="content__1--item">
                <label><i class="fas fa-dollar-sign"></i>&nbsp;Tổng tiền đơn hàng</label>
                    @if($total_price != null)
                       <div id="total_price">{{number_format($total_price)}}&nbsp;VND</div>
                       @endif
               </div>
               <div class="content__1--item">
                    <label><i class="fas fa-tv"></i>&nbsp;Đang bán</label>
                    <div>
                        @if($total_sp != null)
                       {{$total_sp}}&nbsp;sản phẩm
                       @endif
                         
                    </div>
               </div>
               <div class="content__1--item">
                    <label><i class="fas fa-dollar-sign"></i>&nbsp;Tổng chi tiêu</label>
                   
                         @if($total_pay != null)
                       <div id="total_pay">{{number_format($total_pay)}}&nbsp;VND</div>
                       @endif
                   
               </div>
           </div>
       </section>
       <br/>
        <div class="row justify-content-around">
           <div class="chart__order">
               <div class="order__title">
                   Tóm tắt đơn hàng 
               </div>
               <br/>
               <div class="row title__mid">
                    <div class="col-lg-12 text-center text">Đơn hoàn thành</div>
                    <div class="col-lg-12 text-center">{{number_format($total_price)}}&nbsp;VND</div></div>
                   <div class="box__order row justify-content-around">
                       <div class="box__order--item">
                            <i class="far fa-cart-arrow-down"></i>
                            <div class="text">Mới</div>
                            <div>{{$don_moi}}</div>
                        </div>
                       <div class="box__order--item">
                         <i class="far fa-truck"></i>
                           <div  class="text">Đang đang giao</div>
                           <div>{{$don_danggiao}}</div>
                       </div>
                       <div class="box__order--item">
                            <i class="far fa-calendar-check"></i>
                            <div  class="text">Hoàn thành</div>
                            <div>{{$don_xong}}</div>
                       </div>
                       <div class="box__order--item">
                          <i class="far fa-exclamation-circle"></i>
                            <div  class="text">Đang nợ khách</div>
                            <div>{{$don_no}}</div>
                       </div>
                   </div>
                </div>
                <!---------->
                <div class="chart__ship">
                    <div id="chart__ship--title">Đơn đang giao</div>
                    <table class="table table-bordered" id="dataTableIndex" width="100%" cellspacing="0">
                        <thead>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Tình trạng</th>
                            <th>Nhân viên giao</th>
                        </thead>
                        <tbody>
                            @foreach($show_dongiao as $v)
                            <tr>
                                <td> {{$v->hdMa}}</td>
                                <td class="tb__kh"> 
                                    @if($v->khHinh != null)
                                    <img src="{{URL::asset('public/images/khachhang/'.$v->khHinh)}}"/>
                                    @else
                                    <i class="far fa-user-circle"></i>
                                    @endif
                                    &nbsp;{{$v->khTen}}
                                </td>
                                <td>{{$v->hdTinhtrang==1?"Đang giao":""}}</td>
                                <td>{{$v->adTen}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
       <br/>
       <div class="row justify-content-around">
       <div id="chart">
           <div id="title__y">Số lượng</div>
           <div id="chart__xy">
                <div class="col__y">
                    <div id="div_quy_lap1" class="y__lap">{{$quy_lap1}}</div>
                    <div id="div_quy_pc1" class="y__pc">{{$quy_pc1}}</div>
                </div>
                <div class="col__y">
                    <div id="div_quy_lap2" class="y__lap">{{$quy_lap2}}</div>
                    <div id="div_quy_pc2" class="y__pc">{{$quy_pc2}}</div>
                </div>
                <div class="col__y">
                   <div id="div_quy_lap3" class="y__lap">{{$quy_lap3}}</div>
                    <div id="div_quy_pc3" class="y__pc">{{$quy_pc3}}</div>
                </div>
                <div class="col__y">
                    <div id="div_quy_lap4" class="y__lap">{{$quy_lap4}}</div>
                    <div id="div_quy_pc4" class="y__pc">{{$quy_pc4}}</div>
                </div>
           </div>
           <div id="title__x">
            <div class="x__name">Quý 1</div>
            <div class="x__name">Quý 2</div>
            <div class="x__name">Quý 3</div>
            <div class="x__name">Quý 4</div>
            </div>
            <div id="note__chart">
                <div class="note__chart--content">
                    <span>Ghi chú:</span>
                    <div class="content">
                        <div id="lap"></div>
                        <div>Sản phẩm LAPTOP</div>
                    </div>
                    <div class="content">
                         <div id="pc"></div>
                         <div>Sản phẩm PC</div>
                 </div>
                </div>
            </div>
       </div>
       <!-------->
       <div class="chart__list--pro">
           <div class="title__chart--list">
            <form action="{{URL::to('searchQuy')}}" method="POST">
                 {{ csrf_field()}}
               <label>Sản phẩm đã bán:&emsp;</label>
               <select name="searchQuy" class="btn btn-outline-light">
                     <option value="1" {{$quy_default == 1?'selected':""}}>Quý 1</option>
                     <option value="2" {{$quy_default == 2?'selected':""}}>Quý 2</option>
                     <option value="3" {{$quy_default == 3?'selected':""}}>Quý 3</option>
                     <option value="4" {{$quy_default == 4?'selected':""}}>Quý 4</option>
               </select>
               &emsp;
               <button type="submit" class="btn btn-outline-light">Xem</button>
           </form>
           </div>
        <div class="list__scroll">
           @foreach($quy_spNow as $q)
            <div class="box__info--pro">
                <div class="info__pro--left text-left">
                    Sản phẩm:&emsp;<span>{{$q->spTen}}</span><br/>
                    {{number_format($q->cthdGia)}}VND
                </div>
                <div class="info__pro--right">
                     Đã bán:&emsp;{{$q->total}}<br/>
                     {{number_format($q->total_price)}}VND
                </div>
            </div>
           @endforeach
       </div>
       </div>
   </div>

       <br/><br/>
       <section id="content__2">
           <div class="row">
               <div id="item__left" class="content__2--item item__left">
                 &emsp;<label>Danh sách nhân viên</label>
                   {{-- <div class="title__content--2">
                    <a id="btnShow" onclick="showViewNV()">Xem tất cả</a>
                    <a id="btnClose" onclick="closeViewNV()">Thu gọn</a>
                   </div> --}}
                   <div class="item__scroll">
                    @foreach($nv as $v)
                      <div class="item__info">
                          <span>
                            <img src="{{{"public/images/nhanvien/".$v->adHinh}}}">
                           </span>
                           <span>
                           {{$v->adTen}}
                          </span>
                          <span>
                            @if($v->adQuyen ==1)
                                Chủ cửa hàng
                            @elseif($v->adQuyen ==2)
                                Quản lý
                            @elseif($v->adQuyen ==3)
                                Thu ngân
                            @elseif($v->adQuyen ==4)
                                Nhân viên
                            @endif
                           </span>
                      </div>
                       @endforeach
                   </div>
               </div>
               <div id="item__right" class="content__2--item item__right">
                &emsp;<label>Danh sách sản phẩm đang bán</label>
               {{--  <div class="title__content--2">
                   
                  <a id="btnShow2" onclick="showViewSP()">Xem tất cả</a>
                  <a id="btnClose2" onclick="closeViewSP()">Thu gọn</a>
               </div> --}}
                <div class="item__scroll">
                     @foreach($sp as $sp)
                       <div class="item__info">
                        <span>
                           <img src="{{{"public/images/products/".$sp->spHinh}}}">
                       </span>
                       <span>
                           {{$sp->spTen}}
                       </span>
                       <span>
                           {{number_format($sp->spGia)}}&nbsp;VND
                       </span>
                       <span>
                           Hiện còn:&nbsp;{{$sp->khoSoluong}}
                       </span>
                       </div>
                       @endforeach
                   </div>
               </div>
           </div>
       </section>
       <br/>
   </div>
        <input id="soluong_sp" class="ip_hid" type="text" value="100"/>
        <input id="quy_lap1" class="ip_hid" type="text" value="{{$quy_lap1}}" /><br/>
        <input id="quy_pc1" class="ip_hid" type="text" value="{{$quy_pc1}}" /><br/>
        <input id="quy_lap2" class="ip_hid" type="text" value="{{$quy_lap2}}" /><br/>
        <input id="quy_pc2" class="ip_hid" type="text" value="{{$quy_pc2}}" /><br/>
        <input id="quy_lap3" class="ip_hid" type="text" value="{{$quy_lap3}}" /><br/>
        <input id="quy_pc3" class="ip_hid" type="text" value="{{$quy_pc3}}" /><br/>
        <input id="quy_lap4" class="ip_hid" type="text" value="{{$quy_lap4}}" /><br/>
        <input id="quy_pc4" class="ip_hid" type="text" value="{{$quy_pc4}}" /><br/>

    </div>
  </div>
   <script src="{{URL::asset("public/style_admin/js/index.js")}}"></script>
@endsection