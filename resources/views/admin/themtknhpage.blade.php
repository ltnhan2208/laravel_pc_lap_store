@extends('admin.layout')
@section('content')
<div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
    <div id="content">
                <!-- Begin Page Content -->
        <div class="container-fluid">
                    <!-- DataTales Example -->
            <div class="card shadow row">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary text-center"><i style="color: green;" class="fas fa-university"></i> Thêm tài khoản ngân hàng </h2>
                </div>
            </div>
               
            <div class=" col-lg-12 row form-group">
                <form class="form-inline" action="{{URL::to('themtk')}}" method="post">
                    {{csrf_field()}}
                    <div class="input-group col-3 mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div style="background-color: #4B70DD; color: white;" class="input-group-text">số tài khoản</div>
                        </div>
                        <input type="number" class="form-control" id="inlineFormInputGroupUsername2"   name="stk" value="{{old('stk')}}">
                    </div>

                    <div class="input-group col-3 mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div style="background-color: #4B70DD; color: white;" class="input-group-text">Tên chủ tài khoản</div>
                        </div>
                        <input type="text"  class="form-control" id="inlineFormInputGroupUsername2"   name="tenchuthe" value="{{old('tenchuthe')}}">
                    </div>

                    <div class="input-group col-3 mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div style="background-color: #4B70DD; color: white;" class="input-group-text">Tên ngân hàng</div>
                        </div>
                        <div id="search-select" class="ui fluid search selection dropdown">
                                        <input type="hidden" name="tennganhang">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Chọn ngân hàng</div>
                                        <div class="menu">
                                           
                                            <div class="item" data-value="NCB"> Ngan hang NCB</div>
                                            <div class="item" data-value="AGRIBANK"> Ngan hang Agribank</div>
                                            <div class="item" data-value="SCB"> Ngan hang SCB</div>
                                            <div class="item" data-value="SACOMBANK">Ngan hang SacomBank</div>
                                            <div class="item" data-value="EXIMBANK"> Ngan hang EximBank</div>
                                            <div class="item" data-value="MSBANK"> Ngan hang MSBANK</div>
                                            <div class="item" data-value="NAMABANK"> Ngan hang NamABank</div>
                                            <div class="item" data-value="VIETINBANK">Ngan hang Vietinbank</div>
                                            <div class="item" data-value="VIETCOMBANK"> Ngan hang VCB</div>
                                            <div class="item" data-value="HDBANK">Ngan hang HDBank</div>
                                            <div class="item" data-value="DONGABANK"> Ngan hang Dong A</div>
                                            <div class="item" data-value="TPBANK"> Ngân hàng TPBank</div>
                                            <div class="item" data-value="OJB"> Ngân hàng OceanBank</div>
                                            <div class="item" data-value="BIDV"> Ngân hàng BIDV</div>
                                            <div class="item" data-value="TECHCOMBANK"> Ngân hàng Techcombank</div>
                                            <div class="item" data-value="VPBANK"> Ngan hang VPBank</div>
                                            <div class="item" data-value="MBBANK"> Ngan hang MBBank</div>
                                            <div  class="item"data-value="ACB"> Ngan hang ACB</div>
                                            <div  class="item"data-value="OCB"> Ngan hang OCB</div>
                                            <div  class="item"data-value="IVB"> Ngan hang IVB</div>
                                            
                                        </div>
                         </div>
                    </div>

               
                    <div class="input-group col-3  mb-2 mr-sm-2">
                    </div>
                    <div class="input-group col-3  mb-2 mr-sm-2">
                    </div>
                    <div class="input-group col-3  mb-2 mr-sm-2">
                       <button class="btn btn-primary" type="submit">Thêm</button>
                    </div>
                </form>
            </div>
<a href="{{URL::to('ptthanhtoanpage')}}" class="btn btn-secondary">Trở về</a>

        </div>
    </div>
</div>
<script type="text/javascript">
    $('#search-select')
  .dropdown()
;
</script>
@if(Session::has('success'))
<script type="text/javascript">
     Swal.fire({
                  icon: 'success',
                  title: 'Thông báo: ',
                  text: '{{Session::get('success')}}',
                });
</script>
@endif
@if(Session::has('error'))
<script type="text/javascript">
     Swal.fire({
                  icon: 'error',
                  title: 'Thông báo: ',
                  text: '{{Session::get('error')}}',
                });
</script>
@endif
  @endsection