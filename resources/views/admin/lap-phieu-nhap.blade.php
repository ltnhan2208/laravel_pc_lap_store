@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">
 <!-- Main Content -->
       <div id="content">
        	 <div class="container-fluid">
        	 	<div class="card-header row justify-content-around">
        	 		<h3 class="m-0 font-weight-bold text-primary">Lập phiếu nhập</h3>
        	 		<span></span><span></span><span></span>
        	 	</div>
			<form class="col-lg-12" action="{{URL::to('addPhieuNhap')}}" method="POST"  >
				 {{ csrf_field()}}
				  <div class="card-body">
				 		<table border="0" style="width: 100%;">
				 			<thead style="border: 0;">
				 				<tr>
				 					<td>Sản phẩm</td>
				 					<td>Nhà cung cấp</td>
				 					<td>Serial</td>
				 					<td>Giá sản phẩm</td>
				 					<td>Giá thuế %</td>
				 					<td></td>
				 					<td></td>
				 				</tr>
				 				</thead>
				 				<tbody>
				 				<tr>
				 					<td>
				 						<select id="spMa">
				 							@foreach($sanpham as $sp)
				 							<option class="opSP" value="{{$sp->spMa}}">{{$sp->spTen}}
				 							</option>
				 							@endforeach
				 						</select>
				 					</td>
				 					<td>
				 						<select id="nccMa">
				 							@foreach($nhacungcap as $ncc)
				 							<option class="opNCC" value="{{$ncc->nccMa}}">{{$ncc->nccTen}}</option>
				 							@endforeach
				 						</select>
				 					</td>
				 					<td>
				 						{{-- <input id="soluong" type="number" /> --}}
				 						<input id="serial" type="text" />
				 					</td>
				 					<td>
				 						<input id="gia" type="number" />
				 						
				 					</td>
				 						<td>
				 						<input id="giaThue" type="number" />
				 						
				 					</td>
				 					<td>
				 						<button onclick="addRow()" id="btn__phieunhap" class="btn btn-primary" type="button">Thêm sản phẩm</button>
				 					</td>
				 				</tr>
				 				<tr>
				 					<td style="height: 20px;"></td>
				 				</tr>
				 				</tbody>
				 				<tfoot style="height: 20px">
				 					<td></td>
				 					<td></td>
				 					<td><span id="err__ser"></span></td>
				 					<td><span id="err__gia"></span></td>
				 					<td><span id="err__thue"></span></td>
				 					<td></td>
				 					<td></td>
				 				</tfoot>
				 		</table>
				 		<hr/>
				 		<h4>Sản phẩm đã chọn</h4>
				 		<br/>
				 		<table id="table__result" style="width: 100%;background: white;">
				 			<thead id="thead__phieunhap">
				 				<tr>
				 					<td>Sản phẩm</td>
				 					<td>Nhà cung cấp</td>
				 					<td>Mã serial</td>
				 					<td>Giá sản phẩm</td>
				 					<td></td>
				 					{{-- <td>Tổng giá</td> --}}
				 				</tr>
				 				</thead>
				 			<tbody style="border: 0;" id="tbody__phieunhap">
				 			</tbody>
				 			<tr>
				 				<td colspan="4"></td>
				 			</tr>
				 			<tr>
				 				<td class="label__total" colspan="4" style="text-align: right;">Tổng số lượng:</td>
				 				<td colspan="1">
				 					<input id="row__soluong"  class="input__phieunhap" style="display: none;width: 100%;text-align: right;" name="tongsl" type="text">
				 				</td>
				 			</tr>
				 			<tr>
				 					<td class="label__total" colspan="4" style="text-align: right;">Tổng chi phí:</td>
				 				<td colspan="1" style="text-align: right;">
				 					<input id="row__tongtien" class="input__phieunhap" style="display: none;width: 100%;text-align: right;" name="tonggia" type="text">
				 				</td>
				 			</tr>
				 		</table>
				 		<br/>
				
					 	<div>
						  <button class="btn btn-primary" type="submit">Thực hiện</button>
						</div>
			</form>
      </div>              
		</div>
	</div>
</div>



 <script src="{{URL::asset("public/style_admin/js/phieunhap.js")}}"></script>

@if(Session::has('err'))
<script type="text/javascript">
Swal.fire({
  icon: 'error',
  title: 'Opss... ',
  text: '{{Session::get('err')}}',
});
</script>

@endif
@endsection
