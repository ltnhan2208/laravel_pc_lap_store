@extends('admin.layout')
@section('content')
<div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
    <div id="content">
                <!-- Begin Page Content -->
        <div class="container-fluid">
                    <!-- DataTales Example -->
            <div class="card shadow row">
                <div class="card-header row justify-content-around">
                    <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý phương thức thanh toán</h3>
                    <span></span> <span></span> <span></span>
                </div>
            </div>
                <h2><img style="width: 30px;" src="{{URL::asset('public/images/paymentlogo/momo.svg')}}"> Thanh toán qua momo </h2><br>
            <div class=" col-lg-12 row form-group">
                <form class="form-inline" action="{{URL::to('updatepayment')}}" method="post">
                    {{csrf_field()}}
                    <div class="input-group col-3 mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div style="background-color: #4B70DD; color: white;" class="input-group-text">Mã</div>
                        </div>
                        <input type="text" readonly="" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Mã phương thức" name="pmIdmomo" value="{{$momo->pmId}}">
                    </div>

                    <div class="input-group col-3  mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div style="background-color: #4B70DD; color: white;" class="input-group-text">Tên phương thức</div>
                        </div>
                        <input type="text" required="" class="form-control" id="inlineFormInputGroupUsername2" name="pmNamemomo" value="{{$momo->pmName}}">
                    </div>

                    <div class="input-group col-3  mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div style="background-color: #4B70DD; color: white;" class="input-group-text">Endpoint</div>
                        </div>
                        <input type="text" required=""  class="form-control" id="inlineFormInputGroupUsername2" name="endpointmomo" value="{{$momo->endpoint}}">
                    </div>

                    <div class="input-group col-3  mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div style="background-color: #4B70DD; color: white;" class="input-group-text">PartnerCode</div>
                        </div>
                        <input type="text" required=""  class="form-control" id="inlineFormInputGroupUsername2" name="partnerCodemomo" value="{{$momo->partnerCode}}">
                    </div>

                    <div class="input-group col-3  mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div style="background-color: #4B70DD; color: white;" class="input-group-text">AccessKey</div>
                        </div>
                        <input type="text" required=""  class="form-control" id="inlineFormInputGroupUsername2" name="accessKeymomo" value="{{$momo->accessKey}}">
                    </div>

                    <div class="input-group col-3  mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div style="background-color: #4B70DD; color: white;" class="input-group-text">Serectkey</div>
                        </div>
                        <input type="text" required=""  class="form-control" id="inlineFormInputGroupUsername2" name="secrectKeymomo" value="{{$momo->serectkey}}">
                    </div>

                    <div class="input-group col-3  mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div style="background-color: #4B70DD; color: white;" class="input-group-text">Tên doanh nghiệp</div>
                        </div>
                        <input type="text" required=""  class="form-control" id="inlineFormInputGroupUsername2" name="extraDatamomo" value="{{$momo->extraData}}">
                    </div>
                    <div class="input-group col-3  mb-2 mr-sm-2">
                        <label class="switch">
                                                <a href="{{URL::to('changePaymentStatus/'.$momo->pmId)}}">
                                                  <input type="checkbox" name="kmTinhtrang" value="1" 
                                                  @if($momo->pmStatus ==0) checked="" @endif>
                                                  <span class="slider round"></span>
                                                </a>
                                                </label>
                    </div>
                    <div class="input-group col-3  mb-2 mr-sm-2">
                    </div>
                    <div class="input-group col-3  mb-2 mr-sm-2">
                    </div>
                    <div class="input-group col-3  mb-2 mr-sm-2">
                       <button class="btn btn-primary" type="submit">Cập nhật</button>
                    </div>
                </form>
            </div>

            <h2><i style="color: green;" class="fas fa-university"></i> Tài khoản ngân hàng </h2><br>
                <a href="{{URL::to('themtknh')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm</a><br><br>
            <div class=" col-lg-12 row form-group">
                <div class="input-group">
                       <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Số tài khoản</th>
                                            <th>Tên chủ tài khoản</th>
                                            <th>Tên ngân hàng</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                       @foreach($tknganhang as $item)
                                        <tr>
                                            <td>{{$item->stk}}</td>
                                            <td>{{$item->tenchuthe}}</td>
                                            <td>{{$item->tennganhang}}</td>
                                            <td><a style="color:red" href="{{URL::to('deletetknh/'.$item->stk)}}"><i class="fas fa-trash"></i> Xóa</a></td>
                                        </tr>
                                       @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>

                </div>
            
            </div>
        </div>
    </div>
</div>
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