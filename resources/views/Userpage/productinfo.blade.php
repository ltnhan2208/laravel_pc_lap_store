@extends('Userpage.layout')
@section('title')
Thông tin sản phẩm
@endsection
@section('content')
<br/>
<section class="product__info">
	<div class="container-fluid">
		<div class="row">
	
		@if($vt1Check != 0)
	@foreach($vt1 as $vt1)
<a href="{{url('chi-tiet-banner/'.$vt1->bnMa)}}"  class="quang__cao" style="width: 12.3%;background-image: url({{URL::asset('public/images/banners/'.$vt1->bnHinh)}});background-size: cover;"></a>
@endforeach
@endif
		<div class="col-lg-9">
			<h3>THÔNG TIN SẢN PHẨM</h3>
			<hr/>
			<!------------Thông tin khái quát------------->
			<div class="row product__top">
				<div class="col-lg-6 info__left">
					<div class="row img justify-content-between">
						<div id="img__default">
						<img src="{{URL::asset('public/images/products/'.$imgDefault->spHinh)}}" />
						</div>
					</div>
	
					<br/>
					<div class="row multi__img justify-content-around">
						@foreach($imgs as $key => $v)
						<div class="col-lg-2 img__item">
							<img src="{{URL::asset('public/images/products/'.$v->spHinh)}}" />
						</div>
						@endforeach
					</div>
				</div>
				<div class="col-lg-6 col-sm-12 info__right">
					<form action="{{URL::to('save-cart2/'.$proinfo->spMa)}}" method="post" accept-charset="utf-8">
				{{ csrf_field() }}
					<span class="proName">{{$proinfo->spTen}}</span><br/>
					<span class="proNSX">Thương hiệu:&nbsp; {{$proinfo->thTen}}</span><br/>

					<span class="proHbh">Hạn bảo hành:&nbsp;
						@if($proinfo->spHanbh == 0)
						6 tháng
						@elseif($proinfo->spHanbh == 0)
						12 tháng
						@else
						24 tháng
						@endif
					</span><br/>
					<span>Tình trạng: mới 100%</span><br/>
					<span>Số lượng: {{$proinfo->khoSoluong>0?$proinfo->khoSoluong:"Hết hàng"}}</span><br/>
					@if($availPromo)
					<span class=""><s>{{number_format($proinfo->spGia)}}&nbsp;VND</s></span><br/>	
					<span class="proPrice">
						@if($proinfo->spGia*$availPromo->kmTrigia/100 > $availPromo->kmGiatritoida)
						{{number_format($proinfo->spGia- $availPromo->kmGiatritoida)}}&nbsp;VND
						@else
						{{number_format($proinfo->spGia-($proinfo->spGia*$availPromo->kmTrigia/100))}}&nbsp;VND
						@endif
					</span>
						<br/>

					@else
					<span class="proPrice">{{number_format($proinfo->spGia)}}&nbsp;VND</span><br/>
					@endif

					@if($proinfo->khoSoluong>0)
					<p>Chọn số lượng: 
						<span>
							<div class="counter">
							  <button type="button" onClick='decreaseCount(event, this)'>
							  	-
							  </button>
							  <input style="width:50px;text-align: center;" class="form-control-success" min="1" max="{{$proinfo->khoSoluong}}" type="number" id="qty" name="quanty" value="1">
							  <button type="button"  onClick='increaseCount(event, this)'>+</button>
							</div>
						</span>
					</p>
					@endif
					@if($availPromo)
					<span class="proKm">Chương trình khuyến mãi khả dụng:</span><br/>
					<div class="proKm__content">
							<div class="row">
								<div class="col-12">
									<span class="promoName"><i>{{$availPromo->kmTen}}</i></span>
									<ul class="promoDescription">
										<li>{{$availPromo->kmMota}}</li>
										<li>Bắt đầu từ ngày <strong>{{date_format(date_create($availPromo->kmNgaybd),"d/m/Y H:i:s")}}</strong> Đến ngày <strong>{{date_format(date_create($availPromo->kmNgaykt),"d/m/Y H:i:s")}}</strong></li>
									</ul>
								</div>
							</div>
					</div>
					@endif
					<br>
					@if($proinfo->khoSoluong>0)
					<div class="occasion-cart">
						<button type="submit" class="btn__addCartInfo"><i class="far fa-cart-arrow-down" style="font-size: 18px;"></i>&nbsp;Thêm vào giỏ hàng </button>&emsp;
					@if(Auth::guard('khachhang')->check())
							@if($wishlist!=null)
								<button type="button" title="Xóa khỏi danh mục yêu thích" id="btnheart" class="btn__heartInfo__checked"value="{{$wishlist->spMa}}"><i class="far fa-heart" ></i></button>
							@else
							<button type="button"  title="Thêm vào danh mục yêu thích" id="btnheart" class="btn__heartInfo" value="{{$proinfo->spMa}}"><i class="far fa-heart" ></i></button>	
											@endif
					@endif

					</div>
					@endif
					</form>
				</div>
			</div>
			<!------------End------------->
			<br/><br/>
			<!------------Mô tả/ Bình luận------------->
			<div class="row product__bot">
				<div id="show__mota" class="col-lg-2 text-center" onclick="showMota()">
					Mô tả
				</div>
				<div id="show__danhgia" class="col-lg-2 text-center" onclick="showDanhgia()">
					Bình luận
				</div>
				<div id="content__mota" class="col-lg-12">
					<br/>
					<h4>Thông số kỹ thuật:</h4>
					<table>
						@foreach($details as  $i)
						@if($i->ram!=null)
						<tr>
							<td class="mota__left">RAM</td>
							<td class="mota__right">{{$i->ram}}</td>
						</tr>
						@endif
						@if($i->cpu!=null)
						<tr>
							<td class="mota__left">CPU</td>
							<td class="mota__right">{{$i->cpu}}</td>
						</tr>
					
						@endif
						@if($i->ocung!=null)
						<tr>
							<td class="mota__left">Ổ cứng</td>
							<td class="mota__right">{{$i->ocung}}</td>
						</tr>
						@endif
						@if($i->psu!=null)
							<tr>
							<td class="mota__left">PSU</td>
							<td class="mota__right">{{$i->psu}}</td>
						</tr>
						@endif
						@if($i->vga!=null)
							<tr>
							<td class="mota__left">VGA</td>
							<td class="mota__right">{{$i->vga}}</td>
						</tr>
						@endif
						@if($i->mainboard!=null)
						<tr>
							<td class="mota__left">Mainboard</td>
							<td class="mota__right">{{$i->mainboard}}</td>
						</tr>
						@endif
						@if($i->manhinh!=null)
							<tr>
							<td class="mota__left">Màn hình</td>
							<td class="mota__right">{{$i->manhinh}}</td>
						</tr>
						@endif
						@if($i->chuot!=null)
						<tr>
							<td class="mota__left">Chuột</td>
							<td class="mota__right">{{$i->chuot}}</td>
						</tr>
						@endif
						@if($i->banphim!=null)
						<tr>
							<td class="mota__left">Bàn phím</td>
							<td class="mota__right">{{$i->banphim}}</td>
						</tr>
						@endif
						@if($i->vocase!=null)
						<tr>
							<td class="mota__left">Case</td>
							<td class="mota__right">{{$i->vocase}}</td>
						</tr>
						@endif
						@if($i->pin!=null)
						<tr>
							<td class="mota__left">Pin</td>
							<td class="mota__right">{{$i->pin}}</td>
						</tr>
						@endif
						@if($i->tannhiet!=null)
						<tr>
							<td class="mota__left">Tản nhiệt</td>
							<td class="mota__right">{{$i->tannhiet}}</td>
						</tr>
						@endif
						@if($i->loa!=null)
						<tr>
							<td class="mota__left">Loa</td>
							<td class="mota__right">{{$i->loa}}</td>
						</tr>
						@endif

						@if($i->mau!=null)
						<tr>
							<td class="mota__left">Màu</td>
							<td class="mota__right">{{$i->mau}}</td>
						</tr>
						@endif
						@if($i->trongluong!=null)
						<tr>
							<td class="mota__left">Trọng lượng</td>
							<td class="mota__right">{{$i->trongluong}}</td>
						</tr>	 
						@endif
						@if($i->conggiaotiep!=null)
						<tr>
							<td class="mota__left">Cổng giao tiếp</td>
							<td class="mota__right">{{$i->conggiaotiep}}</td>
						</tr>
						@endif
						@if($i->webcam!=null)
						<tr>
							<td class="mota__left">Webcam</td>
							<td class="mota__right">{{$i->webcam}}</td>
						</tr>
						@endif
						@if($i->chuanlan!=null)
						<tr>
							<td class="mota__left">Chuẩn LAN</td>
							<td class="mota__right">{{$i->chuanlan}}</td>
						</tr>
						@endif
						@if($i->chuanwifi!=null)
						<tr>
							<td class="mota__left">Chuẩn WIFI</td>
							<td class="mota__right">{{$i->chuanwifi}}</td>
						</tr>
						@endif
						@if($i->hedieuhanh!=null)
						<tr>
							<td class="mota__left">Hệ điều hành</td>
							<td class="mota__right">{{$i->hedieuhanh}}</td>
						</tr>
						@endif
				</table>
					@endforeach
				</div>
				<!------------------------->
				<div id="content__danhgia" class="col-lg-12">
					@if(count($comment)>0)
			   			@foreach($comment as $i)
			   				@if($i->khTaikhoan == Auth::guard('khachhang')->user()->khTaikhoan)
					   				<div class="cmt__title col-lg-12">
					   					@if(Auth::guard('khachhang')->user()->khHinh!=null)
					   					<img class="cmt__avt" src="{{URL::asset('public/images/khachhang/'.Auth::guard('khachhang')->user()->khHinh)}}" />
					   					@else
					   					<i class="fas fa-user-circle" style="font-size: 45px;color: lightgrey;position: relative;top:5px"></i> 
					   					@endif
					   					<span class="cmt__name">{{$i->khTen}}</span> &emsp;
					   					<span class="cmt__date">{{$i->dgNgay}}</span>
					   					<a class="btn btn-outline-danger btn__del" href="{{URL::to('deletecomment/'.$i->dgMa)}}">Gỡ</a>
					   					<br/>
					   					<div class="cmt__content">{{$i->dgNoidung}}</div>
					   			</div>
					   			<br/><br/>
					   			@endif
					   			<div class="cmt__title col-lg-12">
					   				@if($i->khHinh!=null)
					   					<img class="cmt__avt" src="{{URL::asset('public/images/khachhang/'.$i->khHinh)}}" />
					   					@else
					   					<i class="fas fa-user-circle" style="font-size: 45px;color: lightgrey;position: relative;top:5px"></i> 
					   				@endif
					   					<span class="cmt__name">{{$i->khTen}}</span> &emsp;
					   					<span class="cmt__date">{{$i->dgNgay}}</span><br/>
					   					<div class="cmt__content">{{$i->dgNoidung}}</div>
					   			</div><br/><br/>
			   			@endforeach
			   			@else
			   			<div class="row justify-content-around"><br/>Chưa có bình nào về sản phẩm này.</div>
			   			@endif
			   			<br/>
			   				@if($checkordered!=null)
			   				<br/><br/>
			   				<div class="col-lg-1 send_cmt--avt">
			   					@if(Auth::guard('khachhang')->user()->khHinh!=null)
					   					<img src="{{URL::asset('public/images/khachhang/'.Auth::guard('khachhang')->user()->khHinh)}}" />

					   					@else
					   					<i class="fas fa-user-circle" style="font-size: 45px;color: lightgrey;position: relative;top:5px"></i> 
					   					@endif
			   				</div>
			   			<form class="col-lg-10" action="{{URL::to('addcomment/'.$i->spMa)}}" method="post" accept-charset="utf-8">
			   				{{ csrf_field() }}
			   				<div class="form-floating">
							  <input type="textarea" maxlength="200" style="height: 100px;" class="form-control" id="comment" name="content" >
							  <label for="comment">Bình luận của bạn</label>
							  @foreach($errors->all() as $i)
			   				<p class="alert-danger">{{$i}}</p>
			   				@endforeach
			   				<div class="row justify-content-end" style="padding-right: 0.8rem;padding-top: 5px;">
							  <button type="submit" class="btn btn-outline-success" name="btnSubmit" style="width:10%">Đăng</button>
							  <br/>
								</div>
							</div>
							<br/>
			   			</form>
			   			
			   			@else
			   			 <div class="row justify-content-center" style="padding-top: 30px;">
			   			 <div class="col-lg-5" style="text-align: center;font-weight: bold;background: lightgrey;border:1px solid black;padding: 5px 3px 5px 3px;">Bạn cần mua hàng để được bình luận sản phẩm này</div>
			   			</div>
			   			@endif
					<br/><br/>
				</div>
			</div>
			<!------------End------------->
		</div>
@if($vt8Check != 0)
	@foreach($vt8 as $vt8)
<a href="{{url('chi-tiet-banner/'.$vt8->bnMa)}}"  class="quang__cao2" style="width: 12.3%;background-image: url({{URL::asset('public/images/banners/'.$vt8->bnHinh)}});background-size: cover"></a>
	@endforeach
	@endif
		</div>
	</div>
	<br/><br/>
   				<div class="container-fluid"><h3>SĂN CÙNG THƯƠNG HIỆU</h3>
   				
   				<div id="left__arr"  class="col-lg-1 product__arrow">
   					<i class="fas fa-chevron-left" style="font-size: 48px;"></i>
   				</div>
   				<div class="col-lg-10">
   					<div class="row list__product">
   						@foreach($db as $v)
   						
   					<div class="product">
					<form>
					<div class="item_info">
									<a href="{{URL::to('proinfo/'.$v->spMa)}}">Xem sản phẩm</a>
					</div>
					<input class="name" name="spMa" type="hidden" value="{{$v->spTen}}">
								<img src="{{URL::asset('public/images/products/'.$v->spHinh)}}" alt="">			
								<div class="item-info-product">
									<label class="item_name"><a href="{{URL::to('proinfo/'.$v->spMa)}}">{{$v->spTen}}</a></label>
									<br/>
									
									@if($i->kmMa!=null && date_create($v->kmNgaybd) <= $today && date_create($v->kmNgaykt) >= $today && $i->kmTinhtrang == 1)
										<span><s>{{number_format($v->spGia)}} ₫</s></span><br>
										<span class="item_price"><i class="fas fa-tags"></i> {{number_format($v->spGia-($v->spGia*$v->kmTrigia/100))}} ₫</span>
									@else
									<br/>
										<span class="item_price">{{number_format($v->spGia)}} ₫</span>
									@endif
									
									<button type="button" class="btn__addCart" value="{{$v->spMa}}">
									<i class="far fa-cart-arrow-down" style="font-size: 18px;"></i>&nbsp;Thêm vào giỏ hàng</button>		
						</div>
					</form>
					</div>
   						
   						@endforeach
   					</div>
   				</div>
   				<div id="right__arr" class="col-lg-1 product__arrow">
   					<i class="fas fa-chevron-right" style="font-size: 48px;"></i>
   				</div>
   			</div>
</section>

<br/>

<script src="{{URL::asset("public/fe/js/productInfo.js")}}"></script>


<script type="text/javascript">
	$(document).on('click','#btnheart',function(e){
			e.preventDefault();
			
			var id = $(this).val();
			$.ajax({
				TYPE:"GET",
				url:'../addtowishlist/'+id,
				dataType:'JSON',
				data:{id,},
				success:function(response)
				{
					result = response.message;
					if(result== 0)
					{
						Swal.fire({
					  icon: 'success',
					  title: 'Thông báo: ',
					  text: 'Đã thêm vào danh mục yêu thích',
					  footer: '<a href="{{URL::to('wishlist')}}" class="btn btn-outline-warning">Tới danh mục</a></span>'
					});
					}
					else
					{
						Swal.fire({
					  icon: 'error',
					  title: 'Thông báo: ',
					  text: 'Đã xóa khỏi danh mục yêu thích',
					  footer: '<a href="{{URL::to('wishlist')}}" class="btn btn-outline-warning">Tới danh mục</a></span>'
						});
					}
				}
			});
		})
</script>


@if(Session::has('comment'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thông báo: ',
  text: '{{Session::get('comment')}}',
 
})
</script> 
@endif

@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif
<script>
  function increaseCount(a, b) {
  var input = document.getElementById('qty');
  var value = parseInt(input.value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  input.value = value;
}

function decreaseCount(a, b) {
  var input = document.getElementById('qty');
  var value = parseInt(input.value, 10);
  if (value > 1) {
    value = isNaN(value) ? 0 : value;
    value--;
    input.value = value;
  }
}
</script>
@endsection
