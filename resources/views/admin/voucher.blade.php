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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý voucher</h3>
                            <span></span><span></span><span></span>
                              <a  href="{{URL::to('addVoucherpage')}}" class="btn btn-primary">
                                       
                                        <span class="text"><b>+&nbsp;Thêm voucher</b></span>
                                    </a>
                                     <a href="{{URL::to('tangvoucherview')}}" class="btn btn-primary "><i class="fas fa-gift"></i> <b>Tặng voucher</b></a>
                        </div>
                      

                        <br/>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã</th>
                                            <th>Tên </th>
                                            <th>Số lượt</th>
                                            <th>Loại</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Loại giảm giá</th>
                                          
                                       {{--       <th>Giá trị giảm tối đa</th>
                                            <th>Điều kiện áp dụng</th>
                                            <th>Giá trị áp dụng</th>  --}}
                                            <th>Ẩn/hiện</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                      
                                        @foreach($vc as $value)
                                        <tr>
                                            <td>{{$value->vcMa}}</td>
                                            <td>{{$value->vcTen}}</td>
                                            <td>@if($value->vcSoluot==0)
                                                    Hết lượt    
                                                @elseif($value->vcSoluot==null)
                                                
                                                Không giới hạn số lượng
                                                @else
                                                    {{$value->vcSoluot}}
                                                @endif</td>
                                            <td>
                                                @if($value->vcLoai==0)
                                                    Cho sản phẩm {{$value->spTen}}
                                                @else
                                                    Cho đơn hàng
                                                @endif
                                            </td>
                                            <td>{{date_format(date_create($value->vcNgaybd),"d/m/Y H:i:s")}}</td>
                                            <td>{{date_format(date_create($value->vcNgaykt),"d/m/Y H:i:s")}}</td>
                                            <td>
                                                @if($value->vcLoaigiamgia==0)
                                                    Theo giá
                                                @else
                                                    Theo % giá
                                                @endif
                                            </td>
                                            
                                           {{--  <td>{{$value->vcMucgiam}}  
                                                @if($value->vcLoaigiamgia==0)
                                                    VND
                                                @else
                                                    %
                                                @endif</td>
                                                <td>{{number_format($value->vcGiatritoida)}} VND</td>
                                           
                                            <td>
                                                @if($value->vcDkapdung==0)
                                                    Theo giá
                                                @else
                                                    Theo số lượng sản phẩm
                                                @endif
                                            </td>
                                            <td>
                                                @if($value->vcDkapdung==0)
                                                    @if($value->vcGtcandat==0)
                                                        Không giới hạn
                                                    @else
                                                    {{number_format($value->vcGtcandat)}} VND
                                                    @endif
                                                @else
                                                    @if($value->vcGtcandat==0)
                                                        Không giới hạn số lượng sản phẩm
                                                    @else
                                                    {{$value->vcGtcandat}} Sản phẩm
                                                    @endif
                                                @endif
                                            </td> --}}
                                            <td>
                                                <label class="switch">
                                                <a href="{{URL::to('switchStatusVc/'.$value->vcMa)}}">
                                                  <input type="checkbox" name="kmTinhtrang" value="1" 
                                                  @if($value->vcTinhtrang!=0) checked="" @endif>
                                                  <span class="slider round"></span>
                                                </a>
                                                </label>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="{{URL::to('suaVoucherpage/'.$value->vcMa)}}">
                                                  <i class="fa fas fa-edit" style="color: white;"></i>
                                                </a>
                                                <a class="btn btn-danger" href="#" onclick="func{{$value->vcMa}}()">
                                                  <i class="fa fas fa-trash" style="color: white;"></i>
                                                </a>
                                            </td>
                                        </tr>

                                      @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

@if(Session::has('success'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Ok ! ',
  text: '{{Session::get('success')}}',
 
})
</script>   
@endif

@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Opss... ! ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif

@foreach($vc as $i)
<script type="text/javascript">
    function func{{$i->vcMa}}()
    {
        Swal.fire({
      title: 'Bạn có muốn xóa voucher',
      text: "{{$i->vcTen}} ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'OK !'
        }).then((result) => {
      if (result.isConfirmed) 
      {
        Swal.fire(
          'Deleted!',
          'Đã xóa !',
          'success'
        )
        document.location.href="{{URL::to('adDeleteVoucher/'.$i->vcMa)}}";
      }
    })
    }
</script>
@endforeach
  @endsection