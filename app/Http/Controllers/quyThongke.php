<?php

 namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Collection;
use DB;
// use Session;
// use Carbon\Carbon;


// //Models
// use App\Models\admin;
// use App\Models\khachhang;
// use App\Models\sanpham;
// use App\Models\kho;
// use App\Models\hinh;
// use App\Models\mota;
// use App\Models\phieunhap;
// use App\Models\phieunhap_ser;
// use App\Models\danhgia;
// use App\Models\thuonghieu;
// use App\Models\loai;
// use App\Models\nhucau;
// use App\Models\nhacungcap;
// use App\Models\slide;
// use App\Models\admin_log;
// use App\Models\donhang;
// use App\Models\khuyenmai;
// use App\Models\voucher;
// use App\Models\chitietphieunhap;
// use App\Models\chitietdonhang;
// use App\Models\serial;
// use App\Models\baohanh_log;
// //Auth
// use Auth;
// session_start();

trait quyThongke{
//Thống kê đơn
function don_moi()
{
    $don_moi = DB::table('donhang')->where('hdTinhtrang',0)->count();
    return $don_moi;
}
function don_danggiao()
{
    $don_danggiao = DB::table('donhang')->where('hdTinhtrang',1)->orWhere('hdTinhtrang',6)->orWhere('hdTinhtrang',8)->count();
    return $don_danggiao;
}
function don_xong()
{
    $don_xong = DB::table('donhang')->where('hdTinhtrang',2)->count();
    return $don_xong;
}
function don_no()
{
     $don_no = DB::table('donhang')->where('hdTinhtrang',5)->orWhere('hdTinhtrang',7)->count();
    return $don_no;
}
//Quý kho còn
function quy_spNow()
{
     $quy_spNow = DB::table('chitietdonhang')
                ->select('cthdGia','sanpham.spTen','sanpham.spMa',DB::raw('count(serMa) as total, sum(cthdGia) as total_price'))
                ->join('donhang','donhang.hdMa','=','chitietdonhang.hdMa')
                ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                ->where(DB::raw('QUARTER(donhang.hdNgaytao)'),'=',DB::raw('QUARTER(CURDATE())'))
                ->groupBy('sanpham.spMa','cthdGia')
                ->get();
    return $quy_spNow;    
}
function quy_sp1()
{
     $quy_sp1 = DB::table('chitietdonhang')
                ->select('cthdGia','sanpham.spTen','sanpham.spMa',DB::raw('count(serMa) as total, sum(cthdGia) as total_price'))
                ->join('donhang','donhang.hdMa','=','chitietdonhang.hdMa')
                ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                ->where(DB::raw('QUARTER(donhang.hdNgaytao)'),'=',1)
                ->groupBy('sanpham.spMa','cthdGia')
                ->get();
    return $quy_sp1;    
}
function quy_sp2()
{
      $quy_sp2 = DB::table('chitietdonhang')
                ->select('cthdGia','sanpham.spTen','sanpham.spMa',DB::raw('count(serMa) as total, sum(cthdGia) as total_price'))
                ->join('donhang','donhang.hdMa','=','chitietdonhang.hdMa')
                ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                ->where(DB::raw('QUARTER(donhang.hdNgaytao)'),'=',2)
                ->groupBy('sanpham.spMa','cthdGia')
                ->get();
    return $quy_sp2;
}
function quy_sp3()
{
     $quy_sp3 = DB::table('chitietdonhang')
                ->select('cthdGia','sanpham.spTen','sanpham.spMa',DB::raw('count(serMa) as total, sum(cthdGia) as total_price'))
                ->join('donhang','donhang.hdMa','=','chitietdonhang.hdMa')
                ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                ->where(DB::raw('QUARTER(donhang.hdNgaytao)'),'=',3)
                ->groupBy('sanpham.spMa','cthdGia')
                ->get();
    return $quy_sp3;
}
function quy_sp4()
{
      $quy_sp4 = DB::table('chitietdonhang')
                ->select('cthdGia','sanpham.spTen','sanpham.spMa',DB::raw('count(serMa) as total, sum(cthdGia) as total_price'))
                ->join('donhang','donhang.hdMa','=','chitietdonhang.hdMa')
                ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                ->where(DB::raw('QUARTER(donhang.hdNgaytao)'),'=',4)
                ->groupBy('sanpham.spMa','cthdGia')
                ->get();
        return $quy_sp4;
}
//Quý sản phẩm
function quy_lap1()
    {
        $quy_lap1 = DB::table('donhang')
                    ->where(DB::raw('QUARTER(donhang.hdNgaytao)'),'=',1)
                    ->join('chitietdonhang','chitietdonhang.hdMa','=','donhang.hdMa')
                    ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                    ->where('hdTinhtrang',2)
                    ->where('sanpham.loaiMa','=','1')
                    ->count();
            return $quy_lap1;
    }
 function quy_pc1()
 {
 	   $quy_pc1 = DB::table('donhang')
                    ->where(DB::raw('QUARTER(donhang.hdNgaytao)'),'=',1)
                    ->join('chitietdonhang','chitietdonhang.hdMa','=','donhang.hdMa')
                    ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                    ->where('hdTinhtrang',2)
                    ->where('sanpham.loaiMa','=','2')
                    ->count();
        return $quy_pc1;
 }
 function quy_lap2()
 {
 	 $quy_lap2 = DB::table('donhang')
                    ->where(DB::raw('QUARTER(donhang.hdNgaytao)'),'=',2)
                    ->join('chitietdonhang','chitietdonhang.hdMa','=','donhang.hdMa')
                    ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                    ->where('hdTinhtrang',2)
                    ->where('sanpham.loaiMa','=','1')
                    ->count();
       return $quy_lap2;
 }
 function quy_pc2()
 {
 	   $quy_pc2 = DB::table('donhang')
                    ->where(DB::raw('QUARTER(donhang.hdNgaytao)'),'=',2)
                    ->join('chitietdonhang','chitietdonhang.hdMa','=','donhang.hdMa')
                    ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                    ->where('hdTinhtrang',2)
                    ->where('sanpham.loaiMa','=','2')
                    ->count(); 
        return $quy_pc2;
 }
function quy_lap3()
 {
 	 $quy_lap3 = DB::table('donhang')
                    ->where(DB::raw('QUARTER(donhang.hdNgaytao)'),'=',3)
                    ->join('chitietdonhang','chitietdonhang.hdMa','=','donhang.hdMa')
                    ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                    ->where('hdTinhtrang',2)
                    ->where('sanpham.loaiMa','=','1')
                    ->count();
       return $quy_lap3;
 }
 function quy_pc3()
 {
 	   $quy_pc3 = DB::table('donhang')
                    ->where(DB::raw('QUARTER(donhang.hdNgaytao)'),'=',3)
                    ->join('chitietdonhang','chitietdonhang.hdMa','=','donhang.hdMa')
                    ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                    ->where('hdTinhtrang',2)
                    ->where('sanpham.loaiMa','=','2')
                    ->count();    
        return $quy_pc3;
 }
 function quy_lap4()
 {
 	 $quy_lap4 = DB::table('donhang')
                    ->where(DB::raw('QUARTER(donhang.hdNgaytao)'),'=',4)
                    ->join('chitietdonhang','chitietdonhang.hdMa','=','donhang.hdMa')
                    ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                    ->where('hdTinhtrang',2)
                    ->where('sanpham.loaiMa','=','1')
                    ->count();   
       return $quy_lap4;
 }
 function quy_pc4()
 {
 	   $quy_pc4 = DB::table('donhang')
                    ->where(DB::raw('QUARTER(donhang.hdNgaytao)'),'=',4)
                    ->join('chitietdonhang','chitietdonhang.hdMa','=','donhang.hdMa')
                    ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                    ->where('hdTinhtrang',2)
                    ->where('sanpham.loaiMa','=','2')
                    ->count();
       
        return $quy_pc4;
 }

//Đơn hàng đang giao
function show_dongiao()
{
    $show_dongiao = DB::table('donhang')
                ->join('admin','admin.adMa','=','donhang.adMa')
                ->join('khachhang','khachhang.khMa','=','donhang.khMa')
                ->where('hdTinhtrang',1)
                ->get();
    return $show_dongiao;
}


}
