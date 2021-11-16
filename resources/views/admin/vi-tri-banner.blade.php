@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content justify-content-around">
        	<br/>
        	
			 &emsp;<button class="btn btn-info" type="button" onclick="back()">Trở về</button>
			 <br/>
			 <div>&emsp;Nhấp chuột vào khung vị trí cần thay đổi</div>
               <br/>
               @if($page == 1)
               <!---------Trang chủ----------->
                     <div class="container-fluid">
                     	<div class="bn__header">
                     		<a class="link__addBn style__together" href="{{URL::to('them-banner/'."1/"."1")}}">
                     		<div class="row header__top">
                     			<img id="img__header--top" src="" />
                     		Vị trí 1
                     		</div>
                     		</a>
                     		<div class="row header__bot">
                     			<div class="col-lg-6">
                     				<a class="col-lg-12 text-center link__addBn style__together" href="{{URL::to('them-banner/'."1/"."2")}}">
                     				<img id="img__logo" src="" />
                     				<span>Vị trí 2</span>
                     				</a>
                     			</div>
                     			<div class="col-lg-6">
                     				
                     			</div>
                     		</div>
                     		<!-------->
                     			<a href="{{URL::to('them-banner/'."1/"."3")}}" class="style__together">
                     			<div class="row bn__video">
                     			<div class="col-lg-12 bg__video">
					   				<video id="bg__video" muted loop autoplay>
					   					<source id="bg__source" src="" type="video/mp4">
					   				</video>
					   			</div>
					   			<div class="col-lg-6 bg__content">
					   				<h2 id="bg__video--text"></h2>
					   			</div>
					   			Vị trí 3
					   			</div>
					   			</a>
                     		<!------->
                     		<div class="row bn__pro">
                     				<a class="col-lg-6 bn__pro--left style__together" href="{{URL::to('them-banner/'."1/"."4")}}">
                     				<img id="img__pro--left" src="" />
                     				<div class="col-lg-12 text-center">
                     					<span id="text__pro--left">&emsp;Vị trí 4</span></div>
                     				{{-- <div id="content__left" class="col-lg-6 content__left">
                     					<span id="content__title4">Tiêu đề</span><br/>
                     					<div id="content__text4">Nội dung</div><br/>
                     					<a>Xem thêm</a>
                     				</div> --}}
                     				
                     				</a>
                     				<!---->
                     				<a class="col-lg-6 bn__pro--right style__together" href="{{URL::to('them-banner/'."1/"."5")}}">
                     				<img id="img__pro--right" src="" />
                     				<div class="col-lg-12 text-center">
                     					<span id="text__pro--right">Vị trí 5</span>
                     				</div>
                     				{{-- <div id="content__right" class="col-lg-6 content__right">
                     					<span id="content__title5">Tiêu đề</span><br/>
                     					<div id="content__text5">Nội dung</div><br/>
                     					<a>Xem thêm</a>
                     				</div> --}}
                     				</a>
                     			</div>
                     	
                     		<br/>
                     		<div class="row justify-content-around">
                     			<h3>WELCOME</h3>
                     		</div>
                     		<hr/>
                     		<div class="row justify-content-around">
                     			<h3>DANH SÁCH SẢN PHẨM</h3>
                     		</div>
                     		<hr/>
                     		<div class="row bn__content">
                     			<a href="{{URL::to('them-banner/'."1/"."6")}}" class="col-lg-6 bn__content--img style__together">
                     				<img id="bn__content--img1" src="" />
                     				<span id="text__content--img1">Vị trí 6</span>
                     			</a>	
                     			<div class=" row col-lg-6 bn__content--text">
                     				<div class="bn__content--border">
                     				<div></div>
                     				</div>
                     				&emsp;&emsp;
                     				<div>
                     				{{-- <span id="text__title1" class="text__title">Tiêu đề</span><br/><br/>
                     				<div id="text__content1" class="text__content">Nội dung</div><br/>
                     				<a>Xem thêm</a> --}}
                     			</div>
                     			</div>
                     		</div>
                     		<!---->
                     		<div class="row bn__content">
                     			<div class="row col-lg-6 bn__content--text justify-content-end" style="text-align: right;">
                     				<div>
                     				{{-- <span id="text__title2" class="text__title">Tiêu đề</span><br/><br/>
                     				<div id="text__content2" class="text__content">Nội dung</div><br/>
                     				<a>Xem thêm</a> --}}
                     				</div>
                     				&emsp;&emsp;
                     				<div class="bn__content--border">
                     				<div></div>
                     				</div>
                     			</div>
                     			<a href="{{URL::to('them-banner/'."1/"."7")}}" class="col-lg-6 bn__content--img style__together">
                     			<div class="col-lg-6 bn__content--img">
                     				<img id="bn__content--img2" src="" />
                     				<span id="text__content--img2">Vị trí 7</span>
                     			</div>
                     			</a>
                     		</div>
                     		<!---->
                     		<div class="row bn__content">
                     			<a href="{{URL::to('them-banner/'."1/"."8")}}" class="col-lg-6 bn__content--img style__together">
                     				<img id="bn__content--img1" src="" />
                     				<span id="text__content--img1">Vị trí 8</span>
                     			</a>	
                     			<div class=" row col-lg-6 bn__content--text">
                     				<div class="bn__content--border">
                     				<div></div>
                     				</div>
                     				&emsp;&emsp;
                     				<div>
                     				{{--<span id="text__title1" class="text__title">Tiêu đề</span><br/><br/>
                     				<div id="text__content1" class="text__content">Nội dung</div><br/>
                     				<a>Xem thêm</a> --}}
                     			</div>
                     			</div>
                     		</div>
                     		<!---->
                     	</div>
                     </div>
                @else
                		<div class="container-fluid">
                			<div class="row">
                				<a href="{{URL::to('them-banner/'."2/"."1")}}" class="bn__vitri1 style__together">Vị trí 1</a>
                				<div class="col-lg-9">
                					<div class="row">
                						<a href="{{URL::to('them-banner/'."2/"."2")}}"class="bn__vitri2 col-lg-8 style__together">
                							Vị trí 2
                						</a>
                						<div class="bn__bnCon col-lg-4">
                							<a href="{{URL::to('them-banner/'."2/"."3")}}" class="row bn__vitri3 justify-content-around align-content-center style__together">Vị trí 3</a>
                							<a href="{{URL::to('them-banner/'."2/"."4")}}" class="row bn__vitri4 justify-content-around align-content-center style__together">Vị trí 4</a>
                						</div>
                					</div>
                					<div class="row">
                						<a href="{{URL::to('them-banner/'."2/"."5")}}" class="col-lg-4 bn__vitri5 style__together">Vị trí 5</a>
                						<a href="{{URL::to('them-banner/'."2/"."6")}}" class="col-lg-4 bn__vitri6 style__together">Vị trí 6</a>
                						<a href="{{URL::to('them-banner/'."2/"."7")}}" class="col-lg-4 bn__vitri7 style__together">Vị trí 7</a>


                					</div>
                				</div>
                				<a href="{{URL::to('them-banner/'."2/"."8")}}" class="bn__vitri8 style__together">Vị trí 8</a>
                			</div>
                		</div>
                @endif  
                 <!---------Trang sản phẩm----------->
                 <br/><br/><br/> 
                
             </form>
			<br/>
            
		</div>
		
	</div>

@endsection
 

