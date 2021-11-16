@extends('Userpage.layout')
@section('title')
Giỏ hàng
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
					<td colspan="6">GIỎ HÀNG</td>
				</tr>
				<tbody>
					<tr class="thead">
						<td>Tên sản phẩm</td>
						<td>Hình</td>
						<td>Đơn giá</td>
						<td>Số lượng</td>
						<td>Thành tiền</td>
						<td></td>
					</tr>
					@if(Cart::count() !=0)
					@foreach($cart as $k=> $i)
					<tr id="cart{{$k}}">
						<td><a href="{{URL::to('proinfo/'.$i->id)}}">{{$i->name}}</a></td>
						<td><a href="{{URL::to('proinfo/'.$i->id)}}"><img src="{{URL::asset('public/images/products/'.$i->options->spHinh)}}" alt=" " class="img-responsive" /></a></td>
						<td><input hidden id="price{{$k}}" value="{{$i->price}}" />{{number_format($i->price)}}₫</td>
						<td><div class="counter">
				
						  <button class="btn btn-outline-danger sub__quanty" value="{{$k}}">-</button>
						  <input type="number" style="width:50px;border: 0;text-align: center;" readonly min="1" max="{{$i->qty}}" type="number" hidden name="quanty" value="{{$i->qty}}">
						  &nbsp;<span id="quanty{{$k}}">{{$i->qty}}</span>&nbsp;
			
					<button class="btn btn-outline-success plus__quanty" value="{{$k}}">+</button>
						</div></td>
						<td><span id="total_price{{$k}}">{{number_format($i->price * Cart::get($k)->qty)}} ₫</span> </td>
						
						<td class="invert"><a class="btn btn-outline-danger"
						onclick="func{{$k}}()">Xóa</a></td>
					</tr>
					@endforeach
				@else
				<tr>
					<td colspan="6"><strong><i class="fas fa-info-circle alert-info"></i> Giỏ hàng trống</strong></td>
				</tr>
				@endif
				</tbody>
				<tfoot>
					<tr>
					<td colspan="6" class="text-center">
								<a style="color:red;" href="{{URL::to('destroy-cart')}}"><i class="fas fa-trash" style="color: red;"></i> Xóa toàn bộ sản phẩm trong giỏ hàng</a>
							</td>
				</tr>
				</tfoot>
			</table>
		</div>
		<br/>
		<!------->
		<div class="row justify-content-between cart__bot">
			<div>
			<h4>Chọn 1 ưu đãi</h4>
				<input id="vc" onclick="funcVc()" type="radio" class="form-check-input" name="vc_promo" checked=""> Nhập voucher giảm giá &nbsp;&nbsp;&nbsp;
				<input id="pr" onclick="funcPr()" type="radio" class="form-check-input" name="vc_promo"> Chọn chương trình khuyến mãi
			</div>

			<div id="voucher" style="display: none;" class="col-lg-6">
				<form action="{{URL::to('checkvoucher')}}" method="post" accept-charset="utf-8">
					{{csrf_field()}}
				<label>Nhập voucher giảm giá:</label><input type="text" class="form-control" name="vcMa" title="Mã phải là chữ hoặc số không chứa ký tự đặc biệt. Độ dài từ 4-12 ký tự." pattern="[A-Za-z\d]{4,12}" placeholder="Nhập mã voucher vào đây"
				@if(Session::has('vcMa'))
				value="{{Session::get('vcMa')}}" 
				@endif
				>
				<input type="text" style="display: none;" name="total" value="{{$total}}">
				<button type="submit" class="btn btn-outline-info"><i class="fas fa-info-circle"></i> Kiểm tra</button>
				@if(Session::has('vcMa'))
				<span class="alert-success">Đã áp dụng voucher!</span>
				<a class="btn btn-primary" href="{{URL::to('clearVoucher')}}">Gỡ áp dụng voucher</a>
				@endif
				</form>
			</div>

			<div id="promotion" style="display: none;" class="col-lg-6">
				<div class="cart__bot--right">
					<table>
							<tr><td class="promoTitle">KHUYẾN MÃI CÓ THỂ ÁP DỤNG( CHỌN 1 )</td></tr>
					</table>
					<div class="right__content">
						<form action="{{URL::to('order')}}" method="get">
							<input type="radio" id="noPromo" checked name="promo" class=" form-check-input"  value="0">&nbsp;Không chọn
							
								@foreach($use as $v)
									<hr>
											<input type="radio" name="promo" class=" form-check-input" value="{{$v->kmMa}},{{$v->spMa}}">&nbsp;<span class="promotitleItem">{{$v->kmTen}}</span>
												<p>{{$v->kmMota}}</p>
												<span>	Giảm: {{$v->kmTrigia}}% cho sản phẩm: <span style="color:green;font-weight: bold;">{{$v->spTen}}</span>;  @if($v->kmGiatritoida != null) Tối đa: {{number_format($v->kmGiatritoida)}} ₫</span><br> @endif
								@endforeach
								@foreach($unuse as $v)
									<HR>
											<input type="radio" disabled="" name="promo" class=" form-check-input" value="{{$v->kmMa}},{{$v->spMa}}">&nbsp;<span class="promotitleItem">{{$v->kmTen}}</span>(Bạn đã dùng tối đa số lần khuyến mãi)
												<p>{{$v->kmMota}}</p>
												<span>	Giảm: {{$v->kmTrigia}}% cho sản phẩm: {{$v->spTen}}; @if($v->kmGiatritoida != null) Tối đa: {{number_format($v->kmGiatritoida)}} ₫</span><br> @endif
								@endforeach

					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="cart__bot--left">
					<table>
							<tr><td>ĐƠN HÀNG TẠM TÍNH</td></tr>
					</table>
					<div class="left__content">
							@foreach($cart as $k=> $i)	
							<div class="content__pro">
								<span class="pro__name">
									<i class="fas fa-check" style="font-size: 16px;color: lightgreen;position: relative;left:15px"></i>
									<i class="fas fa-check" style="font-size: 16px;color: lightgreen"></i>&nbsp;{{$i->name}}</span>
								<span  class="pro__price"><i class="fas fa-dollar-sign" style="font-size: 16px;color: lightgreen;border: 2px solid lightgreen;padding: 3px 3px 3px 3px"></i>
									&nbsp;<span id="total{{$k}}">{{number_format($i->price * Cart::get($k)->qty)}} ₫</span> </span>
							</div>
								
							@endforeach
							<hr>
							<div class="content__total">
								<span class="total__title">Tổng tiền:</span>
								<span hidden id="input__totalprice">{{$total}}</span>
								<span class="total__price">
									<span id="total__price">{{number_format($total)}} ₫</span>
								</span>
							</div>
					</div>
				</div>
			</div>
				
			<div class="row justify-content-center" style="margin-top: 1rem;">
				<button type="submit" class="btn btn-success btn__buy col-lg-3" href="">Tiến hành đặt hàng</button>
				</form>
			</div>
		</div>
	</div>
		@if($vt8Check != 0)
	@foreach($vt8 as $vt8)
<a href="{{url('chi-tiet-banner/'.$vt8->bnMa)}}"  class="quang__cao2" style="width: 12.3%;background-image: url({{URL::asset('public/images/banners/'.$vt8->bnHinh)}});background-size: cover"></a>
	@endforeach
	@endif
</div>
</div>
</section>



<br>
<script type="text/javascript">
	var promo=document.getElementById("pr");
	if(promo.checked ==true)
	{
		document.getElementById("promotion").style.display = 'block';
	}

	var vc=document.getElementById("vc");
	if(vc.checked ==true)
	{
		document.getElementById("voucher").style.display = 'block';
	}

	function funcVc()
	{
		var vc=document.getElementById("vc");
		if(vc.checked ==true)
		{
			document.getElementById("voucher").style.display = 'block';
			document.getElementById("promotion").style.display = 'none';
			document.getElementById("noPromo").checked="true";
		}
	}

	function funcPr()
	{
		var promo=document.getElementById("pr");
		if(promo.checked ==true)
		{
			document.getElementById("promotion").style.display = 'block';
			document.getElementById("voucher").style.display = 'none';
		}
	}
</script>


@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif

@if(Session::has('success'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thông báo: ',
  text: '{{Session::get('success')}}',
 
})
</script> 
@endif
<script>
@foreach($cart as $k=> $i)
function func{{$k}}()
{
	Swal.fire(
	{
	  title: 'Bạn có muốn xóa',
	  text: "{{$i->name}} khỏi giỏ hàng ?",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#EC2546',
	  cancelButtonColor: '#B5B5B5',
	  confirmButtonText: 'OK'
	}).then((result) => {
  if (result.isConfirmed) 
  {
    Swal.fire(
      'Deleted!',
      'Đã xóa sản phẩm khỏi giỏ hàng !',
      'success'
    )
    document.location.href="{{URL::to('remove-item/'.$k)}}";
  }
})
}
@endforeach
</script>
<script>


	$(document).on('click','.plus__quanty',function(e){
		e.preventDefault();
		var id = $(this).val();
		$.ajax({
			type:"GET",
			url:'changeQuanty/increase/'+id,
			dataType:"JSON",
			success:function(response)
			{
				var input_quanty = document.getElementById('quanty'+id).innerHTML; 
				var val = Number(input_quanty);
				var plus = val + 1;
				var price = document.getElementById('price'+id).value;
				var p = Number(price);
				var total_price = document.getElementById('total_price'+id);
				var rs = p * plus;
				var totalP = document.getElementById('total'+id);
				var ip_totalprice = document.getElementById('input__totalprice').innerHTML;
				var total_Allprice = document.getElementById('total__price');
				var tol = Number(ip_totalprice);

				var cart = document.getElementById("cart").innerHTML;
					var x = Number(cart);
					

				rs2 = tol + p;
				result = response.message;
				if(result == 0)
				{
					document.getElementById('quanty'+id).innerHTML = plus;
					total_price.innerHTML = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(rs);
					totalP.innerHTML = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(rs);
					document.getElementById('input__totalprice').innerHTML=rs2;
					document.getElementById('total__price').innerHTML=Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(rs2);
					document.getElementById("cart").innerHTML = x+1;
				}
				if(result == 1)
				{
					Swal.fire({
				  icon: 'error',
				  title: 'Thông báo: ',
				  text: 'Số lượng sản phẩm: '+response.name+' còn: '+response.quanty,
					});
				}
			}
		});
	});
	// Trừ //
	$(document).on('click','.sub__quanty',function(e){
		e.preventDefault();
		var id = $(this).val();
		$.ajax({
			type:"GET",
			url:'changeQuanty/decrease/'+id,
			dataType:"JSON",
			success:function(response)
			{
				var input_quanty = document.getElementById('quanty'+id).innerHTML; 
				var val = Number(input_quanty);
				var sub = val - 1;
				var price = document.getElementById('price'+id).value;
				var p = Number(price);
				var total_price = document.getElementById('total_price'+id);
				var rs = p * sub;
				var totalP = document.getElementById('total'+id);
				var ip_totalprice = document.getElementById('input__totalprice').innerHTML;
				var total_Allprice = document.getElementById('total__price');
				var tol = Number(ip_totalprice);

				var cart = document.getElementById("cart").innerHTML;
				var x = Number(cart);

				rs2 = tol - p;
				result = response.message;
				if(result == 0)
				{
					document.getElementById('quanty'+id).innerHTML = sub;
					total_price.innerHTML = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(rs);
					totalP.innerHTML = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(rs);
					document.getElementById('input__totalprice').innerHTML=rs2;
					document.getElementById('total__price').innerHTML=Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(rs2);
				document.getElementById("cart").innerHTML = x-1;
				}
				if(result == 1)
				{
					Swal.fire({
				  icon: 'error',
				  title: 'Thông báo: ',
				  text: 'Đã bỏ áp dụng voucher vì không đủ số lượng !',
					});
				}
				if(result == 2)
				{
					Swal.fire({
				  icon: 'error',
				  title: 'Thông báo: ',
				  text: 'Đã huỷ áp dụng voucher vì tổng giá trị đơn hàng của bạn phải lớn hơn '+
				  response.vcGtcandat
				  +'đ mới có thể áp dụng voucher này !',
					});
				}

			}
		});
		if(Number(document.getElementById('quanty'+id).innerHTML)==1)
		{
			var input_quanty = document.getElementById('quanty'+id).innerHTML; 
				var val = Number(input_quanty);
				var sub = val - 1;
				var price = document.getElementById('price'+id).value;
				var p = Number(price);
				var total_price = document.getElementById('total_price'+id);
				var rs = p * sub;
				var totalP = document.getElementById('total'+id);
				var ip_totalprice = document.getElementById('input__totalprice').innerHTML;
				var total_Allprice = document.getElementById('total__price');
				var tol = Number(ip_totalprice);
				rs2 = tol - p;

			$(this).closest('tr').remove();
			$('#total'+id).remove();
			document.getElementById('input__totalprice').innerHTML=rs2;
			document.getElementById('total__price').innerHTML=Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(rs2);

			var cart = document.getElementById("cart").innerHTML;
			var x = Number(cart);
			document.getElementById("cart").innerHTML = x-1;
		}
		
	});
</script>
@endsection