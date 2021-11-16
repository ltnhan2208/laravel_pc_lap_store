@extends("Userpage.layout_dn_dk")
@section('title')
  Đăng ký tài khoản
@endsection
@section('login')
  Đăng nhập
@endsection
@section("content")

<section class="container content__register">
    <div class="row box__mobile">
      <div class="col-lg-6 col-sm-12">
            <form id="login__form" action="{{URL::to('getregister')}}" method="post">
             <legend><h2>Đăng ký tài khoản</h2></legend>
            {{csrf_field()}}
            <br/><br/>
            <div class="content__register--form">
               <div class="form-group">
                <input onblur="onName()" id="ip__name" type="text" name="name" class="form-control input__register" maxlength="50" value="{{old('name')}}">
                <label for="ip__name" class="form__label">Tên của bạn</label>

                <span id="name__err--regis"></span>
              </div>

              <div class="form-group">

                <input id="ip__email" type="email" name="email" required class="form-control input__register" maxlength="50" value="{{old('email')}}">
                <label for="" class="form__label">Email</label>

                <span id="email__err--regis"></span>
              </div>
               <div class="form-group">
                <input type="date" name="date" id="date" required class="form-control input__register" placeholder=" " value="{{old('date')}}">
                <label for="date" class="form__label">Ngày sinh</label>
              </div>
               <div class="form-group">

                <input onblur="onAcc()" id="ip__acc" type="text" name="username" required class="form-control input__register"maxlength="50" value="{{old('username')}}">
                <label for="ip__acc" class="form__label">Tên đăng nhập</label>
                <span id="acc__err--regis"></span>
              </div>
               <div class="form-group">
                <input onblur="onPass1()" id="password" type="password" name="password" required class="form-control input__register"maxlength="50" value="{{old('password')}}">
                 <label for="password" class="form__label">Mật khẩu</label>

                <i id="show__pass1" class="far fa-eye"></i>
                <span id="pass__err"></span>
              </div>
              <div class="form-group">
                <input onblur="onPass2()" id="repassword" type="password" name="repassword" required class="form-control input__register" placeholder=" " value="{{old('repassword')}}">
                 <label for="repassword" class="form__label">Nhập lại mật khẩu</label>
                 <i id="show__pass2" class="far fa-eye"></i>
                 <span id="pass__err2"></span>
              </div>
              
              <div class="form-group">

                <input onblur="onAddress()" id="address" type="text" name="address" required class="form-control input__register" maxlength="50" value="{{old('address')}}">
                <label for="address" class="form__label">Địa chỉ</label>
                 <span id="address__err--regis"></span>
              </div>
              <div class="form-group">
                <input onblur="onSDT()" id="sdt"  type="number" title="Ký tự nhập vào phải là số có độ dài từ 10 - 11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="sdt" required class="form-control input__register" maxlength="11" value="{{old('sdt')}}">
                <label for="" class="form__label">Số điện thoại</label>

                <span id="sdt__err--regis"></span>
              </div>
              <div style="width: 100%;">
                 <input type="radio" name="sex" checked value="1">&nbsp;<span class="radio__val">Nam</span> &emsp;&emsp;&emsp;&emsp;&emsp;
                <input type="radio" name="sex" value="0" >
                <span  class="radio__val">&nbsp;Nữ</span>
              </div>
              <button id="btn__register" type="submit" class="btn btn-block btn-primary">Đăng ký</button>
              <br/>
               <span class="d-block text-center my-4 text-muted">&mdash; Hoặc &mdash;</span>
              <div>
                   <a href="{{URL::to('/google')}}" style="text-decoration: none;" class="btn btn-outline-danger btn-user btn-block btn__google">
                                            <i class="fab fa-google fa-fw"></i> Đăng ký bằng <strong>Google</strong>
                                        </a>
                                     {{--    <a href="{{URL::to('/facebook')}}" style="text-decoration: none; "  class="btn btn-outline-primary btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Đăng ký bằng <strong>Facebook</strong>
                                        </a> --}}
              </div>  
                </div>
                <br/>
            
          </div>
          <div class="col-lg-6">
             <video id="video" muted loop autoplay>
            <source src="{{URL::asset('public/videos/bglogin.mp4')}}" type="video/mp4">
          </video>
          <img id="register__svg" src="{{URL::asset('public/videos/doc.svg')}}" />
          </div>
          </form>
        </div>
        </section>
        <br/>
        {{-- @dd(Session::get('error')); --}}
<!----Javascript code-->

<script src="{{url('public/fe/js/js-validate/validate-register.js')}}"></script>
@if(Session::has('error'))
<script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Opss... ',
  text: '{{Session::get('error')}}!',
})
</script> 
@endif
<br/><br/><br/>
@endsection
