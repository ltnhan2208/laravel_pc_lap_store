@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">
  		 <p class="alert-success" style=" padding-top: 20px;font-size: 20px;">
        * Trị giá khuyến mãi - phần trăm số tiền trên tổng giá trị sẽ được giảm cho 1 sản phẩm <br>
        * Giá trị khuyến mãi tối đa - sẽ áp dụng khi số tiền được giảm lớn hơn giá trị này<br>
        * Giới hạn số lần khuyến mãi - số lần khách hàng được sử dụng khuyến mãi này<br>
    </p>
            <!-- Main Content -->
        <div id="content" class="container">
        	<br/>
			<form action="{{URL::to('checkSuaKhuyenmai/'.$km->kmMa)}}" method="POST"  >
				 {{ csrf_field() }}
				 <legend>Sửa chương trình</legend>
				 <div class="row">
				 	<div class="mb-4 col-4">
						<label for="mota">Tên chương trình: <input type="text"  required="" maxlength="30" minlength="5" class="form-control" name="kmTen" value="{{$km->kmTen}}"><span style="color: red;">{{$errors->first('kmTen')}}</span></label>
					</div>
				 	<div class="mb-4 col-4">
						<label for="mota">Mô tả : <textarea class="form-control" required=""   id="kmMota" name="kmMota"  placeholder="Mô tả"> {{$km->kmMota}}</textarea><span style="color: red;">{{$errors->first('kmMota')}}</span></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Trị giá khuyến mãi (%)
						<input type="number" class="form-control" min="1" style="width: 190px;"  max="100" name="kmTrigia"  required=""  value="{{$km->kmTrigia}}"><span style="color: red;">{{$errors->first('kmTrigia')}}</span></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Ngày bắt đầu
						<input type="date" class="form-control"  required="" min="1" name="kmNgaybd" value="{{date_format(date_create($km->kmNgaybd),"Y-m-d")}}"><span style="color: red;">{{$errors->first('kmNgaybd')}}</span></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Ngày kết thúc
						<input type="date" class="form-control"  required="" min="1" name="kmNgaykt" value="{{date_format(date_create($km->kmNgaykt),"Y-m-d")}}" ><span style="color: red;">{{$errors->first('kmNgaykt')}}</span></label>
					</div>
					
					<div class="mb-4 col-4">
						<label for="mota">Giá trị khuyến mãi tối đa (VND)
						<input type="number" class="form-control" min="1000" max="9999999999" value="{{$km->kmGiatritoida}}" style="width: 190px;"  name="kmGiatritoida" ><span style="color: red;">{{$errors->first('kmGiatritoida')}}</span></label>
					</div>

					<div class="mb-3 col-4">
						<label for="mota">Giới hạn số lần khuyến mãi
						<input type="number" title="Số lần được dùng khuyến mãi này của mỗi khách hàng ( để trống là không giới hạn)"class="form-control" max="9999999999" style="width: 190px;" value="{{$km->kmGioihanmoikh}}"  name="kmGioihanmoikh" ><span style="color: red;"></span></label>
					</div>
					<div class="mb-3 col-4">
						<label for="mota">Số lượng sản phẩm được khuyến mãi 
						<input type="number"  title="( Để trống là không giới hạn)" max="9999999999" class="form-control" min="1" name="kmSoluong" value="{{$km->kmSoluong}}" style="width: 190px;" ></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Tình trạng
							<span><label class="switch">
						  <input type="checkbox" name="kmTinhtrang" value="1"
						  @if($km->kmTinhtrang!=0)
							checked=""
							@endif >
						  <span class="slider round"></span>
						</label></span>
			</label>
					</div>
					
					<div  class="mb-3 col-12">
						<div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                	<legend>Chọn sản phẩm được khuyến mãi: </legend>
                                    <thead>
                                        <tr>
                                        		<th></th>
                                          <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Ảnh</th>
                                            <th>Giá</th>
                                            <th>Loại sản phẩm</th>
                                            <th>Nhà cung cấp</th>
                                    
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($sanpham as $v)
                                        <tr>
                                        	<td>
                                        		<div >
													<input type="checkbox" name="checkboxsp[]"
													@if($v->kmMa==$km->kmMa)
													checked=""
													@endif   value="{{$v->spMa}}">
												</div>
											</td>
                                          <td>{{$v->spMa}}</td>
                                          <td>
                                          	<a href="{{URL::to('updateSanpham/'.$v->spMa)}}" class="active tooltips" ui-toggle-class="">
                                               {{$v->spTen}}
                                 
                                               @if($v->kmMa!=null)
                                                @if(date_create($v->kmNgaykt) < date_create())
                                                    <span style="color:red;">({{$v->kmTen}})</span>
                                                @elseif($v->kmTinhtrang == 99 )
                                                    <span style="color:red;">({{$v->kmTen}})</span>
                                                @else
                                                    <span style="color:green;">({{$v->kmTen}})</span>
                                                @endif
                                               @endif
												<span class="tooltiptexts">
													<img style="height:100px;width: 200px;" src="{{URL::asset('public/images/products/'.$v->spHinh)}}" alt="" class="pro-image-front">
												</span>
												
                                                </a>
                                            </td>
                                             <td><a href="{{URL::to('updateSanpham/'.$v->spMa)}}" class="active tooltips" ui-toggle-class=""><img style="width: auto;height: 100px;" src="{{URL::asset('public/images/products/'.$v->spHinh)}}" alt=""></td>
                                            	<td style="color: Blue;">{{number_format($v->spGia)}}đ</td>
                                                <td>{{$v->loaiTen}}</td>
                                          <td>
                                          	 <div class="tooltips">
                                          	 	<a style="text-decoration: none;" href="{{URL::to('suaNhacungcappage/'.$v->nccMa)}}">{{$v->nccTen}}
                                          	 	</a>
												<span class="tooltiptexts">
													D/c: {{$v->nccDiachi}}<br>
													Sdt: {{$v->nccSdt}}
												</span>
											</div>
                                          </td>
                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                                <span style="color: red">{{$errors->first('checkboxsp')}}</span>

                            </div>
					</div>
					 	<div class="mb-3 col-6">
					 		<a class="btn btn-secondary" href="{{url('adKhuyenmai')}}">Trở về</a>
						  <button class="btn btn-primary" type="submit" name="btn_add">Thực hiện</button>
						</div>
					 </div>
			</form>
		</div>
	</div>
	<div>
   
    </div>
@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Opss... ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif

@endsection

