@extends('Userpage.layout') @section('title') So sánh sản phẩm @endsection @section('content')
<div class="container-fluid compare">
	<div class="row">
        <br/>
		<h2 class="text-center text-primary">So sánh sản phẩm</h2>
	</div>
<div class="row">
        <div class="col-lg-6 text-center">
                <a href="{{URL::to('proinfo/'.$details->spMa)}}"><img src="{{URL::asset('public/images/products/'.$details->spHinh)}}" alt="" /></a>
                <div class="item-info-product">
                    <label class="item_name"><a href="{{URL::to('proinfo/'.$details->spMa)}}">{{$details->spTen}}</a></label>
                    <br />
                </div> 
        </div>
        <div class="col-lg-6 text-center">
                <a href="{{URL::to('proinfo/'.$details2->spMa)}}"><img src="{{URL::asset('public/images/products/'.$details2->spHinh)}}" alt="" /></a>

                <div class="item-info-product">
                    <label class="item_name"><a href="{{URL::to('proinfo/'.$details2->spMa)}}">{{$details2->spTen}}</a></label>
                    <br />
                </div>
        </div>
</div>
<br/>
<div class="row">
    <div class="col-lg-6">
        <h3>Thông số kỹ thuật:</h3>
        <table class="table table-hover">
            @if($details->ram!=null)
            <tr>
                <td class="mota__left">RAM</td>
                <td class="mota__right">{{$details->ram}}</td>
            </tr>
            @endif @if($details->cpu!=null)
            <tr>
                <td class="mota__left">CPU</td>
                <td class="mota__right">{{$details->cpu}}</td>
            </tr>

            @endif @if($details->ocung!=null)
            <tr>
                <td class="mota__left">Ổ cứng</td>
                <td class="mota__right">{{$details->ocung}}</td>
            </tr>
            @endif @if($details->psu!=null)
            <tr>
                <td class="mota__left">PSU</td>
                <td class="mota__right">{{$details->psu}}</td>
            </tr>
            @endif @if($details->vga!=null)
            <tr>
                <td class="mota__left">VGA</td>
                <td class="mota__right">{{$details->vga}}</td>
            </tr>
            @endif @if($details->mainboard!=null)
            <tr>
                <td class="mota__left">Mainboard</td>
                <td class="mota__right">{{$details->mainboard}}</td>
            </tr>
            @endif @if($details->manhinh!=null)
            <tr>
                <td class="mota__left">Màn hình</td>
                <td class="mota__right">{{$details->manhinh}}</td>
            </tr>
            @endif @if($details->chuot!=null)
            <tr>
                <td class="mota__left">Chuột</td>
                <td class="mota__right">{{$details->chuot}}</td>
            </tr>
            @endif @if($details->banphim!=null)
            <tr>
                <td class="mota__left">Bàn phím</td>
                <td class="mota__right">{{$details->banphim}}</td>
            </tr>
            @endif @if($details->vocase!=null)
            <tr>
                <td class="mota__left">Case</td>
                <td class="mota__right">{{$details->vocase}}</td>
            </tr>
            @endif @if($details->pin!=null)
            <tr>
                <td class="mota__left">Pin</td>
                <td class="mota__right">{{$details->pin}}</td>
            </tr>
            @endif @if($details->tannhiet!=null)
            <tr>
                <td class="mota__left">Tản nhiệt</td>
                <td class="mota__right">{{$details->tannhiet}}</td>
            </tr>
            @endif @if($details->loa!=null)
            <tr>
                <td class="mota__left">Loa</td>
                <td class="mota__right">{{$details->loa}}</td>
            </tr>
            @endif @if($details->mau!=null)
            <tr>
                <td class="mota__left">Màu</td>
                <td class="mota__right">{{$details->mau}}</td>
            </tr>
            @endif @if($details->trongluong!=null)
            <tr>
                <td class="mota__left">Trọng lượng</td>
                <td class="mota__right">{{$details->trongluong}}</td>
            </tr>
            @endif @if($details->conggiaotiep!=null)
            <tr>
                <td class="mota__left">Cổng giao tiếp</td>
                <td class="mota__right">{{$details->conggiaotiep}}</td>
            </tr>
            @endif @if($details->webcam!=null)
            <tr>
                <td class="mota__left">Webcam</td>
                <td class="mota__right">{{$details->webcam}}</td>
            </tr>
            @endif @if($details->chuanlan!=null)
            <tr>
                <td class="mota__left">Chuẩn LAN</td>
                <td class="mota__right">{{$details->chuanlan}}</td>
            </tr>
            @endif @if($details->chuanwifi!=null)
            <tr>
                <td class="mota__left">Chuẩn WIFI</td>
                <td class="mota__right">{{$details->chuanwifi}}</td>
            </tr>
            @endif @if($details->hedieuhanh!=null)
            <tr>
                <td class="mota__left">Hệ điều hành</td>
                <td class="mota__right">{{$details->hedieuhanh}}</td>
            </tr>
            @endif
        </table>
    </div>
    <div class="col-lg-6">
        <h3>Thông số kỹ thuật:</h3>
        <table class="table table-hover">
            @if($details2->ram!=null)
            <tr>
                <td class="mota__left">RAM</td>
                <td class="mota__right">{{$details2->ram}}</td>
            </tr>
            @endif @if($details2->cpu!=null)
            <tr>
                <td class="mota__left">CPU</td>
                <td class="mota__right">{{$details2->cpu}}</td>
            </tr>

            @endif @if($details2->ocung!=null)
            <tr>
                <td class="mota__left">Ổ cứng</td>
                <td class="mota__right">{{$details2->ocung}}</td>
            </tr>
            @endif @if($details2->psu!=null)
            <tr>
                <td class="mota__left">PSU</td>
                <td class="mota__right">{{$details2->psu}}</td>
            </tr>
            @endif @if($details2->vga!=null)
            <tr>
                <td class="mota__left">VGA</td>
                <td class="mota__right">{{$details2->vga}}</td>
            </tr>
            @endif @if($details2->mainboard!=null)
            <tr>
                <td class="mota__left">Mainboard</td>
                <td class="mota__right">{{$details2->mainboard}}</td>
            </tr>
            @endif @if($details2->manhinh!=null)
            <tr>
                <td class="mota__left">Màn hình</td>
                <td class="mota__right">{{$details2->manhinh}}</td>
            </tr>
            @endif @if($details2->chuot!=null)
            <tr>
                <td class="mota__left">Chuột</td>
                <td class="mota__right">{{$details2->chuot}}</td>
            </tr>
            @endif @if($details2->banphim!=null)
            <tr>
                <td class="mota__left">Bàn phím</td>
                <td class="mota__right">{{$details2->banphim}}</td>
            </tr>
            @endif @if($details2->vocase!=null)
            <tr>
                <td class="mota__left">Case</td>
                <td class="mota__right">{{$details2->vocase}}</td>
            </tr>
            @endif @if($details2->pin!=null)
            <tr>
                <td class="mota__left">Pin</td>
                <td class="mota__right">{{$details2->pin}}</td>
            </tr>
            @endif @if($details2->tannhiet!=null)
            <tr>
                <td class="mota__left">Tản nhiệt</td>
                <td class="mota__right">{{$details2->tannhiet}}</td>
            </tr>
            @endif @if($details2->loa!=null)
            <tr>
                <td class="mota__left">Loa</td>
                <td class="mota__right">{{$details2->loa}}</td>
            </tr>
            @endif @if($details2->mau!=null)
            <tr>
                <td class="mota__left">Màu</td>
                <td class="mota__right">{{$details2->mau}}</td>
            </tr>
            @endif @if($details2->trongluong!=null)
            <tr>
                <td class="mota__left">Trọng lượng</td>
                <td class="mota__right">{{$details2->trongluong}}</td>
            </tr>
            @endif @if($details2->conggiaotiep!=null)
            <tr>
                <td class="mota__left">Cổng giao tiếp</td>
                <td class="mota__right">{{$details2->conggiaotiep}}</td>
            </tr>
            @endif @if($details2->webcam!=null)
            <tr>
                <td class="mota__left">Webcam</td>
                <td class="mota__right">{{$details2->webcam}}</td>
            </tr>
            @endif @if($details2->chuanlan!=null)
            <tr>
                <td class="mota__left">Chuẩn LAN</td>
                <td class="mota__right">{{$details2->chuanlan}}</td>
            </tr>
            @endif @if($details2->chuanwifi!=null)
            <tr>
                <td class="mota__left">Chuẩn WIFI</td>
                <td class="mota__right">{{$details2->chuanwifi}}</td>
            </tr>
            @endif @if($details2->hedieuhanh!=null)
            <tr>
                <td class="mota__left">Hệ điều hành</td>
                <td class="mota__right">{{$details2->hedieuhanh}}</td>
            </tr>
            @endif
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 text-center">
		<a class="btn btn-primary" href="{{URL::to('proinfo/'.$details->spMa)}}"><i class="fas fa-search"></i> Xem sản phẩm này</a>
    </div>
    <div  class="col-lg-6 text-center">
		<a class="btn btn-primary" href="{{URL::to('proinfo/'.$details2->spMa)}}"><i class="fas fa-search"></i> Xem sản phẩm này</a>
	</div>
</div>
<br/>
<div class="row justify-content-around">
    <div class="col-lg-6 text-center">
        <a class="btn btn-danger" href="{{URL::to('product')}}"><i class="fas fa-long-arrow-alt-left"></i> Trở về danh sách sản phẩm</a>
    </div>
</div>
</div>
<br/>
@endsection
