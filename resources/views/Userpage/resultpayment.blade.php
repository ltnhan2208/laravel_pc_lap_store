@extends('Userpage.layout')
@section('content')
<div class="container">
	<div class="wrap_content_payment">
		<div class="content">
				<img class="momo" style="width: 25%; border-radius: 37px;" src="{{URL::asset('public/images/paymentlogo/momo.svg')}}">
			<h1>Thanh toán @if($data['errorCode']==0) thành công @else thất bại @endif</h1>
			<div class="row paymentinfo">
				<div class="col-lg-12">
					@if($data['errorCode'] !=0)
					<h2>Đã xảy ra lỗi trong quá trình thanh toán !</h2>
					<span style="font-size: 30px;">Vui lòng thanh toán khi nhận hàng.<br>
					Hoặc chuyển khoản qua tài khoản ngân hàng:</span>
					<p>
						@foreach($bankInfo as $item)
							<dl>Tên chủ thẻ: {{$item->tenchuthe}}
								<dt>Số tài khoản: {{$item->stk}}</dt>
								<dt>Tên ngân hàng: {{$item->tennganhang}}</dt>
							</dl>
						@endforeach
					</p>
					@endif
				</div>
				<div class="col-lg-12">
					<label>Mã  đơn hàng: </label>{{$data['orderId']}}
				</div>
				<div class="col-lg-12">
					<label>Mã giao dịch:</label> {{$data['transId']}}
				</div>
				<div class="col-lg-12">
					<label>Số tiền thanh toán:</label> {{number_format($data['amount'])}} VND
				</div>
				<br/><br/>
			</div>
				<a id="btn__back" href="{{URL::to('product')}}"><i class="fas fa-arrow-circle-left"></i> Tiếp tục mua sắm</a>
				<br/><br/>
		</div>
	</div>
</div>
@endsection

