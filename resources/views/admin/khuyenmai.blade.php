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
                            <h3 class="m-0 font-weight-bold text-primary text-center">Quản lý khuyến mãi</h3>
                            <span></span><span></span><span></span>
                            <a  href="{{URL::to('addKhuyenmaiPage')}}" class="btn btn-primary">
                                       
                                        <span class="text"><b>+&nbsp;Thêm chương trình</b></span>
                                    </a>
                        </div>
                        
                        <br/>
                        <div style="width: 100%;" class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" >
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); font-size: 13px;color: white;">
                                        <tr>
                                            <th>Mã</th>
                                            <th>Tên </th>
                                            <th>Mô tả</th>
                                            
                                            <th>Lần sử dụng</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Trị giá </th>
                                            <th>Tình trạng (ẩn/hiện)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->kmMa}}</td>
                                            <td>{{$value->kmTen}}</td>
                                            <td>{{$value->kmMota}}</td>
                                            {{-- <td>
                                                @if($value->kmSoluong==0)
                                                    Không giới hạn số lượng
                                                @else
                                                    {{$value->kmSoluong}}
                                                @endif
                                            </td> --}}
                                            <td>@if($value->kmGioihanmoikh==null)
                                                    Không giới hạn
                                                @else
                                                    {{$value->kmGioihanmoikh}}
                                                @endif
                                            </td>
                                            <td>{{$value->kmNgaybd}}</td>
                                            <td>{{$value->kmNgaykt}}</td>

                                            <td>{{$value->kmTrigia}} %</td>
                                            <td>
                                                <label class="switch">
                                                <a href="{{URL::to('switchStatus/'.$value->kmMa)}}">
                                                  <input type="checkbox" name="kmTinhtrang" value="1" 
                                                  @if($value->kmTinhtrang!=0) checked="" @endif>
                                                  <span class="slider round"></span>
                                                </a>
                                                </label>

                                            </td>
                                            <td>
                                                <a class="btn btn-primary"  href="{{URL::to('suaKhuyenmaipage/'.$value->kmMa)}}">
                                                    <i class="fa fas fa-edit" style="color: white;"></i>
                                                </a>
                                                <a class="btn btn-danger"  href="{{URL::to('deleteKhuyenmai/'.$value->kmMa)}}">
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
  @endsection