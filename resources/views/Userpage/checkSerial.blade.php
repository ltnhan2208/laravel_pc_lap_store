@extends('Userpage.layout')
@section('title')
Kiểm tra hạn bảo hành
@endsection
@section('content')
<br>
<div class="container">
	<section>
		<div class="row">
			<div class="mb-3 col-6">
				<form class="form-group" action="{{URL::to('checkSerial')}}" method="get">
					<label>Nhập mã cần kiểm tra:
						<input 
						class="inputSerial" 
						pattern="[A-Za-z\d]{10,20}"
						@if($result)
							value="{{$result->serMa}}"
						@else 
						value="{{old('serMa')}}"  
						@endif
						title="Mã phải là chữ hoặc số không chứa ký tự đặc biệt. Độ dài từ 10-20 ký tự."  
						maxlength="20" 
						type="text" 
						name="serMa">
					</label>
					<button class="btn btn-primary" type="submit"><i class="fas fa-exclamation-triangle"></i> Kiểm tra</button>
				</form>
				
				@if($result)
					<b>Thời hạn bảo hảnh: {{$result->spHanbh}} tháng.</b><br>
					<b>Thời gian bảo hành đến hết ngày: {{date_format(date_create($month),"d/m/Y ")}}.</b><br>
					<b>Lần bảo hành gần nhất: </b>
					<a href="#" id="myBtn" onclick="view()">Xem danh sách ngày bảo hành</a>
				@endif
			</div>
								@if($log)
								<!-- The Modal -->
								<div id="myModal" class="modal">
								  <!-- Modal content -->
								  <div class="modal-content" >
								    <div class="close text-dark">Lịch sử bảo hành</div>
								    <table class="table-responsive table-active table-hover table-info">
								    	<thead>
								    		<tr>
								    			<th>Ngày bảo hành</th>
								    			<th>Số điện thoại khách bảo hành</th>
								    			<th>Nội dung bảo hành</th>
								    			<th>Tình trạng</th>
								    		</tr>
								    	</thead>
								    	<tbody>
								    		@foreach($log as $v)
								    		<tr>
								    			<td>{{$v->bhNgay}}</td>
								    			<td>{{$v->bhSdt}}</td>
								    			<td>{{$v->bhNoidung}}</td>
								    			<td>@if($v->bhTinhtrang==1) Đã trả hàng @else Đang xử lý @endif</td>
								    		</tr>
								    		@endforeach
								    	</tbody>
								    </table>
								    <table class="order__table">
								    	
								    </table>
								  </div>
								</div>
								@endif

			@if($result)
			<div class="row justify-content-around">
				<div>
							<a href="{{URL::to('proinfo/'.$result->spMa)}}"><img src="{{URL::asset('public/images/products/'.$result->spHinh)}}" alt="" width="200" height="200"></a>
							<br/>
											
												<label class="item_name"><a href="{{URL::to('proinfo/'.$result->spMa)}}">{{$result->spTen}}</a></label>
												<br/>
										</div>
				</div>

					<div class="col-lg-12 ">
						<br/><br/>
								<h4>Thông số kỹ thuật:</h4>
						<table class="table table-hover">
						
							@if($details->ram!=null)
							<tr>
								<td class="mota__left">RAM</td>
								<td class="mota__right">{{$details->ram}}</td>
							</tr>
							@endif
							@if($details->cpu!=null)
							<tr>
								<td class="mota__left">CPU</td>
								<td class="mota__right">{{$details->cpu}}</td>
							</tr>
						
							@endif
							@if($details->ocung!=null)
							<tr>
								<td class="mota__left">Ổ cứng</td>
								<td class="mota__right">{{$details->ocung}}</td>
							</tr>
							@endif
							@if($details->psu!=null)
								<tr>
								<td class="mota__left">PSU</td>
								<td class="mota__right">{{$details->psu}}</td>
							</tr>
							@endif
							@if($details->vga!=null)
								<tr>
								<td class="mota__left">VGA</td>
								<td class="mota__right">{{$details->vga}}</td>
							</tr>
							@endif
							@if($details->mainboard!=null)
							<tr>
								<td class="mota__left">Mainboard</td>
								<td class="mota__right">{{$details->mainboard}}</td>
							</tr>
							@endif
							@if($details->manhinh!=null)
								<tr>
								<td class="mota__left">Màn hình</td>
								<td class="mota__right">{{$details->manhinh}}</td>
							</tr>
							@endif
							@if($details->chuot!=null)
							<tr>
								<td class="mota__left">Chuột</td>
								<td class="mota__right">{{$details->chuot}}</td>
							</tr>
							@endif
							@if($details->banphim!=null)
							<tr>
								<td class="mota__left">Bàn phím</td>
								<td class="mota__right">{{$details->banphim}}</td>
							</tr>
							@endif
							@if($details->vocase!=null)
							<tr>
								<td class="mota__left">Case</td>
								<td class="mota__right">{{$details->vocase}}</td>
							</tr>
							@endif
							@if($details->pin!=null)
							<tr>
								<td class="mota__left">Pin</td>
								<td class="mota__right">{{$details->pin}}</td>
							</tr>
							@endif
							@if($details->tannhiet!=null)
							<tr>
								<td class="mota__left">Tản nhiệt</td>
								<td class="mota__right">{{$details->tannhiet}}</td>
							</tr>
							@endif
							@if($details->loa!=null)
							<tr>
								<td class="mota__left">Loa</td>
								<td class="mota__right">{{$details->loa}}</td>
							</tr>
							@endif

							@if($details->mau!=null)
							<tr>
								<td class="mota__left">Màu</td>
								<td class="mota__right">{{$details->mau}}</td>
							</tr>
							@endif
							@if($details->trongluong!=null)
							<tr>
								<td class="mota__left">Trọng lượng</td>
								<td class="mota__right">{{$details->trongluong}}</td>
							</tr>	 
							@endif
							@if($details->conggiaotiep!=null)
							<tr>
								<td class="mota__left">Cổng giao tiếp</td>
								<td class="mota__right">{{$details->conggiaotiep}}</td>
							</tr>
							@endif
							@if($details->webcam!=null)
							<tr>
								<td class="mota__left">Webcam</td>
								<td class="mota__right">{{$details->webcam}}</td>
							</tr>
							@endif
							@if($details->chuanlan!=null)
							<tr>
								<td class="mota__left">Chuẩn LAN</td>
								<td class="mota__right">{{$details->chuanlan}}</td>
							</tr>
							@endif
							@if($details->chuanwifi!=null)
							<tr>
								<td class="mota__left">Chuẩn WIFI</td>
								<td class="mota__right">{{$details->chuanwifi}}</td>
							</tr>
							@endif
							@if($details->hedieuhanh!=null)
							<tr>
								<td class="mota__left">Hệ điều hành</td>
								<td class="mota__right">{{$details->hedieuhanh}}</td>
							</tr>
							@endif
					</table>
				</div>
				@else
					<div id="space__footer"></div>
				@endif
			</div>
</section>
	</div>

<script type="text/javascript">
	function view()
	{
		// Get the modal

		var modal = document.getElementById("myModal");
		var span = document.getElementsByClassName("close")[0];
		 modal.style.display = "block";

		window.onclick = function(event) {
		  if (event.target == modal) {
		    modal.style.display = "none";
		  }
		}
	}
</script>




@if(Session::has('error'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('error')}}',
 
})
</script> 
@endif

@endsection