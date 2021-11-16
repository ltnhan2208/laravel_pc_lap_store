@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column justify-content-center">
						<div class="card-header py-3">
                            <h2 class="m-0 font-weight-bold text-primary text-center">Thêm sản phẩm</h2>
                          
                        </div>
                        <br/>
            <!-- Main Content -->
        <div id="content">
			<form class="row justify-content-around" action="{{URL::to('/checkAddSanpham')}}" method="POST" enctype="multipart/form-data">
				 {{ csrf_field() }}
				
			<!--field flex form-->
			<div class="col-lg-3 info__left">
				<br/>
				<h5 class="text-dark">TỔNG QUAN</h5>
				<div class="form-group">
			  
			    <label for="exampleInputPassword1" class="form-label">Tên sản phẩm:</label>
			    <input name="spTen" type="text" class="form-control" id="spTen">
			    <span style="color:red">{{$errors->first('spTen')}}</span>
			    <span style="color:red">
			    	@if(Session::has('sp_err'))
			    	{{Session::get('sp_err')}}
			    	@endif
			    </span>
			</div>
				<!--field flex form-->
				<div class="form-group">
					 <label for="exampleInputPassword1" class="form-label">Thương hiệu</label>
					  <select style="width: 205px" class="form-control m-bot15" name="thMa">
		                            @foreach($thMa as $key => $value)
		                                <option value="{{$thMa[$key]->thMa}}" >{{$thMa[$key]->thTen}}</option>
		                            @endforeach
		               </select>
		        
		           </div>

		           	<div class="form-group">    
		            
					 <label for="exampleInputPassword1" class="form-label">Nhu cầu sử dụng</label>
		                <select style="width: 205px" class="form-control m-bot15" name="ncMa">
		                            @foreach($ncMa as $key => $value)
		                                <option value="{{$ncMa[$key]->ncMa}}" >{{$ncMa[$key]->ncTen}}</option>
		                            @endforeach
		               </select>
		          
		       </div>
		       <div class="form-group">
		       	
					 <label for="exampleInputPassword1" class="form-label">Nhà cung cấp</label>
		                <select style="width: 205px" class="form-control m-bot15" name="nccMa">
		                            @foreach($nccMa as $v)
		                                <option value="{{$v->nccMa}}" >{{$v->nccTen}}</option>
		                            @endforeach
		               </select>
		        <br/>
				    <label for="exampleInputPassword1" class="form-label">Hạn bảo hành:</label><br/>
				    <input name="spHanbh" type="radio" value="6" id="spHanbh"/> 6 tháng <br/>
				    <input name="spHanbh" type="radio" value="12"id="spHanbh"/> 12 tháng <br/>
				    <input name="spHanbh" type="radio" value="24"  id="spHanbh"/> 24 tháng <br/>
				    <br/>
				    <span style="color:red">{{$errors->first('spHanbh')}}</span>
           		</div>
           		  <div class="form-group">
			  	 <a href="{{URL::to("adSanpham")}}" class="btn btn-info" type="button">Trở về</a>
			  	 &emsp; &emsp; &emsp;&emsp;&nbsp;
			  	<button type="submit" name="btn_khd" class="btn btn-primary">Thực hiện</button>
			  </div>
           	</div>

				<div class="col-lg-3 info__mid">
				<br/>
				<h5 class="text-dark">CHI TIẾT</h5>
			    <div class="form-group">
				    <label for="exampleInputPassword1" class="form-label">Loại</label>
		                <select onchange="change()" id="select__loai" style="width: 205px" class="form-control m-bot15" name="loaiMa">
		                            @foreach($loaiMa as $key => $value)
		                                <option value="{{$loaiMa[$key]->loaiMa}}" >{{$loaiMa[$key]->loaiTen}}</option>
		                            @endforeach
		               </select>
		              <br/>
				    <label for="exampleInputPassword1" class="form-label">Ram</label>
				    <input name="ram" type="text" class="form-control">
				   <br/>
				    <label for="exampleInputPassword1" class="form-label">CPU</label>
				    <input name="cpu" type="text" class="form-control" >
				    <br/>
				    <label for="exampleInputPassword1" class="form-label">Ổ cứng</label>
				    <input name="ocung" type="text" class="form-control" >
				  
				
				</div>
				<!--mota__lap-->
				<div id="mota__lap">
					<div class="form-group">
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Màn hình</label>
					    <input name="manhinh" type="text" class="form-control">
					    </div>
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Cổng giao tiếp</label>
					    <input name="conggiaotiep" type="text" class="form-control" >
					    </div>
					</div>
					<div class="form-group">
					     <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Trọng lượng</label>
					    <input name="trongluong" type="text" class="form-control" >
					  	</div> 
					
				<!---->
					
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Màu</label>
					    <input name="mau" type="text" class="form-control">
					    </div>
					</div>
					 <div class="form-group">
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Loa</label>
					    <input name="loa" type="text" class="form-control" >
					    </div>
					     <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Webcam</label>
					    <input name="webcam" type="text" class="form-control" >
					  	</div>
					 </div>
					 <div class="form-group"> 
					  	<div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Tản nhiệt</label>
					    <input name="tannhiet" type="text" class="form-control" >
					  	</div> 
					
				
				<!---->
					
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">PIN</label>
					    <input name="pin" type="text" class="form-control">
					    </div>
					    </div>
					    <div class="form-group"> 
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Chuẩn wifi</label>
					    <input name="chuanwifi" type="text" class="form-control" >
					    </div>
					  	 <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Chuẩn Lan</label>
					    <input name="chuanlan" type="text" class="form-control" >
					  	</div> 
					  </div>
					  <div class="form-group"> 
					  	<div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Hệ điều hành</label>
					    <input name="hedieuhanh" type="text" class="form-control" >
					  	</div> 
					
					<!---->
						
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Chuột</label>
					    <input name="chuot" type="text" class="form-control">
					    </div>
					</div>
					    <div class="form-group justify-content-around"> 
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Bàn phím</label>
					    <input name="banphim" type="text" class="form-control" >
					    </div>
					    <div class="mb-3"> <input readonly style="border:0;outline: none;background-color: transparent;" class="form-control"></div>
					  
					</div>
				</div>
			   
				<!--end mota__lap-->
				<!--mota__pc-->
				<div id="mota__pc">
					<div class="form-group">
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Mainboard</label>
					    <input name="mainboard" type="text" class="form-control">
					    </div>
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">VGA</label>
					    <input name="vga" type="text" class="form-control" >
					    </div>
					</div>
					<div class="form-group">
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">PSU</label>
					    <input name="psu" type="text" class="form-control">
					    </div>
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">CASE</label>
					    <input name="case" type="text" class="form-control" >
					    </div>	
					</div>
				</div>
				</div>
				

           		<div class="col-lg-3 info__right">
           			<br/>
					<h5>ẢNH MẶC ĐỊNH</h5>
					<br/>
					<div class="row justify-content-around">
					<div class="col-lg-1"></div>
					<div class="col-lg-8">
				   	<div id="box__img" class="box__img">
				   		<span class="text">Chưa có ảnh</span>
				   		<img id="img" src="" alt="" />
				   	</div>
				   	<div>
				   	<span id="btnCancel"><i class="fas fa-times" style="font-size: 20px;"></i></span>
				    <input id="inputImg" name="img" type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg,image/png,image/jpg">
				   
	 				<label for="exampleInputPassword1" class="form-label"></label>
				    <label id="btnImg" class="lb__spHinh" onclick="defaultAction()"><i class="fas fa-file-upload" >&nbsp;Chọn hình ảnh</i></label>
					</div>
					</div>
					<div class="col-lg-1"></div>
					</div>
			  	</div>

				
				<!--end mota__pc-->

				<br/>
			</div>
				<br/>

			
			</form>
			<br/>

		</div>
	</div>
	<script src="{{URL::to('public/style_admin/js/previewImgInputFile3.js')}}"></script>
@endsection
 