@extends('Userpage.layout_dn_dk')
@section('title')
Xác thực Email
@endsection
@section('content')
	<div class="container-fluid content__login">
		<div class="row justify-content-between box__mobile">
			<div class="col-lg-4">
					<form id="login__form" action="{{URL::to('verifycode')}}" method="post" accept-charset="utf-8">
					{{csrf_field()}}
					<br/><br/><br/>
					<legend><h3 class="text-white">Một mã xác thực sẽ được gửi đến email {{$userEmail->khEmail}}  vui lòng kiểm tra email của bạn!.</h3></legend>
					<br/>
						<div class="form-group">
						    <input type="text" class="form-control input__login" placeholder="Nhập mã tại đây" aria-label="Username" name="code" aria-describedby="basic-addon1">
						</div>
						<br/>
					
								<button type="button" id="buttoncode" class="col-12 btn btn-outline-danger btn-user btn__google"><i class="fas fa-paper-plane"></i> Gửi mã xác thực</button>
								&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
								<button id="btn__login" type="submit" class="col-12 btn btn-primary"><i class="far fa-check-square"></i>&nbsp;Xác nhận</button>
					</form>
				
				<p class="btn btn-danger disabled" style="display: none;" id="countdowntimer"></p>
			</div>
			 <div class="col-lg-6">
            <br/><br/><br/>
          <img id="register__svg" src="{{URL::asset('public/videos/doc.svg')}}" />
          </div>
	</div>
</div>
<script type="text/javascript">
  	$(document).on('click','#buttoncode',function(e){
			e.preventDefault();
			var timeleft = 20;
    var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("countdowntimer").style.display = 'block';
    document.getElementById("countdowntimer").textContent = 'Có thể gửi lại mã sau '+timeleft +' giây.';
    if(timeleft <= 0)
        clearInterval(downloadTimer);
    },1000);
      document.getElementById("buttoncode").disabled = true;
      setTimeout(function(){document.getElementById("buttoncode").disabled = false;},20000);

			$.ajax({
				TYPE:"GET",
				url: '{{URL::to('sendcode')}}',
				dataType:'JSON',
				success:function(response)
				{
					result = response.message;
					if(result== 1)
					{
							Swal.fire({
						  icon: 'success',
						  title: 'Thông báo: ',
						  text: 'Đã gửi mã xác thực vui lòng kiểm tra email !',
						});
					}
					else
					{
						Swal.fire({
						  icon: 'error',
						  title: 'Thông báo: ',
						  text: 'Vui lòng đăng nhập để thực hiện chức năng này!',
						});
					}
				}
			});

		})

</script>



@if(Session::has('success'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thông báo: ',
  text: '{{Session::get('success')}}',
 
})
</script> 
@endif

@if(Session::has('verifySuccess'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thông báo: ',
  text: '{{Session::get('verifySuccess')}}',
 
})
</script> 
@endif

@if(Session::has('verifyFail'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('verifyFail')}}',
 
})
</script> 
@endif
@endsection