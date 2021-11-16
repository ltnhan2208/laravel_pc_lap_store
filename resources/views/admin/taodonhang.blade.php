@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
	        <div class="container-fluid">
	        	<br/>
	        	<h3 class="text-info text-left"><b>Tạo đơn hàng</b></h3>
					 <hr/>
	        	<br/>
	        	<div class="row justify-content-around">
					<form class="col-lg-6">
					<div class="row justify-content-around">
				    <label class="form-label">Số điện thoại:</label>&emsp;
				    <input onblur="onSDT()" style="width: 200px" id="sdt" name="khSdt" type="number" class="form-control" id="adSdt" value="{{old('khSdt')}}">
				      &emsp;<button id="findPhoneNum" style="height: 38px" type="button" class="btn btn-secondary"> <i class="fas fa-search"></i> Tìm</button>
				      <br/>
				      <div class="col-lg-3">
				      <span style="color:red">{{$errors->first('khSdt')}}</span>
				      <span id="sdt__err--regis" style="color: red"></span>
				  	</div>
				  	</div>
				     </form>
				 </div>
				    
				  </div>
				<div class="col-lg-12">
				<form class="col-lg-12" action="{{URL::to('addDonhang')}}" method="POST"  enctype="multipart/form-data">
					 {{ csrf_field() }}
					  <br/>&emsp;
					<div class="row justify-content-around">
					    <div id="userinfo" class="info__mid col-lg-4" style="display: none;">
					     	<h5>Thông tin khách hàng</h5>
					     	 <input id="khMa" type="text" style="opacity: 0%;" readonly class="form-control" name="khMa">
								<label id="lbMa" class="form-label"></label><br/>
							    <label id="lbTen"></label><br/>
							    <label><b>Địa chỉ giao hàng:</b></label>
							    <input id="khDiachi" type="text" class="form-control" name="khDiachi">
							    <label><b>Số điện thoại người nhận:</b></label>
							    <input id="khSdt" type="text"  class="form-control" name="khSdt">
							     <input id="khTen" type="text" style="opacity: 0%;" readonly="" class="form-control" name="khTen" >
							   	<div>
									<label>Đơn hàng bổ sung</label>
									<input id="dhbosung" type="checkbox" name="dhbosung" value="1">

									<div id="dh" style="display: none;">
									<div id="search-select" class="ui fluid search selection dropdown">
										<input type="hidden" name="dh">
										<i class="dropdown icon"></i>
										<div class="default text">Chọn 1 mã đơn hàng cần bổ sung</div>
									  	<div class="menu">
									  		@foreach($dh as $item)
											<div class="item" data-value="{{$item->hdMa}}"><i class="file alternate"></i>{{$item->hdMa}}</div>
											@endforeach
										</div>
									</div>
									</div>
								</div>
						</div>
						

					</div>
					<br/>
				<div id="tableproduct" class="form-group" style="display: none;">
					<div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                	<legend>Chọn sản phẩm</legend>
                                    <thead>
                                        <tr>
                                        	<th></th>
                                            <th>Mã sản phẩm</th>
                                            <th>Hình</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Loại sản phẩm</th>
                                            <th>Nhà cung cấp</th>
                                            <th>Thương hiệu</th>
                                            <th>Đơn giá</th>
                                    		<th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($product as $v)
                                        <tr>
                                        	<td>
                                        		<div >
													<input type="checkbox" 
													@if($v->khoSoluong<1) disabled @endif
													 name="checkboxsp[]"  value="{{$v->spMa}}">
												</div>
											</td>
                                          	<td>{{$v->spMa}}</td>
                                          	<td>
											<img style="height:55px;width: 55px;" src="{{URL::asset('public/images/products/'.$v->spHinh)}}" alt="" class="pro-image-front">
								
                                            </td>
                                            <td>{{$v->spTen}}</td>
                                             <td>{{$v->loaiTen}}</td>
                                          	<td>
                                          	{{$v->nccTen}}
                                          	</td>
                                          	<td>{{$v->thTen}}</td>
                                          	<td>{{number_format($v->spGia)}} VND</td>
                                          	<td>
                                          		@if($v->khoSoluong>1) <input type="number" style="text-align: center" name="spSl{{$v->spMa}}" max="{{$v->khoSoluong}}" class="form-control" > @endif
                                          		Trong kho còn: {{$v->khoSoluong}} Sản phẩm.<br>	
                                          	</td>
                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                                <span style="color: red">{{$errors->first('checkboxsp')}}</span>
                            </div>
                            <br/>
                            <div class="row justify-content-around">
					<button class="btn btn-dark" type="button" onclick="back()">Trở về</button>
				 
				  <button id="btn__register" class="btn btn-primary" type="submit" name="btn_khd" >Thực hiện</button>
					</div>
				</div>  
				
				</div>	
			</form>
			<br/>
                    
		</div>
	</div>
	</div>
	<script src="{{url('public/style_admin/js/previewImgInputFile1.js')}}"></script>
	 <script src="{{url('public/fe/js/js-validate/validate-register.js')}}"></script>


<script type="text/javascript">
if(document.getElementById("dhbosung").checked == true)
{
	document.getElementById("dh").style.display = 'block';
}

	$(document).ready(function()
	{
  		$("#dhbosung").click(function()
  		{
    	$("#dh").toggle();
    	})
  	})



  	$(document).on('click','#findPhoneNum',function(e){
			e.preventDefault();
			var phone = $('#sdt').val();
			$.ajax({
				TYPE:"GET",
				url: 'findPhoneNum/'+phone,
				dataType:'JSON',
				success:function(response)
				{
					result = response.message;
					if(result== 1)
					{
						document.getElementById('tableproduct').style.display = 'block';
						document.getElementById('userinfo').style.display = 'block';
						document.getElementById('khMa').value=response.khMa;
						document.getElementById('khTen').value=response.khTen;
						document.getElementById('lbMa').innerHTML="<b>Mã khách hàng:</b> "+response.khMa;
						document.getElementById('lbTen').innerHTML="<b>Tên khách hàng:</b> "+response.khTen;
						document.getElementById('khDiachi').value=response.khDiachi;
						document.getElementById('khSdt').value=response.khSdt;
					}
					else
					{	
						document.getElementById('tableproduct').style.display = 'none';
						document.getElementById('khMa').value="";
						document.getElementById('khTen').value="";
						document.getElementById('khDiachi').value="";
						document.getElementById('khSdt').value="";
						Swal.fire({
						  icon: 'error',
						  title: 'Thông báo: ',
						  text: 'Số điện thoại không tồn tại.',
						  footer:'<a href="{{URL::to('themkhachhang')}}"> Đăng ký </a>  khách hàng mới ? '
						});
					}
				}
			});

		})

@if(Session::has('error'))
	Swal.fire({
	icon: 'error',
	title: 'Thông báo: ',
	text: '{{Session::get('error')}}',
	});

@endif

function acceptOrder()
{
	Swal.fire(
	{
	  title: 'Xác nhận tạo đơn hàng ?',
	  text: " khỏi giỏ hàng ?",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#EC2546',
	  cancelButtonColor: '#B5B5B5',
	  confirmButtonText: 'OK'
	}).then((result) => {
  if (result.isConfirmed) 
  {
    Swal.fire(
      'Deleted!',
      'Đã xóa sản phẩm khỏi giỏ hàng !',
      'success'
    )
    //document.location.href="{{URL::to('remove-item/')}}";
  }
})
}
$('#search-select')
  .dropdown()
;
</script>
@endsection
	