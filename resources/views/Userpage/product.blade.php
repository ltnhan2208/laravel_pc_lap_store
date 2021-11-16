@extends('Userpage.layout')
@section('title')
Danh sách sản phẩm
@endsection
@section('content')
<!--Slide-->
<div class="container-fluid">
	<div class="row">
	@if($vt1Check != 0)
	@foreach($vt1 as $vt1)
<a href="{{url('chi-tiet-banner/'.$vt1->bnMa)}}"  class="quang__cao" style="width: 12.3%;background-image: url({{URL::asset('public/images/banners/'.$vt1->bnHinh)}});background-size: cover;"></a>
@endforeach
@endif
<div class="col-lg-9">
<div class="row">
<div class="col-lg-8" style="margin:0;padding:0;">
<div class="slider">
	<div class="slides">
		@if($vt2Check != 0)
		@foreach($vt2 as $vt2)
    <div class="slide__item">
      <img src="{{URL::asset('public/images/banners/'.$vt2->bnHinh)}}" style="width: 100%" alt="...">
    </div>
    @endforeach
    @endif  
      @if($vt2Check == 0)
      <span>Chưa có dữ liệu slides</span>
    	@endif
    </div>
   <span id="pre__slide" onclick="moveSlide(-1)"><i class="fas fa-angle-left" style="font-size: 26px;"></i></span>
   <span id="next__slide" onclick="moveSlide(1)"><i class="fas fa-angle-right" style="font-size: 26px;"></i></span>
</div>
</div>

<!--END COL 8-->
<!--COL 4-->
	
<div id="banners" class="col-lg-4">
	@if($vt3Check != 0)
	@foreach($vt3 as $vt3)
			<a href="{{url('chi-tiet-banner/'.$vt3->bnMa)}}"  class="banners__child">
				<img src="{{URL::asset('public/images/banners/'.$vt3->bnHinh)}}" />
			</a>
		@endforeach
		@endif
		@if($vt4Check != 0)
		@foreach($vt4 as $vt4)
			<a href="{{url('chi-tiet-banner/'.$vt4->bnMa)}}"  class="banners__child">
				<img src="{{URL::asset('public/images/banners/'.$vt4->bnHinh)}}" />
			</a>
			@endforeach
		@endif
</div>
<!--END COL 4-->
</div>
<!--BANNER ROW-->
<div class="row">
	@if($vt5Check != 0)
	@foreach($vt5 as $vt5)
		<div class="col-lg-4 banners__child">
				<a href="{{url('chi-tiet-banner/'.$vt5->bnMa)}}"><img  style="width:102%;" src="{{URL::asset('public/images/banners/'.$vt5->bnHinh)}}"/></a>
		</div>
		@endforeach
		@endif
		@if($vt6Check != 0)
	@foreach($vt6 as $vt6)
		<div class="col-lg-4 banners__child">
				<a href="{{url('chi-tiet-banner/'.$vt6->bnMa)}}"><img  style="width:102%;" src="{{URL::asset('public/images/banners/'.$vt6->bnHinh)}}"/></a>
		</div>
		@endforeach
		@endif
		@if($vt7Check != 0)
	@foreach($vt7 as $vt7)
		<div class="col-lg-4 banners__child">
				<a href="{{url('chi-tiet-banner/'.$vt7->bnMa)}}"><img  style="width:102%;" src="{{URL::asset('public/images/banners/'.$vt7->bnHinh)}}"/></a>
		</div>
	@endforeach
		@endif
	<div></div>
 
</div>
</div>
@if($vt8Check != 0)
	@foreach($vt8 as $vt8)
<a href="{{url('chi-tiet-banner/'.$vt8->bnMa)}}"  class="quang__cao2" style="width: 12.3%;background-image: url({{URL::asset('public/images/banners/'.$vt8->bnHinh)}});background-size: cover"></a>
	@endforeach
	@endif
<!--END-->
</div>
</div>
<hr/>
<!--END SILDE-->
<div class="container-fluid">
		<div id="left__arr"  class="col-lg-1 product__arrow">
   					<i class="fas fa-chevron-left" style="font-size: 48px;"></i>
   	</div>
   	<h3 class="title__proSale">Các sản phẩm được khuyến mãi</h3>
			<br/>
		<div class="col-lg-10">
				<div class="list__product">
				@foreach($prkm as $k => $i)	
				@php
				$today=date_create();
				@endphp
				<div class="product">
					<form>
					@if(Auth::guard('khachhang')->check())
							@if($i->khMa)
								<button type="button" title="Xóa khỏi danh mục yêu thích" id="btnheart" class="btn__heart__checked "value="{{$i->spMa}}"><i class="far fa-heart" ></i></button>
							@else
							<button type="button"  title="Thêm vào danh mục yêu thích" id="btnheart" class="btn__heart" value="{{$i->spMa}}"><i class="far fa-heart" ></i></button>	
											@endif
					@endif
					@if($i->kmMa!=null && date_create($i->kmNgaybd) <= $today && date_create($i->kmNgaykt) >= $today && $i->kmTinhtrang == 1)
					<div class="sale_tag"><i class="fas fa-tags"></i> {{$i->kmTrigia}} %</div>
					@endif
					<div class="item_info">
									<a href="{{URL::to('proinfo/'.$i->spMa)}}">Xem sản phẩm</a>
					</div>
					<input class="name" name="spMa" type="hidden" value="{{$i->spTen}}">
								<img src="{{URL::asset('public/images/products/'.$i->spHinh)}}" alt="">			
								<div class="item-info-product">
									<label><a class="item_name" href="{{URL::to('proinfo/'.$i->spMa)}}">{{$i->spTen}}</a></label>
									<br/>
									
									@if($i->kmMa!=null && date_create($i->kmNgaybd) <= $today && date_create($i->kmNgaykt) >= $today && $i->kmTinhtrang == 1)
										<span><s>{{number_format($i->spGia)}} ₫</s></span><br>
										<span class="item_price"><i class="fas fa-tags"></i> {{number_format($i->spGia-($i->spGia*$i->kmTrigia/100))}} ₫</span>
									@else
									<br/>
										<span class="item_price">{{number_format($i->spGia)}} ₫</span>
									@endif
									
									<button type="button" class="btn__addCart" value="{{$i->spMa}}">

									<i class="far fa-cart-arrow-down" style="font-size: 18px;"></i></button>		

						</div>
					</form>
					</div>
				@endforeach
			</div>
		</div>
			<div id="right__arr" class="col-lg-1 product__arrow">
   					<i class="fas fa-chevron-right" style="font-size: 48px;"></i>
   		</div>
		<!------------------------->
	</div>
		<br/><br/><br/>
<div class="container-fluid">
		<div id="left__arr2"  class="col-lg-1 product__arrow">
   					<i class="fas fa-chevron-left" style="font-size: 48px;"></i>
   	</div>
   	<h3 class="title__proSale">Các sản phẩm được mua nhiều</h3>
		<div class="col-lg-10">
				<div class="list__product2">
				@foreach($pror as $k => $i)	
				@php
				$today=date_create();
				@endphp
				<div class="product2">
					<form>
					@if(Auth::guard('khachhang')->check())
							@if($i->khMa)
								<button type="button" title="Xóa khỏi danh mục yêu thích" id="btnheart" class="btn__heart__checked "value="{{$i->spMa}}"><i class="far fa-heart" ></i></button>
							@else
							<button type="button"  title="Thêm vào danh mục yêu thích" id="btnheart" class="btn__heart" value="{{$i->spMa}}"><i class="far fa-heart" ></i></button>	
											@endif
					@endif
					
					<div class="item_info">
									<a href="{{URL::to('proinfo/'.$i->spMa)}}">Xem sản phẩm</a>
					</div>
					<input class="name" name="spMa" type="hidden" value="{{$i->spTen}}">
								<img src="{{URL::asset('public/images/products/'.$i->spHinh)}}" alt="">			
								<div class="item-info-product">
									<label><a class="item_name" href="{{URL::to('proinfo/'.$i->spMa)}}">{{$i->spTen}}</a></label>
									<br/>
									
									@if($i->kmMa!=null && date_create($i->kmNgaybd) <= $today && date_create($i->kmNgaykt) >= $today && $i->kmTinhtrang == 1)
										<span><s>{{number_format($i->spGia)}} ₫</s></span><br>
										<span class="item_price"><i class="fas fa-tags"></i> {{number_format($i->spGia-($i->spGia*$i->kmTrigia/100))}} ₫</span>
									@else
									<br/>
										<span class="item_price">{{number_format($i->spGia)}} ₫</span>
									@endif
									
									<button type="button" class="btn__addCart" value="{{$i->spMa}}">
									<i class="far fa-cart-arrow-down" style="font-size: 18px;"></i></button>		
						</div>
					</form>
					</div>
				@endforeach
			</div>
		</div>
			<div id="right__arr2" class="col-lg-1 product__arrow">
   					<i class="fas fa-chevron-right" style="font-size: 48px;"></i>
   		</div>
		<!------------------------->
	</div>
	<br/><br/><br/>
<!-- main content -->
	<div class="container-fluid">
		<div class="row justify-content-around">
		<div class="col-lg-2 col-sm-8 products-left box__search">
			{{-- SEARCH --}}
			<div class="title__search">Tìm sản phẩm</div>
			<br/>
			<div class="ui top attached tabular menu">
			  <a class="item active" data-tab="first"><i class="black search icon"></i>Cơ bản</a>
			  <a class="item" data-tab="second"><i class=" blue search plus icon"></i>Nâng cao</a>
			</div>
			<div class="ui bottom attached tab segment active" data-tab="first">
				  <form class="form" action="{{URL::to('findpro')}}"  method="get" accept-charset="utf-8">
						<div class="col">
								<div class="row-1">
									<div class="input-group mb-1">
										  <input id="ip__search" type="text" class="form-control" name="proname" placeholder="Nhập tên sản phẩm...." ></span>
									</div>
								</div>
								<div class="row-1">
									<div>
										 <span>Giá từ: </span><span id="pf" s></span><br/>
										  <input  type="range" class="form-range" id="priceFrom" value="0" min=0 max=100000000 name="priceFrom" >
										  
									</div>
								</div>
								<br/>
								<div class="row-1">
									<div>
										  <span>Giá đến: </span><span id="pt" s></span><br/>
										  <input type="range" class="form-range" id="priceTo" value="100000000" min=0 max=100000000 name="priceTo" >
										  
									</div>
								</div>
								<hr>
								<div class="row-2">
										<label>Thương hiệu:</label><br>
										<div class="row">
										@foreach($brand as $i)
											<div class="col-lg-6" style="font-size: 14px;">
											<input class="form-check-input" type="checkbox" name="brand[]" value="{{$i->thMa}}" id="flexCheckDefault">  {{$i->thTen}}
											</div>
											 
											
										@endforeach
									</div>
									<hr>
								
										<label>Nhu cầu:</label><br>
										<div class="row">
										@foreach($needs as $i)
										<div class="col-lg-6" style="font-size: 14px;">
										<input type="checkbox" name="needs[]" class="row-1 form-check-input ms-1" value="{{$i->ncMa}}">&nbsp;{{$i->ncTen}}
									</div>
										@endforeach
									</div>
									<hr>

										<label>Loại:</label><br>
										<div class="row">
										
										@foreach($cate as $i)
										<div class="col-lg-6" style="font-size: 14px;">
										<input type="checkbox" name="category[]" class="row-1 form-check-input ms-1" value="{{$i->loaiMa}}">&nbsp;{{$i->loaiTen}}
									</div>
										@endforeach
									</div>
								</div>
						</div>
						<br/>
						<button class="btn_search col-12" type="submit"><i class="fas fa-search"></i></button>
						
										</form>
			</div>
			<div class="ui bottom attached tab segment" data-tab="second">
			  <form class="form__semanic" action="{{URL::to('advancedSearch')}}" method="post">
			  	{{csrf_field()}}
			  	<label><i class="microchip icon"></i> CPU</label>
			  	<select id="multi-select" name="cpu[]" multiple="" class="ui fluid search  dropdown" >
						  <option value="">Loại cpu</option>
							<option value="i3">Intel i3</option>
							<option value="i5">Intel i5</option>
							<option value="i7">Intel i7</option>
							<option value="i9">Intel i9</option>
							<option value="Ryzen 3">AMD Ryzen 3</option>
							<option value="Ryzen R7">AMD Ryzen R7</option>
							<option value="Ryzen 7">AMD Ryzen 7</option>
							<option value="Ryzen 9">AMD Ryzen 9</option>
							<option value="M1">Apple M1</option>
					</select><br><br><br/><br><br>
					<label><i class="server icon"></i> Ổ cứng</label>
			  	<select id="multi-select2" name="ocung[]" multiple="" class="ui fluid search  dropdown" >
						  <option value="">Dung lượng ổ cứng </option>
							<option value="128GB">128GB</option>
							<option value="240GB">240GB</option>
							<option value="250GB">250GB</option>
							<option value="256GB">256GB</opiton>
							<option value="512GB">512GB</option>
							<option value="1TB">1TB</option>
							<option value="2TB">2TB</option>
					</select><br><br><br/><br><br>
					<label><i class="object group icon"></i> RAM</label>
			  	<select id="multi-select3" name="ram[]" multiple="" class="ui fluid search  dropdown" >
						  <option value="">Dung lượng ram </option>
							<option value="4GB">4GB</option>
							<option value="6GB">6GB</option>
							<option value="8GB">8GB</option>
							<option value="16GB">16GB</option>
							<option value="32GB">32GB</option>
					</select>
					<br><br><br/><br><br>
					<label><i class="desktop icon"></i> Màn hình</label>
			  	<select id="multi-select4" name="manhinh[]" multiple="" class="ui fluid search  dropdown" >
						  <option value="">Loại màn hình </option>
							<option value="15.6">15.6"</option>
							<option value="13.3">13.3"</option>
					</select><br><br><br/><br><br>
					
					<button class="btn_search col-12" type="submit"><i class="fas fa-search"></i></button>
			  </form>
			</div>
			
		</div>
<br/>
		{{--  --}}

		<!--------product----->
		<div class="col-lg-9 products-right">
		<h3 class="text-center title__proSale">Danh sách sản phẩm</h3>	
		<hr/>
			<div>
				@if(Session::get('countsearch') >1 )
				<h3>Kết quả tìm kiếm cho:</h3>
					@if(Session::has('searchpricefrom') || Session::has('searchpriceto'))
						GIÁ 
						@if(Session::has('searchpricefrom'))
								<label>TỪ : <button class="btn btn-primary">{{Session::get('searchpricefrom')}}</button></label>
						@endif
							@if(Session::has('searchpriceto'))
								<label>ĐÉN : <button class="btn btn-primary">{{Session::get('searchpriceto')}}</button></label>
						@endif|
					@endif
						@if(Session::has('searchproname'))
							<label>Tên sản phẩm : <button class="btn btn-primary">{{Session::get('searchproname')}}</button></label>
					@endif
						@if(Session::has('searchbrand'))
							<label>Thương hiệu : 
								@foreach(Session::get('searchbrand') as $item)
								<button class="btn btn-primary">{{$item->thTen}}</button>
								@endforeach
							</label>|
					@endif
						@if(Session::has('searchcategory'))
							<label>Loại :
								@foreach(Session::get('searchcategory') as $item)
								<button class="btn btn-primary">{{$item->loaiTen}}</button>
								@endforeach
							</label>|
					@endif
						@if(Session::has('searchneeds'))
							<label>Nhu cầu : 
								@foreach(Session::get('searchneeds') as $item)
								<button class="btn btn-primary">{{$item->ncTen}}</button>
								@endforeach
							</label>
					@endif
				@endif
				@if(Session::get('countsearch1') >0 )
				<h3>Kết quả tìm kiếm cho:</h3>
					@if(Session::has('searchcpu'))
							<label>CPU : 
								@foreach(Session::get('searchcpu') as $item)
								<button class="btn btn-primary">{{$item}}</button>
								@endforeach
							</label>|
					@endif
					@if(Session::has('searchram'))
							<label>RAM : 
								@foreach(Session::get('searchram') as $item)
								<button class="btn btn-primary">{{$item}}</button>
								@endforeach
							</label>|
					@endif
					@if(Session::has('searchocung'))
							<label>Ổ cứng : 
								@foreach(Session::get('searchocung') as $item)
								<button class="btn btn-primary">{{$item}}</button>
								@endforeach
							</label>|
					@endif
					@if(Session::has('searchmanhinh'))
							<label>Màn hình : 
								@foreach(Session::get('searchmanhinh') as $item)
								<button class="btn btn-primary">{{$item}} inch</button>
								@endforeach
							</label>
					@endif
				@endif
			</div>

			<div class="grid__product">
				@foreach($db as $k => $i)	
				@php
				$today=date_create();
				@endphp
				<div class="col-lg-3 item__product">
					<form>
					@if(Auth::guard('khachhang')->check())
							@if($i->khMa)
								<button type="button" title="Xóa khỏi danh mục yêu thích" id="btnheart" class="btn__heart__checked "value="{{$i->spMa}}"><i class="far fa-heart" ></i></button>
							@else
							<button type="button"  title="Thêm vào danh mục yêu thích" id="btnheart" class="btn__heart" value="{{$i->spMa}}"><i class="far fa-heart" ></i></button>	
								@endif
					@endif
						<button type="button" class="btn__addCart" value="{{$i->spMa}}">
								<i class="far fa-cart-arrow-down" style="font-size: 18px;"></i></button>
					@if($i->kmMa!=null && date_create($i->kmNgaybd) <= $today && date_create($i->kmNgaykt) >= $today && $i->kmTinhtrang == 1)
					<div class="sale_tag"><i class="fas fa-tags"></i> {{$i->kmTrigia}} %</div>
					@endif
					<div class="item_info">
									<a href="{{URL::to('proinfo/'.$i->spMa)}}">Xem sản phẩm</a>
					</div>
					<input id="name{{$i->spMa}}" class="name" name="spMa" type="hidden" value="{{$i->spTen}}">
								<img id="img{{$i->spMa}}" src="{{URL::asset('public/images/products/'.$i->spHinh)}}" alt="">			
								<div class="item-info-product">
									<label><a class="item_name" href="{{URL::to('proinfo/'.$i->spMa)}}">{{$i->spTen}}</a></label>
																	
									@if($i->kmMa!=null && date_create($i->kmNgaybd) <= $today && date_create($i->kmNgaykt) >= $today && $i->kmTinhtrang == 1)
										<span class="sale__price"><s>{{number_format($i->spGia)}} ₫</s></span><br>
										<span class="item_price"><i class="fas fa-tags"></i> {{number_format($i->spGia-($i->spGia*$i->kmTrigia/100))}} ₫</span>
									@else
									<br/>
										<span class="item_price">{{number_format($i->spGia)}} ₫</span>
									@endif
									<br/>
									
									<input id="sosanh{{$i->spMa}}" hidden class="checkboxsp form-check-input" type="checkbox" name="" value="{{$i->spMa}}">
									<label for="sosanh{{$i->spMa}}" class="btn btn-outline-info">So sánh</label>
						</div>
					</form>
				</div>
			
				@endforeach
		</div>
	</div>
<br/><br/>
		</div>
	</div>
</div>	
<br/><br/>
 <div class="content__page">
        <table class="page">
      <tr>
        <td>
          @if($db->currentPage()==1)
            <span><a href="#"></a> </span> 
           @else
           <span><a href="{{$db->previousPageUrl()}}"><i class="fas fa-chevron-left" style="color: black;"></i></a> </span>
           @endif
          </td>

          @foreach($db->getUrlRange(1,$db->lastPage()) as $page => $url)
            @if($page == $db->currentPage())
            <td style="width: 30px;text-align: center;"><a>{{$page}}</a></td>
            @else
           <td> <a href="{{$url}}">{{$page}}</a></td>
            @endif

          @endforeach

           <td> @if($db->currentPage()==$db->lastPage())
         <span><a href="#"></a></span>
        @else
       <span><a href="{{$db->nextPageUrl()}}"><i class="fas fa-chevron-right" style="color: black;"></i></a> </span>
       @endif
       </td>
        </tr>
       </table> 
   </div>
   <div class="content__page">
   	<span class="col-lg-4 text-center">Trang {{$db->currentPage()}} trong số {{$db->lastPage()}} trang</span>
   </div>
  {{-- modal so sanh --}}
   <div id="sosanh" style="display: none;" class="sosanh">
			<div class="container-fluid">
					<form action="{{URL::to('compare')}}" method="post">
						{{ csrf_field()}}
						<div class="row">
							<div class="col-lg-12">
								<h5 class="text-center">So sánh sản phẩm</h5>
							</div>
							<br/>
							<div class="col-lg-12">
									<div class="proinfo col-lg-12">
										<img  id="ssimg1" src="" alt=""><br>
										<label id="proname1"></label>
									</div>
									<br/>
									<div class="proinfo2 col-lg-12">
										<img id="ssimg2" src="" alt="Chưa có sản phẩm được chọn cho sản phẩm cần so sánh"><br>
										<label id="proname2"></label>
									</div>
									<input style="color:black;" id="prod1" type="hidden" name="prod1">
									<input style="color:black;" id="prod2" type="hidden" name="prod2">
							</div>
							<div class="col-lg-12">
								<div class="col-lg-12"></div>
								<div class="form-group col-lg-2 button">
									<button id="submitbtn" type="submit" disabled="" class="btn btn-outline-primary  glow-on-hover"><i class="fas fa-compress-alt"></i> So sánh</button>
									<button type="button" class="btn btn-outline-warning glow-on-hover" id="clearbtn"><i class="fas fa-broom"></i> Clear</button>
									<button type="button" class="btn btn-outline-danger glow-on-hover" id="closebtn"><i class="fas fa-times"></i> Đóng</button>
								</div>
							</div>
						</div>
					</form>
			</div>
		</div>
		{{--  --}}
<script type="text/javascript">
var count =0;
$('.checkboxsp').change(function(){
	var ischecked = $(this).is(':checked');
	var value= $(this).val();
	$('#sosanh').show();
	if(ischecked)
	{
		if($('#prod1').val()=="")
		{
			$('#prod1').val(value);
			$('#ssimg1').attr('src',$('#img'+value).attr('src'));
			$('#proname1').html($('#name'+value).val());
			count++;
		}
		else
		{
			$('#prod2').val(value);	
			$('#ssimg2').attr('src',$('#img'+value).attr('src'));
			$('#proname2').html($('#name'+value).val());
			count++;
		}
	}
	if(!ischecked)
	{
		count--;
	}
	// clear
	if(count == 2 )
	{
		$('.checkboxsp').removeAttr("checked");
		$('#submitbtn').removeAttr("disabled");
		count =0;
	}
	console.log($('#prod1').val());
	console.log($('#prod2').val());
})
$('#clearbtn').on('click',function()
{
	$('#submitbtn').attr('disabled',true);
	$('#prod1').val("");
	$('#prod2').val("");
	$('#proname1').html("");
	$('#proname2').html("");
	$('.checkboxsp').removeAttr('checked');
	$('#ssimg1').removeAttr('src');
	$('#ssimg2').removeAttr('src');

})
$('#closebtn').on('click',function()
{
	$('#sosanh').hide();
})

		$(document).on('click','.btn__addCart',function(e){
			e.preventDefault();
			
			var id = $(this).val();
			$.ajax({
				TYPE:"GET",
				url:'save-cart/'+id,
				dataType:'JSON',
				data:{id, 
				},
				success:function(response)
				{
					var cart = document.getElementById("cart").innerHTML;
					var x = Number(cart);
					var sum = x + 1;
					result = response.message;
					if(result== 0)
					{
						Swal.fire({
					  icon: 'success',
					  title: 'Thông báo: ',
					  text: 'Đã thêm sản phẩm vào giỏ hàng',
					  footer: '<a href="{{URL::to('checkout')}}" class="btn btn-outline-warning">Tới giỏ hàng</a></span>'
					});
						document.getElementById("cart").innerHTML = sum;
					}
					else if(result==1 )
					{
						Swal.fire({
					  icon: 'error',
					  title: 'Thông báo: ',
					  text: 'Sản phẩm tạm hết hàng',
						});
					}
					else 
					{
						Swal.fire({
					  icon: 'error',
					  title: 'Thông báo: ',
					  text: 'Số lượng sản phẩm này trong giỏ hàng đã đạt giới hạn!',
						});
					}
				}
			});
		})


		/*-----------------*/

$(document).on('click','#btnheart',function(e){
			e.preventDefault();
			
			var id = $(this).val();
			$.ajax({
				TYPE:"GET",
				url:'addtowishlist/'+id,
				dataType:'JSON',
				data:{id,},
				success:function(response)
				{
					result = response.message;
					if(result== 0)
					{
						Swal.fire({
					  icon: 'success',
					  title: 'Thông báo: ',
					  text: 'Đã thêm vào danh mục yêu thích',
					  footer: '<a href="{{URL::to('wishlist')}}" class="btn btn-outline-warning">Tới danh mục</a></span>'
					});
					}
					else
					{
						Swal.fire({
					  icon: 'error',
					  title: 'Thông báo: ',
					  text: 'Đã xóa khỏi danh mục yêu thích',
					  footer: '<a href="{{URL::to('wishlist')}}" class="btn btn-outline-warning">Tới danh mục</a></span>'
						});
					}
				}
			});
		})
// Semantic UI 
$('.menu .item')
  .tab()
;
$('#multi-select')
  .dropdown()
;
$('#multi-select2')
  .dropdown()
;
$('#multi-select3')
  .dropdown()
;
$('#multi-select4')
  .dropdown()
;
</script>



{{-- Notification --}}
<script type="text/javascript" src="{{URL::asset("public/fe/js/slide.js")}}"></script>
@if(Session::has('loginmess'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: '{{Session::get('name')}}',
  text: '{{Session::get('loginmess')}}',
 
})
</script> 
@endif

@if(Session::has('addCart'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: '',
  text: '{{Session::get('addCart')}}',
 
})
</script> 
@endif
@if(Session::has('errCart'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('errCart')}}',
 
})
</script> 
@endif

@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif

@if(Session::has('verifySuccess'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thông báo: ',
  text: '{{Session::get('verifySuccess')}}',
 
})
</script> 
@endif

@if(Session::has('success'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thông báo: ',
  text: '{{Session::get('success')}}',
 
})
</script> 
@endif

 <script>
 	var inpf = document.getElementById('priceFrom');
 	var outpf =document.getElementById('pf');
 	outpf.innerHTML= Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(inpf.value);
 	inpf.oninput=function(){
 		outpf.innerHTML=   Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(this.value);
 	}

 	var inpt = document.getElementById('priceTo');
 	var outpt =document.getElementById('pt');
 	outpt.innerHTML= Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(inpt.value);
 	inpt.oninput=function(){
 		outpt.innerHTML =  Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(this.value);
 	}
 </script>
{{--  --}}
<br/><br/>
@endsection
