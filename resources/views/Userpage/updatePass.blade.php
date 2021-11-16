@extends("Userpage.layout_dn_dk")
@section('content')

<br/>
@foreach($data as $v)
 <section class="container content__login">
    <div class="row box__mobile">
      <div class="col-lg-6 col-sm-12">
<form id="login__form" class="box__info"  action="{{URL::to('editPass/'.$v->khMa)}}" method="post">
					{{csrf_field()}}
					<legend><h2>Đổi mật khẩu</h2></legend>
					 <div class="content__login--form">
					<div class="form-group">
						<input onblur="onPass1()" id="cont__pass" class="form-control input__upPass" type="password"  name="khPassCu" placeholder=" " />
							<label for="cont__pass" class="info__item form__label">Mật khẩu cũ:</label>
							<i id="click__pass" class="far fa-eye"></i>
							<span id="old__pass--err"></span>
						@if(Session::has('note__errC')!=null)
							<span style="color:red">{{Session::get("note__errC")}}</span>
						@endif
					</div>
					<div class="form-group">
							<input onblur="onPass2()" id="cont__pass2" class="form-control input__upPass" type="password"  name="khPassMoi" placeholder=" " />
							<label for="cont__pass2" class="info__item form__label">Mật khẩu mới:</label>
							<i id="click__pass2" class="far fa-eye"></i>
							<span style="color:red">{{$errors->first('khPassMoi')}}</span>
							<span id="old__pass--err2"></span>
					</div>
					<div class="form-group">
							<input onblur="onPass3()" id="cont__pass3" class="form-control input__upPass" type="password"  name="khRePassMoi" placeholder=" " />
							<label for="cont__pass3" class="info__item form__label">Nhập lại mật khẩu mới:</label>
							<i id="click__pass3" class="far fa-eye"></i>
						<br/>
						<span style="color:red">{{$errors->first('khRePassMoi')}}</span>
						<span id="old__pass--err3"></span>
						@if(Session::has('note__err')!=null)
							<span style="color:red">{{Session::get("note__err")}}</span>
						@endif
					</div>
					<br/>
					<div class="flex__btnPass">
						<button class="btn btn-dark" type="button" ><a href="{{url('infomation/'.$v->khMa)}}">Trở về</a></button>
						<button id="btn__update" class="btn btn-primary" type="submit">Thực hiện</button>
					</div>
				</div>
				<br/>
				</form>
			</div>
			 <div class="col-lg-6">
          <video id="video" muted loop autoplay>
            <source src="{{URL::asset('public/videos/bglogin.mp4')}}" type="video/mp4">
          </video>
        </div>
		</div>
	</section>
				<br/>
				@endforeach
				<script src="{{url('public/fe/js/js-validate/validate-updatePass.js')}}"></script>
				@endsection

