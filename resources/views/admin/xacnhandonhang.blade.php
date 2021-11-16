@extends('admin.layout')
@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <br/>
                <div class="col-lg-12">
                    <br/>
                    <h4 class="text-dark text-center">THÔNG TIN ĐƠN HÀNG</h4>
                
                <form class="row justify-content-around" action="{{URL::to('acceptOrder')}}" method="POST"  enctype="multipart/form-data">
                     {{ csrf_field() }}
                            <div class="col-lg-10">
                            @if(Session::has('dhbosung'))
                            <label  class="form-label">Đơn hàng bổ sung cho đơn hàng:&nbsp;<b style="color:green">{{Session::get('dhbosung')}}</b></label>
                            <br/>
                            @endif
                            <label  class="form-label">Mã khách hàng:&nbsp;{{$user['khMa']}}</label>
                            <br/>
                            <input id="khMa" type="text" hidden readonly="" class="form-control" name="khMa" value="{{$user['khMa']}}">
                            <input name="total" hidden value="{{$total}}">
                            <label>Tên khách hàng:&nbsp;{{$user['khTen']}} </label><br/>
                            <input id="khTen" type="text" hidden readonly="" class="form-control" name="khTen" value="{{$user['khTen']}}" >
                            <label>Địa chỉ giao hàng:&nbsp;{{$user['khDiachi']}}</label><br/>
                            <input id="khDiachi" type="text" hidden readonly="" class="form-control" name="khDiachi" value="{{$user['khDiachi']}}">
                            <label>Số điện thoại người nhận: &nbsp;{{$user['khSdt']}}</label><br/>
                            <input id="khSdt" type="text" hidden  readonly="" class="form-control" name="khSdt" value="{{$user['khSdt']}}">
                            </div>
                <br/>
                <div id="tableproduct" class="col-lg-11" >
                    
                    <input type="hidden" name="count" value="{{$count}}">
                            <table border="1" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Mã sản phẩm</th>
                                        <th>Hình</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      {{--  @foreach(SESSION::get('arrSpKm') as $km)
                    {{$km}}
                    @endforeach --}}
                                @foreach($Cart as $k => $v)
                                <tr>
                                    <td>{{$v->spMa}}</td>
                                    <input type="hidden" name="spMa[]" value="{{$v->spMa}}">
                                    <td>
                                    <img style="height:100px;width: 100px;" src="{{URL::asset('public/images/products/'.$v->spHinh)}}" alt="" class="pro-image-front">
                                    </td>
                                    <td>{{$v->spTen}}</td>
                                    <td>{{number_format($v->spGia)}} VND</td>
                                    <td>{{$v->soluong}}</td>
                                    <input type="hidden" name="{{$v->spMa}}" value="{{$v->soluong}}">
                                </tr>
                                @endforeach
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" style="text-align: right;font-weight: bold;border: 0;">Tổng số sản phẩm :</td>
                                        <td style="border:0">{{$count}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: right;font-weight: bold;border: 0;">Tổng tiền:</td>
                                        <td style="border:0">{{number_format($total)}} VND</td>
                                        
                                    </tr>
                                </tfoot>
                                </table>
                        <span style="color: red">{{$errors->first('checkboxsp')}}</span>
                   
                </div>
                </div>
                <br/>
                <div class="row justify-content-around">
                    
                    <button class="btn btn-dark" type="button" onclick="back()">Trở về</button>
                 
                  <button id="btn__register" class="btn btn-primary" type="submit" name="btn_khd" >Thực hiện</button>
                  </div>
            </form>
            <br/>
                    
        </div>
    </div>
    </div>
    <script src="{{url('public/style_admin/js/previewImgInputFile1.js')}}"></script>
     <script src="{{url('public/fe/js/js-validate/validate-register.js')}}"></script>


<script type="text/javascript">
@if(Session::has('error'))
    Swal.fire({
    icon: 'error',
    title: 'Thông báo: ',
    text: '{{Session::get('error')}}',
    });
@endif
</script>
@endsection