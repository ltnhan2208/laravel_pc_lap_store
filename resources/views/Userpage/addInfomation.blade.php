@extends("Userpage.layout_dn_dk")
@section('title')
  Đăng ký tài khoản
@endsection
@section("content")
<br/>
<section class="container content__register" >
    <div class="row box__mobile">
     
      <div class="col-lg-6">
            <form id="login__form" action="{{URL::to('addInfomation/'.Auth::guard('khachhang')->user()->khMa)}}" method="post">
             <legend><h3>Đăng ký tài khoản  {{Session::get('khMa')}} {{Auth::guard('khachhang')->user()->khTen}}</h3></legend>
            {{csrf_field()}}
   
            <br/>
            <div class="content__register--form">
              
               <div class="form-group ">

                <input onblur="onPass1()" id="password" type="password" name="password" required class="form-control input__register" placeholder=" " maxlength="50">
                 <label for="password" class="form__label">Mật khẩu</label>

                <i id="show__pass1" class="far fa-eye" style="font-size: 23px;"></i>
                <span id="pass__err"></span>
              </div>
              <div class="form-group ">
                <input onblur="onPass2()" id="repassword" type="password" name="repassword" required class="form-control input__register" placeholder=" ">
                 <label for="repassword" class="form__label">Nhập lại mật khẩu</label>
                 <i id="show__pass2" class="far fa-eye" style="font-size: 23px;"></i>
                 <span id="pass__err2"></span>
              </div>
              
              <div class="form-group  ">
                <input onblur="onAddress()" minlength="10" title="Địa chỉ bao gồm: Số nhà, Tên đường, phường xã (Độ dài phải hơn 10 ký tự)" id="address" maxlength="200" type="text" name="address" required class="form-control input__register" placeholder=" " value="{{old('address')}}">
                <label for="address" class="form__label">Địa chỉ</label>
                 <span id="address__err--regis"></span>
              </div>
               <div class="form-group">
                <input onblur="onSDT()" id="sdt" type="number" name="sdt" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  required class="form-control input__register" placeholder=" "  maxlength="11"  value="{{old('sdt')}}">
                <label for="sdt" class="form__label">Số điện thoại</label>
                <span id="sdt__err--regis" style="color: red"></span>
              </div>
              <div class="form-group last  mb-3">
              <button id="btn__register" type="submit" class="btn btn-block btn-primary">Xác nhận</button>
              </div>
              <br>
                </div>
                <br>
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
<!----Javascript code-->
@if(Session::has('info'))
<script type="text/javascript" >
Swal.fire({
  icon: 'info',
  title: 'Thông báo',
  text: '{{Session::get('info')}}!',
})
</script> 
@endif

@if(Session::has('err'))
<script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo',
  text: '{{Session::get('err')}}!',
})
</script> 
@endif
<script type="text/javascript">
          
// Show notification registe
@if(Session::has('ok'))
Swal.fire({
  icon: 'info',
  title: 'Thông báo',
  text: '{{Session::get('ok')}}!',
});

@endif
</script>
<script src="{{url('public/fe/js/js-validate/validate-register.js')}}"></script>
@endsection
