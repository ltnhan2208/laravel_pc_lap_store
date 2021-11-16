@extends('Userpage.layout')
@section('content')
<br/>
<section class="container tintuc__info">
	@foreach($data as $value)
		<div class="row justify-content-around">
			<div class="col-lg-2"></div>
			<div class="col-lg-8 tintuc__content">
					<br/>
				<span class="tintuc__produce">{{$value->bnTieude}}</span>
				<br/><br/>
				<div>
					{!! $value->bnNoidung !!}
				</div>
			</div>
			<div class="col-lg-2"></div>
			
		</div>
	@endforeach
</section>
<br/>

@endsection