@extends("Userpage.layout_dn_dk")
@section('title')
  Đăng nhập
@endsection
@section('register')
  Đăng ký
@endsection
@section("content")
  <section class="container content__login">
    <div class="row">
      <div class="col-lg-6 col-sm-12">
        <br/><br/><br/>
          <form id="login__form" action="{{URL::to('sendCodeGetAcc')}}" method="post" style="height: 200px;">
              <legend><h2>Quên mật khẩu</h2></legend>
            {{csrf_field()}}
            <br/><br/>
            <div class="content__login--form">
              <br/>
              <!--account-->
              <div class="form-group">
                 <input id="ip__email" type="email" name="email" required class="form-control input__register" placeholder=" " value="{{old('email')}}">
                <label for="ip__email" class="form__label">Email</label>
                <span id="email__err--regis"></span>
                 
              </div>
              <!--password-->
             
              <br/>
              <button id="btn__login" type="submit" class="btn btn-block">
                Khôi phục tài khoản
              </button>
        
              <br/>
              </div>
              <br/><br/>
          </form>
        </div>
        <div class="col-lg-6">
            <br/><br/><br/>
          <img id="register__svg" src="{{URL::asset('public/videos/doc.svg')}}" />
          </div>
      </div>
  </section>
  <br/>
<!--Javascript code-->
<script src="{{URL::asset('public/fe/js/js-validate/validate-login.js')}}"></script>
  @if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: '{{Session::get('err')}}!',
  footer: '<a href="{{URL::to('/register')}}">Đăng ký</a></span>'
})
</script> 
@endif

 @if(Session::has('mail'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'OK',
  text: '{{Session::get('mail')}}!',
})
</script> 
@endif
<br/><br/><br/><br/><br/>
@endsection











