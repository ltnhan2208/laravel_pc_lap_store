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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Register</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{{'public/fe/login/images/bg_2.jpg'}}}');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="mb-4">
              <h3>Register</h3>
              <p style="color: red" class="mb-4">
                <?php 
                  $mes = Session::get('error'); 
                  if(isset($mes))
                  {
                    echo $mes;
                    Session::forget('error');
                  }
                ?> 
                </p>
            </div>
            <form action="{{URL::to('registerForApi')}}" method="post">
            {{csrf_field()}}
               <div class="form-group first">
                <label for="name">Name</label>
                <input type="text" name="name" required class="form-control" id="password">
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" required class="form-control" value="{{$userInfo->email}}" id="password">
              </div>
               <div class="form-group">
                <input type="date" name="date" required class="form-control" id="password">
              </div>
               <div class="form-group">
                <label for="username">User name</label>
                <input type="text" name="username" required class="form-control" id="username">
              </div>
               <div class="form-group ">
                <label for="password">Password</label>
                <input type="password" name="password" required class="form-control" id="password">
              </div>
              <div class="form-group  ">
                <label for="repassword">Re Password</label>
                <input type="password" name="repassword" required class="form-control" id="password">
              </div>
              
              <div class="form-group  ">
                <label for="address">Address</label>
                <input type="text" name="address" required class="form-control" id="password">
              </div>
              <div class="form-group last  mb-3">
                <input type="radio" name="sex" checked value="0" >&nbsp;Nam &nbsp;&nbsp;
                <input type="radio" name="sex" value="1" >&nbsp;Nữ
              </div>


              <input type="submit" value="Register" class="btn btn-block btn-primary">
            
            </form>
              <span class="d-block text-center my-4 text-muted">&mdash; or &mdash;</span>
              <div class="row" style="color: white; ">
                   <a href="{{URL::to('/google')}}" style="text-decoration: none;" class="btn btn-outline-danger btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Register with <strong>Google</strong>
                                        </a>
                                        <a href="{{URL::to('/facebook')}}" style="text-decoration: none; "  class="btn btn-outline-primary btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Register with <strong>Facebook</strong>
                                        </a>
              </div>
                  <span class="d-block text-center my-4 text-muted"><a href="{{URL::to('/')}}">Back to Home page</a>&nbsp;/&nbsp;<a href="{{URL::to('login')}}">Have An Account <strong>Login</strong>?</a></span>
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