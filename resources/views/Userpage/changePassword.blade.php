
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{URL::asset('public/fe/login/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{URL::asset('public/fe/login/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{URL::asset('public/fe/login/css/bootstrap.min.css')}}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{URL::asset('public/fe/login/css/style.css')}}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
{{-- FontAW --}}
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Tạo mật khẩu mới</title>
  </head>
  <body>
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{URL::asset('public/fe/login/images/bg_2.jpg')}}');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="mb-4">
              <h3>Chào {{$name}} !! Hãy tạo mật khẩu mới</h3>
              <p style="color: red" class="mb-4">
                </p>
            </div>
            <form action="{{URL::to('newpass/'.$id)}}" method="post">
            {{csrf_field()}}
              <div class="form-group first">
                <label for="password">Nhập mật khẩu mới</label>
                <input type="password" name="password" maxlength="50" class="form-control" id="password">

              </div>
              <div class="form-group first">
                <label for="email">Xác nhận mật khẩu</label>
                <input type="password" name="repassword" class="form-control" id="email">

              </div>
              <input type="submit" value="Khôi phục tài khoản" class="btn btn-block btn-primary">
              <span class="d-block text-center my-4 text-muted">&mdash; Hoặc &mdash;</span>
              <div class="row" style="color: white; ">
                   <a href="{{URL::to('/google')}}" style="text-decoration: none;" class="btn btn-outline-danger btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Đăng nhập bằng <strong>Google</strong>
                                        </a>
                                      {{--   <a href="{{URL::to('/facebook')}}" style="text-decoration: none; "  class="btn btn-outline-primary btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Đăng nhập bằng <strong>Facebook</strong>
                                        </a> --}}
              </div>
                
                  <span class="d-block text-center my-4 text-muted"><a  style="text-decoration: none;" href="{{URL::to('/')}}">Trở về trang chính</a>&nbsp;/&nbsp;<a style="text-decoration: none;"  href="{{URL::to('/register')}}">Đăng ký</a></span>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    
    

    <script src="{{URL::asset('public/fe/login/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{URL::asset('public/fe/login/js/popper.min.js')}}"></script>
    <script src="{{URL::asset('public/fe/login/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('public/fe/login/js/main.js')}}"></script>

  </body>
</html>
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
