@extends('admin.layout')
@section('content')
<div class="content">
<form class="col-lg-12" action="{{URL::to('addDonhang')}}" method="POST"  enctype="multipart/form-data">
			 {{ csrf_field() }}
			 <div>	
@foreach($hdKhachhang as $kh)
	<label>Khách hàng:</label>&nbsp;<span><b>{{$kh->khTen}}</b></span><br/>
    <input type="text" readonly hidden name="khMa" value="{{$kh->khMa}}">
     <input type="text" readonly hidden name="khTen" value="{{$kh->khTen}}">
	<label>Địa chỉ:</label>&nbsp;<span><b>{{$kh->hdDiachi}}</b></span><br/>
    <input type="text" hidden readonly name="khDiachi" value="{{$kh->hdDiachi}}">
	<label>Số điện thoại khách hàng:</label>&nbsp;<span><b>{{$kh->hdSdtnguoinhan}}</b></span><br/>
     <input type="text" hidden readonly name="khSdt" value="{{$kh->hdSdtnguoinhan}}">
	<label>Đơn hàng cần được cập nhật:</label>&nbsp;<span><b>{{$kh->hdMa}}</b></span>
   <input id="dhbosung" checked type="checkbox" name="dhbosung" value="1" hidden>
   <input type="text" hidden name="dh" value="{{$kh->hdMa}}">
@endforeach
</div>

<div class="form-group">
					<div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                	<legend>Chọn sản phẩm</legend>
                                    <thead>
                                        <tr>
                                        	<th></th>
                                            <th>Mã sản phẩm</th>
                                            <th>Hình</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Loại sản phẩm</th>
                                            <th>Nhà cung cấp</th>
                                            <th>Thương hiệu</th>
                                            <th>Đơn giá</th>
                                    		<th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($arrSpOld as $v)
                                        <tr>
                                            <td>
                                            <input type="checkbox" checked
                                                @if($v->khoSoluong<1) disabled @endif
                                                 name="checkboxsp[]"  value="{{$v->spMa}}">
                                            </td>
                                            <td>{{$v->spMa}}</td>
                                            <td>
                                            <img style="height:55px;width: 55px;" src="{{URL::asset('public/images/products/'.$v->spHinh)}}" alt="" class="pro-image-front">
                                
                                            </td>
                                            <td>{{$v->spTen}}</td>
                                             <td>{{$v->loaiTen}}</td>
                                            <td>
                                            {{$v->nccTen}}
                                            </td>
                                            <td>{{$v->thTen}}</td>
                                            <td>{{number_format($v->spGia)}} VND</td>
                                            <td>
                                                @if($v->khoSoluong>1) <input type="number" style="text-align: center" name="spSl{{$v->spMa}}" max="{{$v->khoSoluong}}" class="form-control" > @endif
                                                Trong kho còn: {{$v->khoSoluong}} Sản phẩm.<br> 
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach($product as $v)
                                        <tr>
                                        	<td>
                                        	<input type="checkbox" 
												@if($v->khoSoluong<1) disabled @endif
												 name="checkboxsp[]"  value="{{$v->spMa}}">
											</td>
                                          	<td>{{$v->spMa}}</td>
                                          	<td>
											<img style="height:55px;width: 55px;" src="{{URL::asset('public/images/products/'.$v->spHinh)}}" alt="" class="pro-image-front">
								
                                            </td>
                                            <td>{{$v->spTen}}</td>
                                             <td>{{$v->loaiTen}}</td>
                                          	<td>
                                          	{{$v->nccTen}}
                                          	</td>
                                          	<td>{{$v->thTen}}</td>
                                          	<td>{{number_format($v->spGia)}} VND</td>
                                          	<td>
                                          		@if($v->khoSoluong>1) <input type="number" style="text-align: center" name="spSl{{$v->spMa}}" max="{{$v->khoSoluong}}" class="form-control" > @endif
                                          		Trong kho còn: {{$v->khoSoluong}} Sản phẩm.<br>	
                                          	</td>
                                        </tr>
                                    @endforeach
                                   
                                    </tbody>
                                </table>
                                <span style="color: red">{{$errors->first('checkboxsp')}}</span>
                            </div>
                            <br/>
                            <div class="row justify-content-around">
					<button class="btn btn-dark" type="button" onclick="back()">Trở về</button>
				 
				  <button id="btn__register" class="btn btn-primary" type="submit" name="btn_khd" >Thực hiện</button>
					</div>
				</div> 
				</div> 
@endsection