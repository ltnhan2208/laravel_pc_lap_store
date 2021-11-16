@extends('Userpage.layout')
@section('title')
Danh sách đơn hàng
@endsection
@section('content')
<br>
<section class="list__order">
	<div class="container-fluid">
		<div class="row">
				@if($vt1Check != 0)
	@foreach($vt1 as $vt1)
<a href="{{url('chi-tiet-banner/'.$vt1->bnMa)}}"  class="quang__cao" style="width: 12.3%;background-image: url({{URL::asset('public/images/banners/'.$vt1->bnHinh)}});background-size: cover;"></a>
@endforeach
@endif
		<div class="col-lg-9">
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-bordered" id="dataTable">
					<thead>
						<tr>
							<td colspan="9" class="text-center text-primary">
								<h2>DANH SÁCH ĐƠN HÀNG</h2>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr class="thead">
							<td>Mã đơn hàng</td>
							<td>Ngày đặt</td>
							 <td>Số lượng</td>
							<td>Tổng tiền</td>
							<td>Địa chỉ giao hàng</td> 
							<td>Số điện thoại nhận</td>
							<td>Tình trạng</td>
							<td></td>
							<td></td>
						</tr>

						@foreach($list as $i)
					
						<tr>
							<td>{{$i->hdMa}}</td>
							<td>{{date_format(date_create($i->hdNgaytao),('d/m/Y H:i:s'))}}</td>
							<td>{{$i->hdSoluongsp}}</td>
							<td>{{number_format($i->hdTongtien)}} VND</td>
							<td>{{$i->hdDiachi}}</td>
							<td>{{$i->hdSdtnguoinhan}}</td>
							<td>
								@if($i->hdTinhtrang==0)
									<span style="color:red;">Đang chờ xác nhận</span>
								@elseif($i->hdTinhtrang==1)
										<span style="color:blue;">Đang giao hàng</span>
								@elseif($i->hdTinhtrang==2)
										<span style="color:green;">Đã thanh toán</span>
								@elseif($i->hdTinhtrang==3)
										<span style="color:blue;">Đã thanh toán, chờ xác nhận giao hàng</span>
								@elseif($i->hdTinhtrang==7 || $i->hdTinhtrang==5)
										<span style="color:orange;">Đơn hàng bổ sung đang giao</span>
								@elseif($i->hdTinhtrang==10 || $i->hdTinhtrang==9)
										<span style="color:red;">Đã hủy</span>
								@endif
							</td>
							<td>
								<a class="btn btn-dark text-white" id="myBtn" onclick="view{{$i->hdMa}}()">Xem</a>
									<!-- The Modal -->
								<div id="myModal{{$i->hdMa}}" class="modal">

								  <!-- Modal content -->
								  <div class="modal-content">
								    <div class="close text-dark">Chi tiết đơn hàng</div>

								    <table class="order__table" >
								    	<tbody>
								    		<tr class="thead">
								    			<td>Tên sản phẩm</td>
								    			<td>Hình</td>
								    			<td>Đơn giá</td>
								    			<td>Serial</td>
								    		</tr>
								    		@foreach($details as $v)
								    			@if($v->hdMa==$i->hdMa)
										    		<tr>
										    			<td>{{$v->spTen}}</td>
										    			<td class="invert-image"><a href="{{URL::to('proinfo/'.$v->spMa)}}"><img src="{{URL::asset('public/images/products/'.$v->spHinh)}}" alt=" " class="img-responsive" /></a></td>
										    			<td>{{number_format($v->cthdGia)}} VND</td>
										    			<td>
										    				@if($v->serMa != null)
										    					{{$v->serMa}}
										    				@else
										    					Chưa giao hàng
										    				@endif
										    			</td>
										    			
										    		</tr>
								    			@endif
								    		@endforeach
								    	</tbody>
								    </table>
								  </div>
								</div>

							</td>
							<td>
								@if($i->hdTinhtrang==0)
									<a class="btn btn-danger" href="{{url('huy-don/'.$i->hdMa)}}">Hủy đơn</a>
								@endif
							</td>
						</tr>
									
					@endforeach	

					</tbody>
				</table>
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

<br/>

@foreach($list as $i)
<script>
	function view{{$i->hdMa}}()
	{
		// Get the modal

		var modal = document.getElementById("myModal{{$i->hdMa}}");
		var span = document.getElementsByClassName("close")[0];
		 modal.style.display = "block";
		window.onclick = function(event) {
		  if (event.target == modal) {
		    modal.style.display = "none";
		  }
		}
	}
</script>
@endforeach
@endsection


