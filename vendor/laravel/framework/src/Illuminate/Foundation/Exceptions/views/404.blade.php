@extends('Userpage.layout')
@section('title')
Không tìm thấy trang yêu cầu
@endsection
@section('content')

	<div class="container">
		<div class="row">
			<div class="mb-3 col-3">
			</div>
		</div>
		<div class="row">
			<div class="mb-3 col-3">
			</div>
			<div class="mb-3 col-3">
				<img src="{{URL::asset('public/404/404.jpg')}}">	
			</div>
			<div class="mb-3 col-3">
			</div>
		</div>
	
	</div>
	
@endsection