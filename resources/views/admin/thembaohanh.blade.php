@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
             <div class="card-header py-3">
               <h3 class="text-info text-center"><br/>Thêm thông tin bảo hành</h3>    
            </div>
            <div id="content">
        <div class="container-fluid">
        	<div class="row justify-content-around">
         <div class="col-lg-2"></div>
        	<div class="col-lg-8 info__mid">
        		
        	<form class="row justify-content-around">
        		<div>
        	<label>Mã Serial sản phẩm<input class="form-control" id="serMa" type="text" name="serMa"  value="{{old('serMa')}}" maxlength="20"></label>&nbsp;
        	

        	<button id="findPhoneNum" style="height: 38px" type="button" class="btn btn-secondary"> <i class="fas fa-search"></i> Tìm</button> &nbsp; <button type="button" class="btn btn-primary" onclick="location.reload();"><i class="fas fa-sync-alt"></i> Làm mới</button>
        	</div>    
        	</form><br>
        	<form id="bhinfo" style="display: none;" class="row justify-content-around"  action="{{URL::to('thembaohanh')}}" method="POST"  enctype="multipart/form-data">
				 {{ csrf_field() }}
				 <div class="col-lg-1"></div>
				<div class="col-lg-10 info__mid text-center">

						<input id="serMa2" type="hidden" name="serMa">
						<input id="khMa" type="hidden" name="khMa">
						<label>Số điện thoại khách bảo hành</label>
						<input class="form-control" type="number" name="bhSdt">
						<br><span class="alert-danger" style="color:red">{{$errors->first('bhSdt')}}</span><br>
						<label>Nội dung bảo hành</label><textarea class="form-control" type="text" name="bhNoidung" height="100"></textarea><br><span class="alert-danger" style="color:red">{{$errors->first('bhNoidung')}}</span>
					<div class="row justify-content-around">
						<a class="btn btn-secondary" href="{{URL::to('adBaohanh')}}">Trở về</a>
						<button id="btn__register" class="btn btn-primary" type="submit" name="btn_khd" >Thực hiện</button>
					</div>

				</div>
				
			  <div class="col-lg-1"></div>
			</form>
				<br>
				<hr>
        	<div id="bhtable"   style="display: none;"  class="table-responsive">
        		<h3>Lịch sửa bảo hành</h3>
        		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
	                    <tr>
		                    <th>Mã bảo hành</th>
		                    <th>Ngày bảo hành</th>
		                    <th>Nội dung bảo hành</th>
		                    <th>Số điện thoại khách</th>
	                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        	<br>
			
			<br/>
              
		</div>
		 <div class="col-lg-2"></div>
		</div>
		</div>
	</div>
	</div>
<script type="text/javascript">
	$('#serMa').focus();
		$(document).on('click','#findPhoneNum',function(e){
			e.preventDefault();
			var serMa = $('#serMa').val();
			$.ajax({
				TYPE:"GET",
				url: 'findproductSerial/'+serMa,
				dataType:'JSON',
				success:function(response)
				{
					result = response.message;
					tablearray=response.bhlog;
					info = response.productinfo;
					if(result == 1)
					{
						$("#bhtable").show();
						$("#bhinfo").show();

						for(j=0 ; j < info.length ; j++)
						{
							$('#khMa').val(info[j].khMa);
							$('#serMa2').val(info[j].serMa);
						}

						for(i=0 ; i < tablearray.length ; i++)
						{
							$("#dataTable  tbody").remove();
							$("#dataTable").append("<tr><td>"+tablearray[i].bhMa+"</td><td>"+tablearray[i].bhNgay+"</td><td>"+tablearray[i].bhNoidung+"</td><td>"+tablearray[i].bhSdt+"</td></tr>");
						}
						
					}
					if(result == 0)
					{	
						$('#bhinfo').show();
						Swal.fire({
						  icon: 'error',
						  title: 'Thông báo: ',
						  text: 'Sản phẩm đã hết hạn bảo hành.',
						});
					}
					if(result==2)
					{
						Swal.fire({
						  icon: 'error',
						  title: 'Thông báo: ',
						  text: 'Mã serial không tồn tại.',
						});
						setTimeout(function(){
							    window.location.reload();},2000);
						

					}
					if(result==3)
					{
						Swal.fire({
						  icon: 'error',
						  title: 'Thông báo: ',
						  text: 'Sản phẩm này chưa được bán !.',
						});
					}
				}
			});

		})
@if(Session::has('err'))
Swal.fire({
	icon: 'error',
	title: 'Thông báo: ',
	text: '{{Session::get('err')}}.',
	});
@endif

</script>

	<script src="{{url('public/style_admin/js/previewImgInputFile1.js')}}"></script>
	 <script src="{{url('public/fe/js/js-validate/validate-register.js')}}"></script>
@endsection
