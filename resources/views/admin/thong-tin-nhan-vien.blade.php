@extends('admin.layout')
@section('content')


<div class="container">
	<h2 class="text-center text-primary">Thông tin nhân viên</h2>
	<hr/>
	<div class="row justify-content-around">
		<br/>
		@foreach($data as $value)
		<div class="col-lg-2 text-center">
		<img src="{{URL::asset('public/images/nhanvien/'.$value->adHinh)}}" width="200" height="200" style="border-radius: 360px;">
		</div>
		<br/>
		<div class="col-lg-12 text-center">
		<h3>{{$value->adTen}}</h3>
		</div>
		<div class="col-lg-6 text-left">
			<span><i class="fas fa-envelope" style="font-size: 18px;"></i>&nbsp;Email:&nbsp;{{$value->adEmail}}</span>
			<br/><br/>
			<span><i class="fas fa-phone-alt" style="font-size: 18px;"></i>&nbsp;Số điện thoại:&nbsp;{{$value->adSdt}}</span>
			<br/><br/>
			<span><i class="fas fa-map-marker-alt" style="font-size: 18px;"></i>&nbsp;Quê quán:&nbsp;{{$value->adDiachi}}</span>
			<br/><br/>
			<span><i class="fas fa-id-card" style="font-size: 18px;"></i>&nbsp;Chứ minh thư:&nbsp;{{$value->adHinhcmnd}}</span>
			<br/><br/>
			<span><i class="fas fa-user-tag" style="font-size: 18px;"></i>&nbsp;Vị trí:&nbsp;
				@if($value->adQuyen ==2)
					Quản lý
				@elseif($value->adQuyen ==3)
					Thu ngân
				@elseif($value->adQuyen ==4)
					Nhân viên
				@endif</span>
			<br/><br/>
		</div>
		@endforeach

	</div>
</div>
@endsection