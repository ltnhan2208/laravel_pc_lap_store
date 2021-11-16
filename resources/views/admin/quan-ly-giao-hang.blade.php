@extends('admin.layout')
@section('content')
<div class="d-flex flex-column" id="content-wrapper">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow row">
                <div class="card-header row justify-content-around">
                    <h3 class="m-0 font-weight-bold text-primary text-center">
                        Quản lý giao hàng
                    </h3>
                    <span></span> <span></span> <span></span>
                </div>
                <!---------->
                <br/>
                <div>
                     @if(Auth::user()->adQuyen != 4)
                        <span>
                            Nhân viên giao hàng:
                        </span>
                        <select class="btn btn-outline-info" id="adMa" name="adMa">
                            @foreach($nv as $nv)
			         @if($default==1 && $nv->adMa == $nvdefault->adMa)
                            <option selected="" value="{{$nv->adMa}}">
                                {{$nv->adTen}}
                            </option>
                            @else
                            <option value="{{$nv->adMa}}">
                                {{$nv->adTen}}
                            </option>
                            @endif
			         @endforeach
                        </select>
                         @endif
                        &emsp;
                        <select id="hdTinhtrang" class="btn btn-outline-info">
                        	<option value="1">Đang được giao</option>
                        	<option value="2">Đã hoàn thành</option>
                        </select>
                        &emsp; 
                        @if(Auth::user()->adQuyen == 4)
                        @if($note >= 1)
                            <span>Bạn có {{$note}} đơn hàng chưa giao</span>
                        @else
                            <span>Bạn chưa có đơn hàng mới</span>
                        @endif
                        @endif
                </div>
               
                <div id="don__danggiao" class="table-responsive">
                    <br/>
                    <table cellspacing="0" class="table table-bordered" id="dataTable4" width="100%">
                        <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                            <tr>
                                <th>
                                    Mã đơn
                                </th>
                                <th>
                                    Nhân viên giao
                                </th>
                                <th>
                                    Ngày tạo
                                </th>
                                <th>
                                    Tình trạng
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tfoot style="display:none;">
                            <tr>
                                <th>
                                    Mã đơn
                                </th>
                                <th>
                                    Nhân viên giao
                                </th>
                                <th>
                                    Ngày tạo
                                </th>
                                <th>
                                    Tình trạng
                                </th>
                                <th>
                                </th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>
                                    {{$value->hdMa}}
                                </td>
                                <td>
                                   
                                	@if($nvName==null)
                                    	{{$value->adTen}}
                                    @else
                                    	{{$nvName->adTen}}
                                    @endif
                                </td>
                                <td>
                                    {{$value->hdNgaytao}}
                                </td>
                                <td>
                                    @if($value->hdTinhtrang==1)
                                            	Đang giao

                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{URL::to('chi-tiet-phieu-thu/'.$value->hdMa)}}">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!----------->
                  <div id="don__dagiao" class="table-responsive">
                    <br/>
                    <table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">
                        <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                            <tr>
                                <th>
                                    Mã đơn
                                </th>
                                <th>
                                    Nhân viên giao
                                </th>
                                <th>
                                    Ngày tạo
                                </th>
                                <th>
                                    Tình trạng
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tfoot style="display:none;">
                            <tr>
                                <th>
                                    Mã đơn
                                </th>
                                <th>
                                    Nhân viên giao
                                </th>
                                <th>
                                    Ngày tạo
                                </th>
                                <th>
                                    Tình trạng
                                </th>
                                <th>
                                </th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($data2 as $v)
                            <tr>
                                <td>
                                    {{$v->hdMa}}
                                </td>
                                <td>
                                	@if($nvName==null)
                                    	{{$v->adTen}}
                                    @else
                                    	{{$nvName->adTen}}
                                    @endif
                                </td>
                                <td>
                                    {{$v->hdNgaytao}}
                                </td>
                                <td>
                                    @if($v->hdTinhtrang==2)
                                            Đã hoàn thành
                                            	@endif
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{URL::to('chi-tiet-phieu-thu/'.$v->hdMa)}}">
                                        Chi tiết
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
</div>
<script src="{{URL::asset("public/style_admin/js/quanlygiaohang.js")}}"></script>
@endsection
