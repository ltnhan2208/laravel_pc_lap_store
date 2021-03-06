<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Page Admin</title>

    <!-- Custom fonts for this template-->
    <link href="{{URL::asset('public/style_admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{URL::asset('public/style_admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/style_admin/css/style.css')}}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{URL::asset('public/style_admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/style_admin/css/tooltip.css')}}">
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/style_admin/css/switchbutton.css')}}">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
 {{-- Semantic UI --}}
<link rel="stylesheet" type="text/css" href="{{URL::asset('node_modules/Semantic-UI-master/dist/semantic.min.css')}}">
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="{{URL::asset('node_modules/Semantic-UI-master/dist/semantic.min.js')}}"></script>
{{--  --}}
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" 
             @if(Auth::user()->adQuyen == 1) 
                href="{{URL::asset("admin")}}"
                @else
                href="{{URL::to('thong-tin-nhan-vien/'.Auth::user()->adMa)}}"
             @endif
            >
                <div class="sidebar-brand-icon rotate-n-15">
                    <img style="border-radius: 360px" src="{{URL::asset('public/images/nhanvien/'.Auth::user()->adHinh)}}" width="50" height="50" />
                </div>
               {{--  <div class="sidebar-brand-text mx-3">Hi {{Session::get('adTen')}}</div> --}}
                 <div class="sidebar-brand-text mx-3">Hi {{Auth::user()->adTen}}</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard --> 
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
               Danh m???c qu???n l??
            </div>
            <!-- Nav Item - Utilities Collapse Menu -->
            @if(Auth::user()->adQuyen == 1)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-user-cog" style="font-size: 18px;color:rgba(255,255,255,.8);"></i>
                    <span>Qu???n l?? ng?????i d??ng</span>
                </a>
               <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         
                        <a class="collapse-item" href="{{URL::to('/adNhanvien')}}">Qu???n l?? nh??n vi??n</a>
                        <a class="collapse-item"  href="{{URL::to('/adKhachhang')}}">Qu???n l?? kh??ch h??ng</a>
                    </div>
                </div>
            </li>
             <li class="nav-item">
                 <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-laptop" style="font-size: 18px;color:rgba(255,255,255,.8);"></i>
                    <span>Qu???n l?? d??? li???u</span>
                </a>
               <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         
                        <a class="collapse-item"  href="{{URL::to('/adSanpham')}}">Qu???n l?? s???n ph???m</a>
                        <a class="collapse-item" href="{{URL::to('/adThuonghieu')}}">Qu???n l?? th????ng hi???u</a>
                        <a class="collapse-item" href="{{URL::to('adNhacungcap')}}">Qu???n l?? nh?? cung c???p</a>
                        <a class="collapse-item" href="{{URL::to('/adLoai')}}">Qu???n l?? lo???i</a>
                        <a class="collapse-item" href="{{URL::to('/adNhucau')}}">Qu???n l?? nhu c???u</a>
                    </div>
                </div>
            </li>
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="true" aria-controls="collapseFour">
                    <i class="fas fa-tags" style="font-size: 18px;color:rgba(255,255,255,.8);transform: rotateY(180deg);"></i>
                    <span>Qu???n l?? ??u ????i</span>
                </a>
               <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         
                         <a class="collapse-item" href="{{URL::to('/adKhuyenmai')}}">Qu???n l?? khuy???n m??i</a>
                         <a class="collapse-item" href="{{URL::to('adVoucher')}}">Qu???n l?? voucher</a>
                    </div>
                </div>
            </li>
              <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUti"
                    aria-expanded="true" aria-controls="collapseUti">
                 <i class="fas fa-window-maximize" style="font-size: 18px;color:rgba(255,255,255,.8);"></i>
                    <span>Qu???n l?? Website</span>
                </a>
                <div id="collapseUti" class="collapse" aria-labelledby="headingUti"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         
                         <a class="collapse-item"  href="{{URL::to('tin-tuc')}}">Tin t???c</a>
                        
                        <a class="collapse-item"  href="{{URL::to('adBanner/'."1"."/"."1")}}">Banner</a>
                    </div>
                </div>
            </li>
            @endif
            @if(Auth::user()->adQuyen != 1)
                 <li class="nav-item">
               <a href="{{URL::to('thong-tin-nhan-vien/'.Auth::user()->adMa)}}" class="nav-link collapsed">
                 <i class="fas fa-window-maximize" style="font-size: 18px;color:rgba(255,255,255,.8);"></i>
                    <span>Th??ng tin c?? nh??n</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->adQuyen != 4 && Auth::user()->adQuyen != 3)    
                  
            </li>
             <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBC"
                    aria-expanded="true" aria-controls="collapseBC">
                    <i class="fas fa-warehouse" style="font-size: 18px;color:rgba(255,255,255,.8);"></i>
                    <span>Qu???n l?? b??o c??o</span>
                </a>
                <div id="collapseBC" class="collapse" aria-labelledby="headingBC"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a href="{{URL::to('adBaocao')}}" class="collapse-item">
                        B??o c??o t???ng th???
                        </a>
                        <a href="{{URL::to('bcChi')}}" class="collapse-item">
                        B??o c??o chi
                        </a>
                        <a href="{{URL::to('bcThu')}}" class="collapse-item">
                        B??o c??o thu
                        </a>
                    </div>
                </div>
                </li>
                @endif
          @if(Auth::user()->adQuyen != 3 && Auth::user()->adQuyen != 4)
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                    aria-expanded="true" aria-controls="collapseFive">
                    <i class="fas fa-warehouse" style="font-size: 18px;color:rgba(255,255,255,.8);"></i>
                    <span>Qu???n l?? kho</span>
                </a>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"  href="{{URL::to('/adKho')}}">Qu???n l?? kho</a>
                        <a class="collapse-item"  href="{{URL::to('/adKhohong')}}">Qu???n l?? kho h???ng</a>
                        <a class="collapse-item"  href="{{URL::to('quan-ly-phieu-nhap')}}">Qu???n l?? phi???u nh???p</a>
                        
                    </div>
                </div>
            </li>
            @endif
            @if(Auth::user()->adQuyen != 4)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                   <i class="fas fa-dollar-sign" style="font-size: 18px;color:rgba(255,255,255,.8);"></i>
                    <span>Qu???n l?? doanh thu</span>
                </a>
               <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         
                         <a class="collapse-item" href="{{URL::to('taodonhangview')}}">T???o ????n h??ng</a>
                        <a class="collapse-item" href="{{URL::to('don-hang')}}">Qu???n l?? ????n h??ng</a>
                         <a class="collapse-item" href="{{URL::to('quan-ly-giao-hang/'."0")}}">Qu???n l?? giao h??ng</a>
                          <a class="collapse-item" href="{{URL::to('ptthanhtoanpage')}}">Ph????ng th???c thanh to??n</a>
                          {{-- <a class="collapse-item" href="{{URL::to('tach-don')}}">T??ch ????n</a> --}}
                    </div>
                </div>
                
            </li>
            @endif
             @if(Auth::user()->adQuyen == 1)
             <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                   <i class="fas fa-tasks" style="font-size: 18px;color:rgba(255,255,255,.8);"></i>
                    <span>Qu???n l?? ho???t ?????ng</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         
                       
                         <a class="collapse-item"  href="{{URL::to('/adBinhluan')}}">B??nh lu???n kh??ch h??ng&nbsp;
                        <i class="far fa-comment-alt" style="font-size: 20px;"></i></a>
                        <a class="collapse-item"  href="{{URL::to('lich-su-hoat-dong')}}">l???ch s??? ho???t ?????ng</a>
                         {{-- <a class="collapse-item"  href="{{URL::to('lich-su-giao-hang')}}">l???ch s??? giao h??ng</a> --}}
                        
                    </div>
                </div>
            </li>
            @endif
             @if(Auth::user()->adQuyen != 4)
            <li class="nav-item">
                  <li class="nav-item">
               <a href="{{URL::to('adBaohanh')}}" class="nav-link collapsed">
                 <i class="fas fa-window-maximize" style="font-size: 18px;color:rgba(255,255,255,.8);"></i>
                    <span>B???o h??nh s???n ph???m</span>
                </a>
            </li>
            @endif
             @if(Auth::user()->adQuyen == 4)
             <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                   <i class="fas fa-tasks" style="font-size: 18px;color:rgba(255,255,255,.8);"></i>
                    <span>Qu???n l?? ho???t ?????ng</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         <a class="collapse-item" href="{{URL::to('quan-ly-giao-hang/'.Auth::user()->adMa)}}">????n h??ng ???? nh???n</a>
                    </div>
                </div>
            </li>
            @endif
            <!-- Divider -->
            <hr class="sidebar-divider">

              <li class="nav-item">
                <a class="nav-link" href="{{URL::to('/adLogout')}}">
                   <i class="fas fa-sign-out-alt" style="font-size: 18px;color:rgba(255,255,255,.8);"></i>
                    <span>????ng xu???t</span></a>
            </li>

          

        </ul>
         @yield("content")
    </div>
        <!-- End of Sidebar -->


      

         <!-- Footer -->
            <footer class="sticky-footer bg-dark" style="color: white;font-weight: bold;">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Nh??n and Ngh??a's Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

   

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Bootstrap core JavaScript-->
   
    <script src="{{URL::asset('public/style_admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('public/style_admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{URL::asset('public/style_admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{URL::asset('public/style_admin/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{URL::asset('public/style_admin/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{URL::asset('public/style_admin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{URL::asset('public/js/demo/chart-pie-demo.js')}}"></script>
      <!-- Page level plugins -->
    <script src="{{URL::asset('public/style_admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('public/style_admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{URL::asset('public/style_admin/js/demo/datatables-demo.js')}}"></script>
 <!--jquery datepicker-->
   
    <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.4/themes/dot-luv/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

   <script src="{{URL::asset("public/style_admin/js/js.js")}}"></script>
   <script src="{{URL::asset("public/style_admin/js/js2.js")}}"></script>
   <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
   
  
   @if(Session::has('note_err'))
     <script type="text/javascript">
    Swal.fire({
      icon: 'error',
      text: '{{Session::get('note_err')}}!',
    });
    {{Session::forget('note_err')}}
    </script> 
   @endif
      @if(Session::has('note_succ'))
     <script type="text/javascript">
    Swal.fire({
      icon: 'success',
      text: '{{Session::get('note_succ')}}!',
    });
    {{Session::forget('note_succ')}}
    </script> 
   @endif

<!--Alert Date-->
 <script type="text/javascript">
     $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
 </script>
</body>

</html>