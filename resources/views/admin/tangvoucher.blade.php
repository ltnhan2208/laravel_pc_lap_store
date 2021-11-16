@extends('admin.layout')
@section('content')
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card-header py-3">
                        <h2 class="m-0 font-weight-bold text-primary text-center">Tặng voucher</h2>
                    </div>
                    <div class="container form-group">
                        <form action="{{URL::to('tangvoucher')}}" method="post">
                            {{csrf_field()}}
                            <div class="table-responsive">
                                <h3>Chọn khách hàng được hưởng voucher</h3>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                            <tr>
                                                <th></th>
                                                <th>Mã khách hàng</th>
                                                <th>Tên khách hàng</th>
                                                <th>SDT</th>
                                                <th>Email</th>
                                                <th>Tổng đơn hàng đã đặt</th>
                                                <th>Tổng giá trị đơn hàng</th>
                                            </tr>
                                    </thead>
                                    <tbody id="tbody">
                                            @foreach($kh as $item)
                                            <tr>
                                                <td><input class="form-check-input" type="checkbox" name="kh[]" value="{{$item->khMa}}"></td>
                                                <td>{{$item->khMa}}</td>
                                                <td>{{$item->khTen}}</td>
                                                <td>{{$item->khSdt}}</td>
                                                <td>{{$item->khEmail}}</td>
                                                <td>{{$totalorder[$item->khMa]}}</td>
                                                <td>{{number_format($dh[$item->khMa])}} VND</td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <h3>Chọn voucher</h3>
                                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                            <tr>
                                                <th></th>
                                                <th>Mã</th>
                                                <th>Tên </th>
                                                <th>Số lượt</th>
                                                <th>Loại</th>
                                                <th>Mã sản phẩm</th>
                                                <th>Ngày kết thúc</th>
                                                <th>Mức giảm</th>
                                            </tr>
                                    </thead>
                                    <tbody id="tbody">
                                            @foreach($vc as $item)
                                                <tr>
                                                    <td><input class="form-check-input" type="radio" name="vc" value="{{$item->vcMa}}"></td>
                                                <td>{{$item->vcMa}}</td>
                                                <td>{{$item->vcTen}}</td>
                                                <td>@if($item->vcSoluot==0)
                                                        Hết lượt    
                                                    @elseif($item->vcSoluot==null)
                                                    
                                                    Không giới hạn số lượng
                                                    @else
                                                        {{$item->vcSoluot}}
                                                    @endif</td>
                                                <td>
                                                    @if($item->vcLoai==0)
                                                        Cho sản phẩm {{$item->spTen}}
                                                    @else
                                                        Cho đơn hàng
                                                    @endif
                                                </td>
                                                <td>@if($item->spMa != null) <a href="{{URL::to('updateSanpham/'.$item->spMa)}}" class="active tooltips" ui-toggle-class="">
                                                    {{$item->spMa}}</a> @else - @endif</td>
                                               
                                                <td>{{date_format(date_create($item->vcNgaykt),"d/m/Y H:i:s")}}</td>
                                                
                                                <td>{{number_format($item->vcMucgiam)}}  
                                                    @if($item->vcLoaigiamgia==0)
                                                        VND
                                                    @else
                                                        %
                                                    @endif</td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div><button type="submit" class="btn btn-primary">Xác nhận</button></div>
                            <div><a class="btn btn-secondary" href="{{URL::to('adVoucher')}}">Trở về</a></div>
                        </form>
                    </div>
               </div>
           </div>
       </div>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
@if(Session::has('error'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Opss... ',
  text: '{{Session::get('error')}}',
 
})
</script> 
@endif
  @endsection