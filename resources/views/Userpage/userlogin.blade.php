@extends("Userpage.layout_dn_dk")
@section('title')
  Đăng nhập
@endsection
@section('register')
  Đăng ký
@endsection
@section("content")
 <section class="container-fluid content__login">
    <div class="row justify-content-between box__mobile">
      <div class="col-lg-5 col-sm-12">
        <br/>
          <form id="login__form" action="{{URL::to('/checklogin')}}" method="post">
              <legend><h2>Đăng nhập</h2></legend>
            {{csrf_field()}}
            <div class="content__login--form">
              <br/><br/>
              <!--account-->
              <div class="form-group">
                <input onblur="onUser()" id="username" type="text" name="username" value="{{old('username')}}" class="form-control input__login" maxlength="50">
                 <label for="username" class="form__label">Tên đăng nhập/ Email / Số điện thoại</label>
             
                <span id="acc__err--login"></span>
              </div>
              <!--password-->
              <div class="form-group">
                <input onblur="onPass()" id="password" type="password" name="password" class="form-control input__login" maxlength="50">
                 <label for="password" class="form__label">Mật khẩu</label>

                <i id="show__pass1" class="far fa-eye"></i>
                <span id="pass__err--login"></span>
              </div>
              <br/>
              <div class="d-flex justify-content-between">
               
                <span><a href="{{URL::to('forgotPassword')}}" class="forgot-pass">Quên mật khẩu</a></span> 
              </div>
              <br/>
              <button onmouseover="btnLogin()" id="btn__login" type="submit" class="btn btn-block btn-primary">Đăng nhập</button>
              <span class="d-block text-center my-4 text-muted">&mdash; Hoặc &mdash;</span>
              <div>
                   <a href="{{URL::to('/google')}}" style="text-decoration: none;" class="btn btn-outline-danger btn-user btn-block btn__google">
                                            <i class="fab fa-google fa-fw"></i> Đăng nhập bằng <strong>Google</strong>
                                        </a>
                                     {{--    <a href="{{URL::to('/facebook')}}" style="text-decoration: none; "  class="btn btn-outline-primary btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Đăng nhập bằng <strong>Facebook</strong>
                                        </a> --}}
              </div>
              <br/>
              </div>
          </form>
        </div>
        <div class="col-lg-6">
          <video id="video" muted loop autoplay>
            <source src="{{URL::asset('public/videos/bglogin.mp4')}}" type="video/mp4">
          </video>
        </div>
      </div>
  </section>
<!--Javascript code-->
<script src="{{URL::asset('public/fe/js/js-validate/validate-login.js')}}"></script>
@if(Session::has('loginmessage'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: '{{Session::get('loginmessage')}}!',
  footer: '<a class="btn-outline-primary" href="{{URL::to('/register')}}">Đăng ký</a>'
})
</script> 
@endif
  @if(Session::has('registerSuccess'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Register success ',
  text: '{{Session::get('registerSuccess')}}!',
})
</script> 
@endif
  @if(Session::has('changepassword'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thay đổi mật khẩu thành công!',
  text: '{{Session::get('changepassword')}}!',
});
</script> 
@endif
<br/><br/><br/><br/><br/>
@endsection

