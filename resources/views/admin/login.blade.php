<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang đăng nhập cho admin</title>

    <!-- Custom fonts for this template-->
    <link href="{{{'public/style_admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet'}}}" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Custom styles for this template-->
    <link href="{{{'public/style_admin/css/sb-admin-2.min.css'}}}" rel="stylesheet">
   
    <link href="{{{'public/style_admin/css/style.css'}}}" rel="stylesheet">
    <script src="{{URL::asset("public/style_admin/js/js.js")}}"></script>
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body id="body__login">
<div id="svg__top">
    <img id="svg__topleft" src="{{URL::asset('public/style_admin/img/img-login/botleft.svg')}}">
    <img id="svg__topleft" src="{{URL::asset('public/style_admin/img/img-login/mail.svg')}}">
     <img id="svg__topright" src="{{URL::asset('public/style_admin/img/img-login/location.svg')}}">
    <img id="svg__topright" src="{{URL::asset('public/style_admin/img/img-login/botright.svg')}}">
</div>
<div id="svg__mid">
    <img id="svg__midleft" src="{{URL::asset('public/style_admin/img/img-login/picture.svg')}}">
    <img id="svg__midright" src="{{URL::asset('public/style_admin/img/img-login/line.svg')}}">
</div>
<div id="svg__bot">
    <img id="svg__botleft" src="{{URL::asset('public/style_admin/img/img-login/topleft.svg')}}">
    <img id="svg__botleft" src="{{URL::asset('public/style_admin/img/img-login/bar.svg')}}">
     <img id="svg__botright" src="{{URL::asset('public/style_admin/img/img-login/calender.svg')}}">
    <img id="svg__botright" src="{{URL::asset('public/style_admin/img/img-login/topright.svg')}}">
</div>

   <form id="form__login" action="{{URL::to('/checkLogin')}}" method="POST">
                {{ csrf_field()}}
                <h1>Đăng nhập</h1>
                <div class="form-group">
                <input onblur="onUser()" name="account" type="text" class="form-control form-control-user" id="username" aria-describedby="emailHelp" placeholder="Enter Account...">
                <br/>
                <span id="acc__err--login"></span>
                </div>  
                <div class="form-group">
                <input onblur="onPass()" id="password" name="password" type="password" class="form-control form-control-user" placeholder="Password">
                <i id="show__pass1" class="far fa-eye"></i>
                <span id="pass__err--login"></span>
                </div>
                <button id="btn__login" type="submit" name="btnLogin" class="btn btn-primary btn-user btn-block">Đăng nhập</button>
                 
                  </form> 
    <!-- Bootstrap core JavaScript-->
    <script src="{{{'public/style_admin/vendor/jquery/jquery.min.js'}}}"></script>
    <script src="{{{'public/style_admin/vendor/bootstrap/js/bootstrap.bundle.min.js'}}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Core plugin JavaScript-->
    <script src="{{{'public/style_admin/vendor/jquery-easing/jquery.easing.min.js'}}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{{'public/style_admin/js/sb-admin-2.min.js'}}}"></script>
    <script src="{{url('public/fe/js/js-validate/validate-login.js')}}"></script>
     @if(Session::has('note_err'))
     <script type="text/javascript">
    Swal.fire({
      icon: 'error',
      title: 'Lỗi đăng nhập',
      text: '{{Session::get('note_err')}}!',
    });
    {{Session::forget('note_err')}}
    </script> 
   @endif

</body>

</html>