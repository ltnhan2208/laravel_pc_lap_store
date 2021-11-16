@extends('Userpage.layout')
@section('content')
<br/>
<section class="container tintuc__info">
	@foreach($data as $value)
	<div class="row">
		<div class="col-lg-12 link__page">Trang chủ&nbsp;>&nbsp;Tin tức&nbsp;>&nbsp;{{$value->ttTieude}}</div>
		<br/><br/>
		<div class="col-lg-12 bg__title">
			<img src="{{URL::asset('public/images/tintuc/'.$value->ttHinh)}}" />
			<div class="bg__title--text">
				<span class="tintuc__title">{{$value->ttTieude}}</span><br/>
				<span class="tintuc__date"><i class="far fa-calendar-alt"></i>&nbsp;{{$value->ttNgaydang}}</span>&emsp;
				<span class="tintuc__view"><i id="show__pass1" class="far fa-eye"></i>&nbsp;{{$value->ttLuotxem}}</span>
			</div>
		</div>
		<div class="row justify-content-around">
			<div class="col-lg-7 tintuc__content">
					<br/>
				<span class="tintuc__produce">{{$value->ttGioithieu}}</span>
				<br/><br/>
				<div>
					{!! $value->ttNoidung !!}
				</div>
			</div>
			<div class="col-lg-1"></div>
			<div class="col-lg-4 tintuc__right">
				<br/>
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
					<br/><br/>
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
	</div>
	@endforeach
</section>
<br/>
@endsection