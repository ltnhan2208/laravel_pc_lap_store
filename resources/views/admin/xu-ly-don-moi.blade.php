@extends('admin.layout')
@section('content')

<div class="container-fluid">
	<h2 class="text-center text-primary">Nhập thông tin đơn hàng</h2>
	<hr/>
	<br/>
	<div class="row justify-content-around">
		@foreach($data as $value)
		<form class="row" action="{{URL::to('giaohang/'.$value->hdMa)}}" method="POST">
			 {{ csrf_field() }}
			 <div class="info__mid col-lg-12">
			 	<br/>
			 <label class="form-label">Chọn nhân viên giao:&nbsp;</label>
			 <select name="hdNhanvien" class="btn btn-outline-info">
			 	@foreach($dataNV as $nv)
			 		<option value="{{$nv->adMa}}">{{$nv->adTen}}</option>
			 	@endforeach
			 </select>
			 <br/><br/>
			 <label class="form-label">Mã đơn hàng:&nbsp;{{$value->hdMa}}</label><br/>
			 <label class="form-label">Số lượng sản phẩm:&nbsp;{{$value->hdSoluongsp}}</label><br/>
			 <table style="width: 100%;text-align: center;">
			 	@foreach($data2 as $ct)
			 	<tr>
			 		<td>{{$ct->spTen}}<input name="spMa[]" hidden value="{{$ct->spMa}}" /></td>
			 		<td style="border:0">
			 			<select name="serMa[]" class="ui search searchSer dropdown">
			 			 	<option value="0">-Chọn mã serial-</option>
						 	@foreach($dataSer as $ser)
						 	@if($ser->spMa == $ct->spMa)
						 		<option value="{{$ser->serMa}}">{{$ser->serMa}}</option>
						 	@endif
						 	@endforeach
						 </select>

			 		</td>
			 	</tr>
			 	@endforeach
			 </table>
			 <br/>
			  <div class="row justify-content-around">
             <button class="btn btn-dark" type="button" onclick="back()">Trở về</button>
			 <button class="btn btn-primary">Xác nhận</button>
			</div>


			<br/>
			</div>
			 <br/>
			<br/>
		</form>
		@endforeach
	</div>
</div>
<script type="text/javascript">
	$('.searchSer')
  .dropdown({
    allowAdditions: true
  })
;
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