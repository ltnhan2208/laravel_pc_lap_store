@extends('Userpage.layout')
@section('title')
Xác nhận đơn hàng
@endsection
@section('content')


<section class="content__cart">
	<div class="container-fluid">
	<div class="row">
		@if($vt1Check != 0)
	@foreach($vt1 as $vt1)
<a href="{{url('chi-tiet-banner/'.$vt1->bnMa)}}"  class="quang__cao" style="width: 12.3%;background-image: url({{URL::asset('public/images/banners/'.$vt1->bnHinh)}});background-size: cover;"></a>
@endforeach
@endif
	<div class="col-lg-9">
			{{-- <a class="text-white btn btn-dark" href="{{URL::to('product')}}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Tiếp tục mua sắm</a> --}}
		<br/>
		<div class="row">
			<table class="cart__list--item">
				<tr class="table__title">
					<td colspan="5">ĐƠN HÀNG CỦA BẠN</td>
				</tr>
				<tbody>
					<tr class="thead">
						<td>Tên sản phẩm</td>
						<td>Hình</td>
						<td>Đơn giá</td>
						<td>Số lượng</td>
						<td>Thành tiền</td>
					</tr>
					@if(Cart::count() !=0)
					@foreach($cart as $k=> $i)
					<tr>
						<td><a href="{{URL::to('proinfo/'.$i->id)}}">{{$i->name}}</a></td>
						<td><a href="{{URL::to('proinfo/'.$i->id)}}"><img src="{{URL::asset('public/images/products/'.$i->options->spHinh)}}" alt=" " class="img-responsive" /></a></td>
						<td>{{number_format($i->price)}} VND</td>
						<td>{{$i->qty}}</td>
						<td>{{number_format($i->price * Cart::get($k)->qty)}} VND</td>
					</tr>
					@endforeach
				@else
				<tr>
					<td colspan="5"><strong><i class="fas fa-info-circle alert-info"></i> Đơn hàng trống</strong></td>
				</tr>
				@endif
				
						<form action="{{URL::to('gocheckout/'.$total)}}" method="post">
						{{ csrf_field()}}
				@if($promoInfo)
					<tfoot>
					<tr>
					<td colspan="5">
						<br/>
						<div class="row justify-content-around">
							<div class="col-lg-5">
								<h5>Sản phẩm khuyến mãi:&nbsp;<span style="color: #2684ED;">{{$proinfo->spTen}}</span></h5>
								<input type="text" hidden name="spMa" value="{{$proinfo->spMa}}">
								<input type="text"  hidden  name="kmMa" value="{{$promoInfo->kmMa}}">
							</div>
							<div class="col-lg-5">
								
							<span>Khuyến mãi:&nbsp;{{$promoInfo->kmTrigia}}%  (Tối đa {{number_format($promoInfo->kmGiatritoida)}} VND)/ 1 sản phẩm</span>
						 <input readonly type="number" name="discount" value="{{$promoInfo->kmTrigia}}">
								</div>
						</div>
						<div class="row justify-content-around">
							<div class="col-lg-5">
								<h5>Số tiền được khuyến mãi:</h5>
							</div>
							<div class="col-lg-5">
								<span>{{number_format($pricePromo)}}&nbsp;VND</span>
								<input readonly type="number" name="price" value="{{$pricePromo}}">
							</div>
						</div>
						<hr/>
						<div class="row justify-content-around">
							<div class="col-lg-5">
								<h5>Tổng tiền:</h5>
							</div>
							<div class="col-lg-5">
								<span class="total__price">{{number_format($total)}}&nbsp;VND</span>
								<input readonly type="number" value="{{$total}}" name="total">  
							</div>
						</div>
					</td>
				</tr>
			</tfoot>
			@elseif(Session::has('vcMa'))
				<tfoot>
					<tr>
					<td colspan="5">
						<br/>
						<div class="row justify-content-around">
							@if($vcInfo->vcLoai==0)
							<div class="col-lg-5">
								<h5>Sản phẩm được giảm giá:&nbsp;{{$proinfo->spTen}}</h5>
								<input type="text" hidden name="spMa" value="{{$proinfo->spMa}}">
								<input type="text"  hidden  name="vcMa" value="{{$vcInfo->vcMa}}">
							</div>
							@else
							<div class="col-lg-5"></div>
							@endif
								@if($vcInfo->vcLoaigiamgia==0)
									@if($vcInfo->vcLoai==0)
									<div class="col-lg-5">
										<span style="color:#FF4242;font-weight: bold;">Giảm giá trực tiếp:&nbsp;
											{{number_format($vcInfo->vcMucgiam)}} VND (Tối đa {{number_format($vcInfo->vcGiatritoida)}}đ / 1 sản phẩm)</span>
									</div>
									@elseif($vcInfo->vcLoai==1)
									<div class="col-lg-5">
										<span style="color:#FF4242;font-weight: bold;">Giảm giá trực tiếp:&nbsp;
											{{number_format($vcInfo->vcMucgiam)}} VND (Tối đa {{number_format($vcInfo->vcGiatritoida)}}đ / Tổng giá trị đơn hàng)</span>
									</div>
									@endif
								<div class="col-lg-5">
								<h5>Số tiền được giảm:</h5>
								</div>
								<div class="col-lg-5">
									<span>{{number_format($priceVc)}}&nbsp;VND</span>
									<input readonly type="number" name="price" value="{{$priceVc}}">
								</div>
									<input readonly type="number" name="discount" value="{{$priceVc}}">
								@elseif($vcInfo->vcLoaigiamgia==1)
									@if($vcInfo->vcLoai==0)
										<div class="col-lg-5">
											<span style="color:#FF4242;font-weight: bold;">Giảm giá:&nbsp;
												{{$vcInfo->vcMucgiam}} % (Tối đa {{number_format($vcInfo->vcGiatritoida)}}đ / 1 sản phẩm)</span>
												<input readonly type="number" name="discount" value="{{$priceVc}}">
										</div>
										<div class="col-lg-5">
											<h5>Số tiền được giảm:</h5>
										</div>
										<div class="col-lg-5">
											<span>{{number_format($priceVc)}}&nbsp;VND</span>
											<input readonly type="number" name="price" value="{{$priceVc}}">
										</div>
									@elseif($vcInfo->vcLoai==1)
										<div class="col-lg-5">
										<span style="color:#FF4242;font-weight: bold;">Giảm giá:&nbsp;
											{{$vcInfo->vcMucgiam}} % (Tối đa {{number_format($vcInfo->vcGiatritoida)}}đ / Tổng giá trị đơn hàng)</span>
											<input readonly type="number" name="discount" value="{{$priceVc}}">
										</div>
										<div class="col-lg-5">
											<h5>Số tiền được giảm:</h5>
										</div>
										<div class="col-lg-5">
											<span>{{number_format($priceVc)}}&nbsp;VND</span>
											<input readonly type="number" name="price" value="{{$priceVc}}">
										</div>
									@endif
								@endif
						</div>
						<hr>
						<div class="row justify-content-around">
							<div class="col-lg-5">
								<h5>Tổng tiền:</h5>
							</div>
							<div class="col-lg-5">
								<span style="color: red;font-weight: bold; font-size: 20px;">{{number_format($total)}}&nbsp;VND</span>
								<input readonly type="number" value="{{$total}}" name="total">  
							</div>
						</div>
					</td>
				</tr>
			</tfoot>
			@else
				<tfoot>
						<tr style="text-align: right;">
								<td colspan="4" style="padding-right: 4px;"><span><strong>TỔNG TIỀN:</strong></span></td>
								<td colspan="1" style="padding-right: 4px;">
										<span style="color: red;font-weight: bold; font-size: 20px;">{{number_format($total)}} VND</span>
											<input type="number" style="display:none" readonly value="{{$total}}" name="total">  
								</td>
						</tr>
					</tfoot>
				@endif
					
				</tbody>
			</table>
		</div>
		<br/>
	
		<!------->
		<div class="row justify-content-between">
			<div class="col-lg-6 address__info">
				<table>
					<thead>
						<tr>
							<td colspan="2">THÔNG TIN GIAO HÀNG</td>
						</tr>
					</thead>
					<tbody>
						<tr class="thead">
							<td>Địa chỉ</td>
							<td>Số điện thoại người nhận</td>
						</tr>
						<tr>
							<td>{{Auth::guard('khachhang')->user()->khDiachi}}</td>
							<td>{{Auth::guard('khachhang')->user()->khSdt}}</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="text" name="note" placeholder="Ghi chú..." />
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="col-lg-6 address__info">
				<button id="show__boxAddress" type="button" class="show__boxAddress">Gửi đến địa chỉ khác</button>

				<div id="update__address">
				<table>
					<tbody>
						<tr class="thead">
							<td>Địa chỉ</td>
							<td>Số điện thoại người nhận</td>
						</tr>
								<tr>
							<td><input type="text" name="address" value="{{old('address')}}" placeholder="Nhập địa chỉ..." /></td>
							<td><input type="number" name="sdt" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" value="{{old('sdt')}}" placeholder="Nhập số điện thoại nhận..." /></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="text" name="note1" placeholder="Ghi chú..." />
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="container">
			<div class="col-lg-12 payment_method">
					<h3>Chọn phương thức thanh toán:</h3>
				<div class="checkout-button">
					    <input class="form-check-input" name="payment" checked="" type="radio" value="0" />
					     
					  <div class="content">
					  <div class="checkout-title">
					    Thanh toán khi nhận hàng
					  </div>
					    
					  </div>
				</div>
				@if($pm->pmStatus==0)
				<div class="checkout-button">
					<input class="form-check-input" name="payment" @if($total > 50000000) disabled="" @endif type="radio" value="1" />
					<img class="logo" src="https://developers.momo.vn/images/logo.png" width="25"/>
					<div class="content">
					  <div class="checkout-title">
					    Thanh toán bằng Ví MoMo
					  </div>
					  <div class="description">
					      Quý khách vui lòng cài đặt Ví MoMo trước khi thanh toán. <a href="https://momo.vn/huong-dan/huong-dan-tai-va-cai-dat-vi-momo">Hướng dẫn</a>
					      <p style="color: red;">@if($total > 50000000) Không thể dùng phương thức này vì đơn hàng của quý khách có giá trị cao hơn 50,000,000 VND vượt quá mức chuyển khoản cho phép của momo, vui lòng chọn phương thức khác. @endif </p>
					  </div>
					</div>
				</div>
				@endif

				{{-- <div class="checkout-button">
					<input class="form-check-input" name="payment" @if($total > 50000000) disabled="" @endif type="radio" value="2" />
					<div class="content">
					  <div class="checkout-title">
					    Chuyển khoản qua cổng thanh toán VNPAY:
					  </div>
					  <div class="description">
					  	Chọn ngân hàng cần thanh toán:
					   		<div id="search-select" class="ui fluid search selection dropdown">
                                        <input type="hidden" name="tennganhang">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Chọn ngân hàng</div>
                                        <div class="menu">
                                           
                                            <div class="item" data-value="NCB"> Ngan hang NCB</div>
                                            <div class="item" data-value="AGRIBANK"> Ngan hang Agribank</div>
                                            <div class="item" data-value="SCB"> Ngan hang SCB</div>
                                            <div class="item" data-value="SACOMBANK">Ngan hang SacomBank</div>
                                            <div class="item" data-value="EXIMBANK"> Ngan hang EximBank</div>
                                            <div class="item" data-value="MSBANK"> Ngan hang MSBANK</div>
                                            <div class="item" data-value="NAMABANK"> Ngan hang NamABank</div>
                                            <div class="item" data-value="VIETINBANK">Ngan hang Vietinbank</div>
                                            <div class="item" data-value="VIETCOMBANK"> Ngan hang VCB</div>
                                            <div class="item" data-value="HDBANK">Ngan hang HDBank</div>
                                            <div class="item" data-value="DONGABANK"> Ngan hang Dong A</div>
                                            <div class="item" data-value="TPBANK"> Ngân hàng TPBank</div>
                                            <div class="item" data-value="OJB"> Ngân hàng OceanBank</div>
                                            <div class="item" data-value="BIDV"> Ngân hàng BIDV</div>
                                            <div class="item" data-value="TECHCOMBANK"> Ngân hàng Techcombank</div>
                                            <div class="item" data-value="VPBANK"> Ngan hang VPBank</div>
                                            <div class="item" data-value="MBBANK"> Ngan hang MBBank</div>
                                            <div  class="item"data-value="ACB"> Ngan hang ACB</div>
                                            <div  class="item"data-value="OCB"> Ngan hang OCB</div>
                                            <div  class="item"data-value="IVB"> Ngan hang IVB</div>
                                            
                                        </div>
                         </div>
					  </div>
					</div>
				</div> --}}

				<div class="checkout-button alert-success border-primary">
					  <div class="content">
					  <div class="checkout-title">
					    Chuyển khoản:
					  </div>
					     <div class="description">
					      Quý khách vui lòng chuyển khoản qua một trong các tài khoản ngân hàng sau đây:
					      @foreach($bankInfo as $item)
								<dl><i style="color:green;" class="far fa-id-card"></i> <b style="font-size:20px;">Số tài khoản: {{$item->stk}}</b> 
									<dt><i  style="color:green;" class="fas fa-user-tie"></i>Tên chủ thẻ:{{$item->tenchuthe}} </dt>
									<dt><i  style="color:green;" class="fas fa-university"></i> Tên ngân hàng: {{$item->tennganhang}}</dt>
								</dl>
									<hr>
								@endforeach
								<p style="color:green;" class="alert-success">Lưu ý : phần ghi chú sẽ ghi: "tên - mã đơn hàng" ( mã đơn hàng sẽ được gửi qua email đăng ký sau khi xác nhận đơn hàng)</p>
					  	</div>
					  </div>
				</div>
			</div>
		</div>
			
		
			<div class="row justify-content-center" style="margin-top: 1rem;">
				<button type="submit" class="btn btn-success btn__buy col-lg-3">Xác nhận đơn hàng</button>
				</form>
			</div>
		</div>
		</div>

		{{-- Ad banner --}}
		@if($vt8Check != 0)
	@foreach($vt8 as $vt8)
<a href="{{url('chi-tiet-banner/'.$vt8->bnMa)}}"  class="quang__cao2" style="width: 12.3%;background-image: url({{URL::asset('public/images/banners/'.$vt8->bnHinh)}});background-size: cover"></a>
	@endforeach
	@endif
			{{--  --}}
	</div>

</div>
</div>
</section>

<script src="{{URL::asset("public/fe/js/js2.js")}}"></script>

<br/>
<script type="text/javascript">
	  $('#search-select')
  .dropdown()
;
</script>

@if(Session::has('errsdt'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('errsdt')}}',
})
</script> 
@endif

@if(Session::has('errorder'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('errorder')}}',
 
})
</script> 
@endif

@endsection