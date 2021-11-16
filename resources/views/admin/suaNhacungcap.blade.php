@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
        <div id="content" class="container">
        	<br/>
			<form class="row" action="{{URL::to('checkSuaNhacungcap/'.$data->nccMa)}}" method="POST"  >
				 {{ csrf_field()}}
				 	<div class="col-lg-3"></div>
				 	<div class="col-lg-5 info__mid">
				 		<br/>
				<h5 class="text-dark">THÔNG TIN</h5>
				<div class="form-group" style="text-align: center;">
						<label>Mã nhà cung cấp</label>
						<input class="form-control" type="text" name="nccMA" readonly="" value="{{$data->nccMa}}">
					<br/>
						<label>Tên nhà cung cấp</label>
						<input  class="form-control"  type="text" name="nccTen" value="{{$data->nccTen}}">
					<span class="alert-danger">{{$errors->first('nccTen')}}</span><br/>
						<label>Số điện thoại</label>
						<input  class="form-control"  type="number" name="nccSdt"  value="{{$data->nccSdt}}" ><br><span class="alert-danger">{{$errors->first('nccSdt')}}</span>
					<br/>
						<label>Địa chỉ</label>
						<input  class="form-control"  type="text" name="nccDiachi"  value="{{$data->nccDiachi}}">
						<br><span class="alert-danger">{{$errors->first('nccDiachi')}}</span>
						<br/>
						<button class="btn btn-secondary" type="button" onclick="back()">Trở về</button>
						&emsp;
						  <button class="btn btn-primary" type="submit">Thực hiện</button>
					</div>
					</div>
			 	
			</form>
                               
		</div>
	</div>



@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Opss... ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif


@endsection

