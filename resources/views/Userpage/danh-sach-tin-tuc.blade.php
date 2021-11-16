@extends('Userpage.layout')
@section('content')
<br/><br/>

<section class="container list__tintuc">
	<div class="row justify-content-around">
	<div class="col-lg-7">
		<div class="col-lg-12 list__tintuc--left">
			<div>Mới cập nhật</div>
		</div>
	<br/><br/>
	
	@foreach($data1 as $value)
	<div class="row tintuc__left">
		<div class="col-lg-5 tintuc__item--left">
			<img src="{{URL::asset('public/images/tintuc/'.$value->ttHinh)}}">
		</div>
		<div class="col-lg-7 tintuc__item--right justify-content-start">
			<a href="{{url('chi-tiet-tin-tuc/'.$value->ttMa)}}"><span class="tintuc__title">{{$value->ttTieude}}</span></a>
			<br/>
			<span class="tintuc__date"><i class="far fa-calendar-alt"></i>&nbsp;{{$value->ttNgaydang}}</span>&emsp;
			<span class="tintuc__view"><i id="show__pass1" class="far fa-eye"></i>&nbsp;{{$value->ttLuotxem}}</span>
			<br/>
			<span class="tintuc__produce">{{$value->ttGioithieu}}</span>
			<br/><br/>
			<a href="{{url('chi-tiet-tin-tuc/'.$value->ttMa)}}">Xem thêm</a>
		</div>
	</div>
	<br/>
	@endforeach
	
	</div>
	<div class="col-lg-4">
		<div class="col-lg-12 list__tintuc--right">
			<div>Bên lề</div>
		</div>
		<br/><br/>
	@foreach($data2 as $value)
	<div class="row tintuc__right">
		<div class="col-lg-5 tintuc__item--left">
			<img src="{{URL::asset('public/images/tintuc/'.$value->ttHinh)}}">
		</div>
		<div class="col-lg-7 tintuc__item--right justify-content-start">
			<a href="{{url('chi-tiet-tin-tuc/'.$value->ttMa)}}"><span class="tintuc__title">{{$value->ttTieude}}</span></a>
			<br/>
			<span class="tintuc__date"><i class="far fa-calendar-alt"></i>&nbsp;{{$value->ttNgaydang}}</span>&emsp;
			<span class="tintuc__view"><i id="show__pass1" class="far fa-eye"></i>&nbsp;{{$value->ttLuotxem}}</span>
			<br/>
			<a href="{{url('chi-tiet-tin-tuc/'.$value->ttMa)}}">Xem thêm</a>
		</div>
	</div>
	<br/>
	@endforeach
	</div>
	</div>
</section>
@if(!empty($data1) && !empty($data2))
	<div id="space__footer"></div>
@endif

@endsection