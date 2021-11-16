<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

//Models
use App\Models\thuonghieu;
use App\Models\loai;
use App\Models\nhucau;
use App\Models\sanpham;
use App\Models\kho;
use App\Models\nhacungcap;
use App\Models\hinh;
use App\Models\khuyenmai;
use App\Models\danhgia;
use App\Models\khachhang;
use App\Models\mota;
use App\Models\slide;
use App\Models\wishlist;
use App\Models\donhang;
use App\Models\voucher;
use App\Models\baohanh_log;
use App\Models\tknganhang;
use App\Models\payment;

//

class homeController extends Controller
{
    public function welcome()
    {   
        // lấy tên cty
        $name=payment::where('pmId',1)->select('extraData')->first();
        //
        $db=sanpham::join('hinh','hinh.spMa','=','sanpham.spMa')
                ->where('hinh.thutu','=','1')
                ->inRandomOrder()
                ->get();
        $dblap=sanpham::join('hinh','hinh.spMa','=','sanpham.spMa')
                ->where('sanpham.loaiMa',1)
                ->where('hinh.thutu','=','1')
                ->limit(8)->get();
        $dbpc=sanpham::join('hinh','hinh.spMa','=','sanpham.spMa')
                ->where('sanpham.loaiMa',2)
                ->where('hinh.thutu','=','1')
                ->limit(8)->get();
      
        return view('welcome',compact('db','dblap','dbpc','name'));
    }
    
     // forgot password
    public function forgotPassword()
    {
        $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        return view('Userpage.forgotPassword',compact('total'));
    }
    public function login()
    {
        Auth::guard('khachhang')->logout();
        return view('Userpage.userlogin');
    }
    public function logout()
    {
        Auth::guard('khachhang')->logout();
        
        session::forget("khMa");
        session::forget("khTen");
        session::forget('khTaikhoan');
        session::forget('khMa');
        session::forget('khEmail');
        session::forget('khHinh');
        session::forget('vcMa');
        return view('Userpage.userlogin');
    }
// PRODUCT
//
    public function product()
    {
        if(Auth::guard('khachhang')->check())
        {
            $kh= khachhang::where('khMa',Auth::guard('khachhang')->user()->khMa)->first();
            if ($kh->khDiachi==null || $kh->khSdt ==null)
            {
                Session::flash('success',' Vui lòng điền thông tin của bạn để phục vụ cho việc giao hàng !');
                return Redirect::to('infomation/'.Auth::guard('khachhang')->user()->khMa);
            }
        }
        $brand=thuonghieu::all();
        $cate=loai::all();
        $needs=nhucau::all();
        $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        $today=date_create();
            
        if(Auth::guard('khachhang')->check())
        {

            $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')
            ->leftjoin('kho','kho.spMa','sanpham.spMa')
            ->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')
            ->where('hinh.thutu','=','1')->orderBy('sanpham.kmMa','desc')
            ->paginate(8);
        }
        else
        {
            $db=sanpham::leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')
            ->join('kho','kho.spMa','sanpham.spMa')
            ->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')
            ->where('hinh.thutu','=','1')
            ->paginate(8);
        }
        // dd($db);
        return view('Userpage.product',compact('db','cate','needs','brand'));
    }

    public function proinfo(Request $re)
    {
        $comment=danhgia::where('spMa',$re->id)->leftjoin('khachhang','danhgia.khMa','khachhang.khMa')->orderBy('dgNgay','asc')->get();
        // dd($comment);
        $countorderedProduct=0;
        $usercomment=0;
        $wishlist=null;
        if(Auth::guard('khachhang')->check())
        {
            $countorderedProduct=khachhang::join('donhang','donhang.khMa','khachhang.khMa')->join('chitietdonhang','chitietdonhang.hdMa','donhang.hdMa')->where('chitietdonhang.spMa',$re->id)->where('donhang.khMa',Auth::guard('khachhang')->user()->khMa)->where('donhang.hdTinhtrang',2)->count();
            $usercomment=danhgia::where('khMa',Auth::guard('khachhang')->user()->khMa)->where('spMa',$re->id)->count();
            $wishlist=wishlist::where('khMa',Auth::guard('khachhang')->user()->khMa)->where('spMa',$re->id)->first();
            // dd($wishlist);
        }
        if($countorderedProduct > $usercomment)
        {
            $checkordered=khachhang::join('donhang','donhang.khMa','khachhang.khMa')->join('chitietdonhang','chitietdonhang.hdMa','donhang.hdMa')->where('chitietdonhang.spMa',$re->id)->where('donhang.khMa',Auth::guard('khachhang')->user()->khMa)->where('donhang.hdTinhtrang',2)->select('spMa')->first();
        }
        else
        {
            $checkordered=null;
        }
        $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i)
        {
            $total+=$i->price*$i->qty;
        }
        $cate=loai::all();

        $imgDefault=hinh::where('spMa',$re->id)->where("thutu",'=','1')->first('spHinh');
        $imgs=hinh::where('spMa',$re->id)->limit(3)->get();
        $details=mota::where('spMa',$re->id)->get(); 
        $proinfo=sanpham::join('kho','kho.spMa','sanpham.spMa')->join('loai','loai.loaiMa','=','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','=','sanpham.thMa')->where('sanpham.spMa',$re->id)->first();
        // dd($proinfo);
        //load promotion
        $today=now();
        $availPromo=sanpham::leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->where('khuyenmai.kmNgaybd','<=',$today)->where('khuyenmai.kmNgaykt','>=',$today)->where('sanpham.spMa',$re->id)->first();
        //related product
        $db=sanpham::where('thMa',$proinfo->thMa)->join('hinh','hinh.spMa','sanpham.spMa')->where('sanpham.spMa','!=',$proinfo->spMa)->where('hinh.thutu','1')->get();
      
        //dd($availPromo);
        return view('Userpage.productinfo',compact('db','proinfo','imgDefault','imgs','details','total','comment','checkordered','availPromo','wishlist'));
    }

    // clear search result
    public function clearsearchkey()
    {
        Session::forget('searchpricefrom');
        Session::forget('searchpriceto');
        Session::forget('searchproname');
        Session::forget('searchbrand');
        Session::forget('searchcategory');
        Session::forget('searchneeds');
        Session::forget('countsearch');
        Session::forget('searchcpu');
        Session::forget('searchram');
        Session::forget('searchocung');
        Session::forget('searchmanhinh');
        Session::forget('countsearch1');
    }
     //---Find product
    public function findpro(Request $re)
    {
        $this->clearsearchkey();
        //Xóa thông báo lỗi đổi mật khẩu khi chuyển trang
        Session::forget("note__errC");
        Session::forget("note__err");
       //end
        $db = hinh::join('sanpham', 'hinh.spMa', '=', 'sanpham.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->where('hinh.thutu','=','1')->get();
        $brand=thuonghieu::get();
        $cate=loai::get();
        $needs=nhucau::get();
        $cart=Cart::content();
        $total=0;
        // Show search key
        $countsearch=0;
        // dd($re->priceFrom);
        if($re->priceFrom !=0)
        {
            $priceFrom=number_format($re->priceFrom).' đ';
            Session::flash('searchpricefrom',$priceFrom);
            $countsearch++;
        }
        
        if($re->priceTo !=0  && $re->priceTo != 100000000)
        {
            $priceTo=number_format($re->priceTo).' đ';
            Session::flash('searchpriceto',$priceTo);
            $countsearch++;
        }
        
        if($re->proname !=null);
        {
            $proname=$re->proname;
            Session::flash('searchproname',$proname);
            $countsearch++;
        }

        $thuonghieulistname=array();
        $loailistname=array();
        $nhucaulistname=array();
        if($re->brand!=null)
        {
            foreach($re->brand as $item)
            {
                $findthuonghieu = DB::table('thuonghieu')->where('thMa',$item)->select('thTen')->first();
                array_push($thuonghieulistname,$findthuonghieu);
            }
            $sbrand=count($thuonghieulistname)==0?null:$thuonghieulistname;
            Session::flash('searchbrand',$sbrand);
            $countsearch++;
        }
        
        if($re->category != null )
        {
            foreach($re->category as $item)
            {
                $finloai = DB::table('loai')->where('loaiMa',$item)->select('loaiTen')->first();
                array_push($loailistname,$finloai);
            }
            // dd($loailistname);
            $scategory=count($loailistname)==0?null:$loailistname;
            Session::flash('searchcategory',$scategory);
            $countsearch++;
        }
        
        if($re->needs !=null)
        {
            foreach($re->needs as $item)
            {
                $findnhucau = DB::table('nhucau')->where('ncMa',$item)->select('ncTen')->first();
                array_push($nhucaulistname,$findnhucau);
            }
            $sneeds=count($nhucaulistname)==0?null:$nhucaulistname;
            Session::flash('searchneeds',$sneeds);
            $countsearch++;
        }
        
        Session::flash('countsearch',$countsearch);
        if($re->proname !=null)
        {
            $re->proname = preg_replace('/\s+/',' ', $re->proname);
        }
        
        //dd(Session::get('search'));

        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }

        if($re->priceFrom > $re->priceTo)
        {
            if($re->proname !=null && $re->brand!=null && $re->category !=null && $re->needs!=null)
            {   
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->category !=null)
            {
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->needs!=null)
            {
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->category !=null && $re->needs!=null)
            {
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->category !=null && $re->needs!=null)
            {
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->brand!=null &&  $re->needs!=null)
            {
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->brand!=null && $re->category !=null )
            {
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null&& $re->needs!=null)
            {
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->category !=null )
            {
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->brand!=null )
            {
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null)
            {
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->brand!=null )
            {
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.thMa',$re->brand)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->category !=null )
            {

                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->needs !=null )
            {
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            else
            {
                $db=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            return Redirect::to('product');
        }
        elseif ($re->priceFrom<$re->priceTo) 
        {
            if($re->proname !=null && $re->brand!=null && $re->category !=null && $re->needs!=null)
            {   
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->category !=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->brand!=null &&  $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->brand!=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null&& $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->brand!=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->brand!=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.thMa',$re->brand)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->category !=null )
            {
                //return $re->category;
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->needs !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            else
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('hinh.thutu','=','1')->paginate(8);
                //dd($db);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            return Redirect::to('product');
        }
        else
        {
            if($re->proname !=null && $re->brand!=null && $re->category !=null && $re->needs!=null)
            {   
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->category !=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->brand!=null &&  $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->paginate(16);                
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->brand!=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null&& $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->paginate(16);
                
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null && $re->brand!=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->proname !=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->brand!=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.thMa',$re->brand)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->category !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif( $re->needs !=null )
            {
               $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->paginate(16);
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            return Redirect::to('product');
        }
        return Redirect::to('product');
    }
    // --------------
    // Advanced Search 
    public function advancedSearch(Request $re)
    {
        $this->clearsearchkey();
        $brand=thuonghieu::get();
        $cate=loai::get();
        $needs=nhucau::get();

        $strcpu=$re->cpu;
        $strram=$re->ram;
        $strocung=$re->ocung;
        $strmanhinh=$re->manhinh;

        //declare null array();
        $mainarray=array();
        $cpu=array();
        $ram=array();
        $ocung=array();
        $manhin=array();

        // show search key
        $countsearch1=0;
        if($strcpu!=null)
        {
            Session::flash('searchcpu',$strcpu);
            $countsearch1++;
        }
        if($strram!=null)
        {
            Session::flash('searchram',$strram);
            $countsearch1++;
        }
        if($strocung!=null)
        {
            Session::flash('searchocung',$strocung);
            $countsearch1++;
        }
        if($strmanhinh!=null)
        {
            Session::flash('searchmanhinh',$strmanhinh);
            $countsearch1++;
        }
        Session::flash('countsearch1',$countsearch1);

        //find
        if($strcpu != null && $strram != null && $strocung != null && $strmanhinh !=null)
        {
            //cpu merge
            //dd('ok');
            $cpu = mota::Where(function ($query) use($strcpu) 
            {
                for ($i = 0; $i < count($strcpu); $i++)
                {
                    $query->orwhere('cpu', 'like',  '%' . $strcpu[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($cpu as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //ram merge
            $ram = mota::Where(function ($query) use($strram) 
            {
                for ($i = 0; $i < count($strram); $i++)
                {
                    $query->orwhere('ram', 'like',  '%' . $strram[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ram as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //ocung merge
            $ocung = mota::Where(function ($query) use($strocung) 
            {
                for ($i = 0; $i < count($strocung); $i++)
                {
                    $query->orwhere('ocung', 'like',  '%' . $strocung[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ocung as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //manhinh merge
            $manhinh = mota::Where(function ($query) use($strmanhinh) 
            {
                for ($i = 0; $i < count($strmanhinh); $i++)
                {
                    $query->orwhere('manhinh', 'like',  '%' . $strmanhinh[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($manhinh as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
        }
        elseif($strcpu != null && $strram != null && $strocung != null)
        {
            $cpu = mota::Where(function ($query) use($strcpu) 
            {
                for ($i = 0; $i < count($strcpu); $i++)
                {
                    $query->orwhere('cpu', 'like',  '%' . $strcpu[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($cpu as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //ram merge
            $ram = mota::Where(function ($query) use($strram) 
            {
                for ($i = 0; $i < count($strram); $i++)
                {
                    $query->orwhere('ram', 'like',  '%' . $strram[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ram as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //ocung merge
            $ocung = mota::Where(function ($query) use($strocung) 
            {
                for ($i = 0; $i < count($strocung); $i++)
                {
                    $query->orwhere('ocung', 'like',  '%' . $strocung[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ocung as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
        }
        elseif($strcpu != null && $strram != null && $strmanhinh != null)
        {
            //cpu merge
            $cpu = mota::Where(function ($query) use($strcpu) 
            {
                for ($i = 0; $i < count($strcpu); $i++)
                {
                    $query->orwhere('cpu', 'like',  '%' . $strcpu[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($cpu as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //ram merge
            $ram = mota::Where(function ($query) use($strram) 
            {
                for ($i = 0; $i < count($strram); $i++)
                {
                    $query->orwhere('ram', 'like',  '%' . $strram[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ram as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //manhinh merge
            $manhinh = mota::Where(function ($query) use($strmanhinh) 
            {
                for ($i = 0; $i < count($strmanhinh); $i++)
                {
                    $query->orwhere('manhinh', 'like',  '%' . $strmanhinh[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($manhinh as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
        }
        elseif($strcpu != null && $strocung != null && $strmanhinh != null)
        {
            //cpu merge
            $cpu = mota::Where(function ($query) use($strcpu) 
            {
                for ($i = 0; $i < count($strcpu); $i++)
                {
                    $query->orwhere('cpu', 'like',  '%' . $strcpu[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($cpu as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //ocung merge
            $ocung = mota::Where(function ($query) use($strocung) 
            {
                for ($i = 0; $i < count($strocung); $i++)
                {
                    $query->orwhere('ocung', 'like',  '%' . $strocung[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ocung as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //manhinh merge
            $manhinh = mota::Where(function ($query) use($strmanhinh) 
            {
                for ($i = 0; $i < count($strmanhinh); $i++)
                {
                    $query->orwhere('manhinh', 'like',  '%' . $strmanhinh[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($manhinh as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
        }
        elseif($strram != null && $strocung != null && $manhinh != null)
        {
            //ram merge
            $ram = mota::Where(function ($query) use($strram) 
            {
                for ($i = 0; $i < count($strram); $i++)
                {
                    $query->orwhere('ram', 'like',  '%' . $strram[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ram as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //ocung merge
            $ocung = mota::Where(function ($query) use($strocung) 
            {
                for ($i = 0; $i < count($strocung); $i++)
                {
                    $query->orwhere('ocung', 'like',  '%' . $strocung[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ocung as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //manhinh merge
            $manhinh = mota::Where(function ($query) use($strmanhinh) 
            {
                for ($i = 0; $i < count($strmanhinh); $i++)
                {
                    $query->orwhere('manhinh', 'like',  '%' . $strmanhinh[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($manhinh as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
        }
        elseif($strcpu != null && $strram != null)
        {
            //cpu merge
            $cpu = mota::Where(function ($query) use($strcpu) 
            {
                for ($i = 0; $i < count($strcpu); $i++)
                {
                    $query->orwhere('cpu', 'like',  '%' . $strcpu[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($cpu as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //ram merge
            $ram = mota::Where(function ($query) use($strram) 
            {
                for ($i = 0; $i < count($strram); $i++)
                {
                    $query->orwhere('ram', 'like',  '%' . $strram[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ram as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }           
        }
        elseif($strram != null && $strocung != null)
        {
            //ram merge
            $ram = mota::Where(function ($query) use($strram) 
            {
                for ($i = 0; $i < count($strram); $i++)
                {
                    $query->orwhere('ram', 'like',  '%' . $strram[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ram as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //ocung merge
            $ocung = mota::Where(function ($query) use($strocung) 
            {
                for ($i = 0; $i < count($strocung); $i++)
                {
                    $query->orwhere('ocung', 'like',  '%' . $strocung[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ocung as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }           
        }
        elseif($strocung != null && $strmanhinh != null)
        {            
            //ocung merge
            $ocung = mota::Where(function ($query) use($strocung) 
            {
                for ($i = 0; $i < count($strocung); $i++)
                {
                    $query->orwhere('ocung', 'like',  '%' . $strocung[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ocung as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //manhinh merge
            $manhinh = mota::Where(function ($query) use($strmanhinh) 
            {
                for ($i = 0; $i < count($strmanhinh); $i++)
                {
                    $query->orwhere('manhinh', 'like',  '%' . $strmanhinh[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($manhinh as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
        }
        elseif($strcpu != null && $strocung != null )
        {
            //cpu merge
            $cpu = mota::Where(function ($query) use($strcpu) 
            {
                for ($i = 0; $i < count($strcpu); $i++)
                {
                    $query->orwhere('cpu', 'like',  '%' . $strcpu[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($cpu as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }            
            //ocung merge
            $ocung = mota::Where(function ($query) use($strocung) 
            {
                for ($i = 0; $i < count($strocung); $i++)
                {
                    $query->orwhere('ocung', 'like',  '%' . $strocung[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ocung as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }           
        }
        elseif($strcpu != null && $strmanhinh != null)
        {
            //cpu merge
            $cpu = mota::Where(function ($query) use($strcpu) 
            {
                for ($i = 0; $i < count($strcpu); $i++)
                {
                    $query->orwhere('cpu', 'like',  '%' . $strcpu[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($cpu as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }            
            //manhinh merge
            $manhinh = mota::Where(function ($query) use($strmanhinh) 
            {
                for ($i = 0; $i < count($strmanhinh); $i++)
                {
                    $query->orwhere('manhinh', 'like',  '%' . $strmanhinh[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($manhinh as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
        }
        elseif( $strram != null && $strmanhinh !=null)
        {
            //ram merge
            $ram = mota::Where(function ($query) use($strram) 
            {
                for ($i = 0; $i < count($strram); $i++)
                {
                    $query->orwhere('ram', 'like',  '%' . $strram[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ram as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
            //manhinh merge
            $manhinh = mota::Where(function ($query) use($strmanhinh) 
            {
                for ($i = 0; $i < count($strmanhinh); $i++)
                {
                    $query->orwhere('manhinh', 'like',  '%' . $strmanhinh[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($manhinh as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
        }
        elseif($strcpu != null)
        {
            //cpu merge
            $cpu = mota::Where(function ($query) use($strcpu) 
            {
                for ($i = 0; $i < count($strcpu); $i++)
                {
                    $query->orwhere('cpu', 'like',  '%' . $strcpu[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($cpu as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }    
        }
        elseif($strram != null)
        {
            //ram merge
            $ram = mota::Where(function ($query) use($strram) 
            {
                for ($i = 0; $i < count($strram); $i++)
                {
                    $query->orwhere('ram', 'like',  '%' . $strram[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ram as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
        }
        elseif($strocung != null)
        {
            //ocung merge
            
            $ocung = mota::Where(function ($query) use($strocung) 
            {
                for ($i = 0; $i < count($strocung); $i++)
                {
                    $query->orwhere('ocung', 'like',  '%' . $strocung[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($ocung as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }     
        }
        elseif($strmanhinh != null)
        {
            //manhinh merge
            $manhinh = mota::Where(function ($query) use($strmanhinh) 
            {
                for ($i = 0; $i < count($strmanhinh); $i++)
                {
                    $query->orwhere('manhinh', 'like',  '%' . $strmanhinh[$i] .'%');
                }      
            })->join('sanpham','sanpham.spMa','mota.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','1')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->get();
            foreach($manhinh as $item)
            {
                if(in_array($item,$mainarray)==false)
                {
                    array_push($mainarray,$item);
                }
            }
        }
        // dd($mainarray);
        $db= $this->paginate($mainarray,100);
        // dd($db);
        return view('Userpage.product',compact('db','brand','cate','needs'));
    }

    public function paginate($items, $perPage = 8, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    
    // Commment
    public function addcomment(Request $re)
    {
            $this->validate($re,[
                'content'=>'required'],[
                'content.required'=>'Nội dung không được để trống']);
            $date=getdate();
            $data['dgMa']=''.strlen($re->content).$date['yday'].rand(0,100).substr($re->id,0,2);
            $data['spMa']=$re->id;
            $data['dgNoidung']=$re->content;
            $data['khMa']=Auth::guard('khachhang')->user()->khMa;
            $data['dgNgay']=now();
            $data['dgTrangthai']=1;
            DB::table('danhgia')->insert($data);
            session::flash('comment','Đã đăng bình luận !');
            return redirect()->back();
    }

    public function deleteComment(Request $re)
    {
        DB::table('danhgia')->where('dgMa',$re->id)->delete();
        return redirect()->back();
    }
    // ----------
//----------------

// CART
    public function checkout()
    {   
        //Xóa thông báo lỗi đổi mật khẩu khi chuyển trang
        Session::forget("note__errC");
       Session::forget("note__err");
       //end
       if(Cart::count()==0)
       {
            Session::forget('vcMa');
       }
        $cate=loai::get();
        $cart=cart::content();
        $a=array();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
            array_push($a,$i->id);
        }   
        $today=date_create();
     
        $checkexistKhuyenmai=khuyenmai::join('sanpham','sanpham.kmMa','khuyenmai.kmMa')->where('kmNgaybd','<=',$today)->whereIn('sanpham.spMa',$a)->where('kmNgaykt','>=',$today)->where('kmTinhtrang',1)->get();
        $use=array();
        $unuse=array();
        if(Auth::guard('khachhang')->check())
        {
            foreach($checkexistKhuyenmai as $i)
            {
                $checkordered=donhang::where('khMa',Auth::guard('khachhang')->user()->khMa)->where('kmMa',$i->kmMa)->count();
               //dd(Auth::guard('khachhang')->user()->khMa);
                if($i->kmGioihanmoikh!=null)
                {
                    if($i->spSlkmtoida>0)
                    {
                        if($i->kmGioihanmoikh > $checkordered)
                        {
                            array_push($use,$i);
                        }
                        else
                        {
                            array_push($unuse,$i);
                        }
                    }
                    if($i->spSlkmtoida == null)
                    {
                        if($i->kmGioihanmoikh > $checkordered)
                        {
                            array_push($use,$i);
                        }
                        else
                        {
                            array_push($unuse,$i);
                        }
                    }
                }
                else
                {
                    array_push($use,$i);
                }
            }
        }
        else
        {
            $use=$checkexistKhuyenmai;
        }
        
        // dd($use,$unuse);
        Session::put('total',$total);
        return view('Userpage.checkout',compact('cate','cart','total','use','unuse'))->with('promotion',$checkexistKhuyenmai);
        }

    public function order(Request $re)
    {
         // dd(Auth::guard('khachhang')->check());
        if(Cart::count()>0)
        {
            if(Auth::guard('khachhang')->check())
            {
                $cart=Cart::content();
                $cate=loai::get();
                $leng=strlen($re->promo);
                $str=strpos($re->promo,",");
                $kmMa=substr($re->promo,0,$str);
                $spMa=substr($re->promo,$str+1,$leng);
                
                $promoInfo=khuyenmai::where('khuyenmai.kmMa',$kmMa)->join('sanpham','sanpham.kmMa','khuyenmai.kmMa')->first();
                 $vcInfo=voucher::where('vcMa',Session::get('vcMa'))->first();
                    $pricePromo=0;
                    $total=0;
                    $proinfo=sanpham::where('spMa',$spMa)->first();
                
                // declare null varible
                $priceVc=0;
                $discountPercent=0;

                if($vcInfo || $promoInfo)
                {
                    // Apply promotion
                    if($promoInfo)
                    {
                        foreach ($cart as  $i) 
                        {
                            if($i->id==$spMa)
                            {
                                if($promoInfo->kmGiatritoida!=null)
                                {
                                    $discountPercent=$promoInfo->kmTrigia/100;

                                    $pricePromo=($i->price*$i->qty*$discountPercent)*$i->qty;
                                    if($pricePromo>$promoInfo->kmGiatritoida)
                                    {
                                        $pricePromo=($promoInfo->kmGiatritoida)*$i->qty;
                                    }
                                }
                                if($promoInfo->kmGiatritoida == null)
                                {
                                    $discountPercent=$promoInfo->kmTrigia/100;
                                    $pricePromo=($i->price*$i->qty*$discountPercent)*$i->qty;
                                }
                                $total+=$i->price*$i->qty-$pricePromo;
                            }
                            else
                            {
                                $total+=$i->price*$i->qty;
                            }
                        }
                    }
                    // Apply voucher
                   
                    if($vcInfo)
                    { 
                        if($vcInfo->vcLoai==0)//Theo san pham
                        {
                            $proinfo=sanpham::where('spMa',$vcInfo->spMa)->first();
                            foreach($cart as $i)
                            {
                                if($i->id==$vcInfo->spMa)
                                { 
                                    $total+=$i->price*$i->qty;
                                    // Giam theo gia
                                    if($vcInfo->vcLoaigiamgia==0)
                                    {
                                        if($vcInfo->vcGiatritoida > $vcInfo->vcMucgiam)
                                        {
                                            $priceVc=$vcInfo->vcMucgiam;
                                        }
                                        else
                                        {
                                            $priceVc=$vcInfo->vcGiatritoida;
                                        }
                                    }
                                    //Giam theo %
                                    if($vcInfo->vcLoaigiamgia==1)
                                    {
                                        $discountPercent=$vcInfo->vcMucgiam/100;
                                        $priceVc=$i->price * $i->qty*$discountPercent;
                                        
                                        if($priceVc > $vcInfo->vcGiatritoida)
                                        {
                                            $priceVc=$vcInfo->vcGiatritoida*$i->qty;
                                        }
                                    }
                                }
                                else
                                {
                                    $total+=$i->price*$i->qty;
                                }
                            }//endforeach
                            //Giam theo gia
                            if($vcInfo->vcLoaigiamgia==0)
                            {
                                $total=$total-$priceVc;
                            }
                            //Giam theo %
                            if($vcInfo->vcLoaigiamgia==1)
                            {
                                $total-=$priceVc;
                            }
                        }
                        elseif($vcInfo->vcLoai==1)// Theo don hang
                        {
                            foreach($cart as $i)
                            {
                                $total+=$i->price*$i->qty;
                                // Giam theo gia
                                if($vcInfo->vcLoaigiamgia==0)
                                {
                                    if($vcInfo->vcGiatritoida > $vcInfo->vcMucgiam)
                                        {
                                            $priceVc=$vcInfo->vcMucgiam;
                                        }
                                        else
                                        {
                                            $priceVc=$vcInfo->vcGiatritoida;
                                        }
                                }
                                //Giam theo %
                                if($vcInfo->vcLoaigiamgia==1)
                                {
                                    $discountPercent=$vcInfo->vcMucgiam/100;
                                }  
                            }//end foreach
                            // Giam theo gia
                            if($vcInfo->vcLoaigiamgia==0)
                            {
                                $total=$total-$priceVc;
                            }
                            //Giam theo %
                            if($vcInfo->vcLoaigiamgia==1)
                            {
                                $priceVc=$total*$discountPercent;
                                if($priceVc > $vcInfo->vcGiatritoida)
                                {
                                    $priceVc=$vcInfo->vcGiatritoida;
                                }
                                $total-=$priceVc;
                            }              
                        }
                        else
                        {
                            foreach($cart as $i)
                            {
                                $total+=$i->price*$i->qty;
                            }
                        }
                    }
                }
                else
                {
                    foreach($cart as $i)
                    {
                        $total+=$i->price*$i->qty;
                    }
                }
                $bankInfo=tknganhang::all();
                $pm=payment::Where('pmId',1)->first();
                return view('Userpage.confirmcheckout',compact('vcInfo','priceVc','pricePromo','promoInfo','proinfo','cate','cart','total','bankInfo','pm'));
            }
            else
            {
                session::flash('loginmessage','Vui lòng đăng nhập trước khi thực hiện đặt hàng!');
                return Redirect::to('login');
            }
        }
        else
        {   
             Session::flash('errCart','Giỏ hàng trống !');
            return Redirect::to('product');
        }
    }


    //Infomation
    public function viewInfomation($id)
    {
        
        Session::forget("note__errC");
        Session::forget("note__err");
    
        $vt1 = DB::table('slide')->where('bnVitri',1)->where('bnTrang',2)->where('bnTrangthai','0')->limit(1)->get();
        $vt1Check =DB::table('slide')->where('bnVitri',1)->where('bnTrang',2)->where('bnTrangthai','0')->count();
        $vt8 = DB::table('slide')->where('bnVitri',8)->where('bnTrang',2)->where('bnTrangthai','0')->limit(1)->get();
        $vt8Check =DB::table('slide')->where('bnVitri',8)->where('bnTrang',2)->where('bnTrangthai','0')->count();
        $cate=loai::get();
        $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        $data = DB::table('khachhang')->where('khMa',$id)->get();
      
        return view('Userpage.infomation',compact('vt1','vt1Check','vt8','vt8Check'))->with('data',$data)->with('cate',$cate)->with('total',$total);
    }
    public function editInfomation(Request $re, $id)
    {
         $yearNow = Carbon::now()->year;
         $yearKh = new Carbon($re->khNgaysinh);
         $yearKhNgaysinh = $yearKh->year;
        if($re->khTen ==null||$re->khTaikhoan == null||$re->khSdt==null||$re->khEmail==null||$re->khDiachi==null||$re->khNgaysinh==null||$re->khGioitinh==null)
        {
             Session::flash('err','Không được để trống thông tin!');
                 return redirect()->back(); 
        }
        if(strlen($re->khDiachi)>255)
        {
             Session::flash('err','Địa chỉ quá dài!');
            return redirect()->back(); 
        }
         if(strlen($re->khTen)>50)
        {
             Session::flash('err','Tên quá dài!');
            return redirect()->back(); 
        }
          if(strlen($re->khEmail)>50)
        {
             Session::flash('err','Email quá dài!');
              return redirect()->back(); 
        }
        $enough = $yearNow-$yearKhNgaysinh;
        if($enough<18)
        {
              Session::flash('err','Khách hàng phải trên 18 tuổi!');
                return redirect()->back(); 
        }
        else
        {
            if($re->hasFile('khHinh')==true)
            {
                $data = array();
                $data['khMa']=$id;
                $data['khTen']=$re->khTen;
                $data['khEmail']=$re->khEmail;
                $data['khNgaysinh']=$re->khNgaysinh;
                $data['khDiachi']=$re->khDiachi;
                $data['khGioitinh']=$re->khGioitinh;
                $data['khTaikhoan']=$re->khTaikhoan;
                $data['khSdt']=$re->khSdt;
                $data['khHinh'] = $re->file('khHinh')->getClientOriginalName();
                $imgextention=$re->file('khHinh')->extension();
                                $file=$re->file('khHinh');
                                $file->move('public/images/khachhang',$data['khHinh']);
                DB::table('khachhang')->where('khMa',$id)->update($data);
                Session::forget('khHinh');
                Session::put('khHinh', $data['khHinh']);
                return redirect('/infomation/'.$id);
            }
            else
            {
                $data = array();
                $data['khMa']=$id;
                $data['khTen']=$re->khTen;
                $data['khEmail']=$re->khEmail;
                $data['khNgaysinh']=$re->khNgaysinh;
                $data['khDiachi']=$re->khDiachi;
                $data['khGioitinh']=$re->khGioitinh;
                $data['khTaikhoan']=$re->khTaikhoan;
                 $data['khSdt']=$re->khSdt;
                DB::table('khachhang')->where('khMa',$id)->update($data);
                return redirect('/infomation/'.$id);
            }
        }
    }
    public function updatePass($id)
    {
        $cate=loai::get();
        $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        $data = DB::table('khachhang')->where('khMa',$id)->get();
      
        return view('Userpage.updatePass')->with('data',$data)->with('cate',$cate)->with('total',$total);
    }
    public function editPass(Request $re ,$id)
    {
        $matkhaucu = md5($re->khPassCu);
        $khPass = DB::table('khachhang')->where("khMa",$id)->where('khMatkhau',$matkhaucu)->first();
        if(!$khPass)
        {
            Session::put("note__errC","Mật khẩu không đúng");
            Session::forget("note__err");
            return redirect('/updatePass/'.$id);
        }
        else
        {
        if($re->khPassCu ==null||$re->khRePassMoi == null||$re->khPassMoi==null)
        {
            Session::forget("note__errC");
            $messages =[
                'khPassCu.required'=>'Mật khẩu hiện tại không được để trống',
                'khRePassMoi.required'=>'Mật khậu nhập lại không được để trống', 
                'khPassMoi.required'=>'Mật khẩu mới không được để trống',   
            ];
            $this->validate($re,[
                'khPassCu'=>'required',
                'khRePassMoi'=>'required',
                'khPassMoi'=>'required',
            ],$messages);
            $errors=$validate->errors();
        }
        else
        {
               if($re->khRePassMoi != $re->khPassMoi)
               {
                Session::put("note__err","Mật khẩu nhập lại phải giống với mật khậu mới");
               Session::forget("note__errC");
                return redirect('/updatePass/'.$id);
               }
               else
               {
                Session::forget("note__errC");
                 Session::forget("note__err");
                   $data = array();
                   $data['khMatkhau'] = md5($re->khPassMoi);
                   DB::table('khachhang')->where('khMa',$id)->update($data);
                   return redirect('/infomation/'.$id);
                }
           }
        }
    }

    public function cancelinfo()
    {
        $kh=khachhang::where('khMa',Auth::guard('khachhang')->user()->khMa)->first();
        $kh->khDiachi="x";
        $kh->khSdt="x";
        $kh->update();
        Session::flash('loginmess','Đăng nhập thành công !');
            Session::flash('name','Chào '.$kh->khTen.' !!!');
        return Redirect::to('product');
    }
    // Verify Email
    public function verifyemail($id)
    {
        $cate=loai::get();
        $cart=Cart::content();
        $total=0;
        $userEmail=DB::table('khachhang')->where('khMa',$id)->select('khEmail')->first();
    
        return view('Userpage.verify',compact('userEmail','cate','cart','total'));
    }
    public function sendcode()
    {
        if(Auth::guard('khachhang')->check())
        {
            $date=getdate();
            $details=''.rand(0,10).strlen(Auth::guard('khachhang')->user()->khMa).strlen(Auth::guard('khachhang')->user()->khTen).$date['hours'].$date['yday'].$date['year'];
            //dd(Session::get('khEmail'));
            $kh=khachhang::where('khMa',Auth::guard('khachhang')->user()->khMa)->first();
            $kh->khXtemail=$details;
            $kh->update();
            Mail::to(Auth::guard('khachhang')->user()->khEmail)->send(new \App\Mail\verifyemail($details));
            return response()->json(['message'=>1]);
        }
        else
        {
             return response()->json(['message'=>0]);
        }
        
    }

    public function verifycode(Request $re)
    {
        $result=DB::table('khachhang')->where('khMa',Auth::guard('khachhang')->user()->khMa)->where('khXtemail',$re->code)->first();
        // dd($result);
        if($result)
        {
            if($result->khXtemail!=null)
            {
                DB::table('khachhang')->where('khMa',Auth::guard('khachhang')->user()->khMa)->update(['khXtemail'=>1]);
                Session::flash('verifySuccess','Email đã được xác thực !');
                return redirect()->route('productpage');    
            }
        }
        Session::flash('verifyFail','Mã xác thực sai !');
        return redirect()->back();
    }

    public function changeEmail($id)
    {
        $kh=khachhang::where('khMa',$id)->first();
        $kh->khXtemail=null;
        $kh->update();
        return redirect()->back();
    }

    // ---------
    // -------------
    // 
    // list of order

    public function listorder()
    {
        $cate=loai::get();
        $cart=Cart::content();
        $total=0;
       foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        $list=donhang::where('khMa',Auth::guard('khachhang')->user()->khMa)->orderBy('hdNgaytao','desc')->get();
        $details=array();
        //dd(count($list));
        if(count($list)==0)
        {
            return view('Userpage.order',compact('list','cate','cart','total','details'));
        }
        else
        {
            foreach ($list as  $v) 
            {
                $details=DB::table('chitietdonhang')->join('donhang','donhang.hdMa','chitietdonhang.hdMa')->join('sanpham','sanpham.spMa','chitietdonhang.spMa')->join('hinh','hinh.spMa','sanpham.spMa')->where('khMa',$v->khMa)->orderBy('donhang.hdNgaytao','asc')->where('hinh.thutu',1)->get();
            }
            return view('Userpage.order',compact('details','list','cate','cart','total'));
        }
        
    }   

    // ----------//
    public function huyDon($id)
    {
        $data= array();
        $data['hdTinhtrang']=3;

        DB::table('donhang')->where('hdMa',$id)->update($data);
        return redirect()->back();
    }


    // Wish List
    public function wishlist()
    {
        $getwishlist=wishlist::join('sanpham','sanpham.spMa','wishlist.spMa')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('kho','sanpham.spMa','kho.spMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->get();
        $check=array();
        $wl=array();
        foreach ($getwishlist as  $i)
        {
           if(in_array($i->spMa,$check)==null)
           {
                array_push($check,$i->spMa);
                array_push($wl,$i);
           }
        }
        //dd($wl);
        return view('Userpage.wishlist',compact('wl'));
    }

    public function addtowishlist(Request $re)
    {
        $checkExistProduct=sanpham::join('wishlist','wishlist.spMa','sanpham.spMa')->where('sanpham.spMa',$re->id)->first();
        if(!$checkExistProduct)
        {
            $wl=new wishlist();
            $wl->spMa=$re->id;
            $wl->khMa=Auth::guard('khachhang')->user()->khMa;   
            $wl->save(); 
            return response()->json(['message'=>0]);
        }
        else
        {
            $wl=wishlist::where('spMa',$checkExistProduct->spMa)->delete();
        }
        return response()->json(['message'=>1]);
    }
    // 


    public function checkvoucher(Request $re)
    {
        if($re->vcMa==null)
        {
            Session::flash('err','Mã voucher không được để trống !');
            Session::forget('vcMa');
            return redirect()->back();
        }
        $checkExistVoucher=voucher::where('vcMa',$re->vcMa)->where('vcTinhtrang',1)->first();
        if(Auth::guard('khachhang')->check()==false)
        {
            Session::flash("loginmessage",'Vui lòng đăng nhập để nhập voucher!');
            return Redirect::to('login');
        }
        $countOrderusedVoucher=donhang::where('khMa',Auth::guard('khachhang')->user()->khMa)->where('vcMa',$re->vcMa)->count();
        // dd($countOrderusedVoucher);
        if($checkExistVoucher)
        {
            if($checkExistVoucher->vcSoluot != 0 )
            {
                if($countOrderusedVoucher!=0)
                {
                    Session::forget('vcMa');
                    Session::flash('err','Bạn đã dùng voucher này rồi!');
                    return redirect()->back();
                } 
                else
                {    
                    if($checkExistVoucher->vcLoai==0)
                    {
                        $flag=0;
                        foreach(Cart::content() as $i)
                        {
                            if($checkExistVoucher->spMa== $i->id)
                            {
                                $flag+=1;
                            }
                        }
                        if($flag!=0)
                        {   
                            $proName=sanpham::find($checkExistVoucher->spMa);
                            Session::flash('success','Đã áp dụng voucher cho sản phẩm: '.$proName->spTen.' ');
                            Session::put('vcMa',$re->vcMa);
                            return redirect()->back();
                        }
                        else
                        {
                            Session::flash('err','Không thể sử dụng voucher này vì không có sản phẩm được áp dụng trong giỏ hàng !');
                            return redirect()->back();
                        }
                        
                    }
                    elseif($checkExistVoucher->vcLoai==1)
                    {
                        if($checkExistVoucher->vcDkapdung==0)
                        {
                            if($re->total<$checkExistVoucher->vcGtcandat)
                            {
                                Session::flash('err','Tổng giá trị đơn hàng của bạn phải lớn hơn ' .number_format($checkExistVoucher->vcGtcandat)."đ mới có thể áp dụng voucher này !");
                                 Session::forget('vcMa');
                                return redirect()->back();
                            }
                            else
                            {
                                Session::flash('success','Đã áp dụng voucher cho đơn hàng này !');
                                Session::put('vcMa',$re->vcMa);
                                return redirect()->back();
                            }
                        }
                        if($checkExistVoucher->vcDkapdung==1)
                        {
                            if(Cart::count()<$checkExistVoucher->vcGtcandat)
                            {
                                Session::flash('err','Tổng số sản phẩm của bạn phải lớn hơn ' .number_format($checkExistVoucher->vcGtcandat)." mới có thể áp dụng voucher này !");
                                 Session::forget('vcMa');
                                return redirect()->back();
                            }
                            else
                            {
                                Session::flash('success','Đã áp dụng voucher cho đơn hàng này !');
                                Session::put('vcMa',$re->vcMa);
                                return redirect()->back();
                            }
                        }
                    }
                }
            }
            else
            {
                Session::flash('err','Voucher đã hết lượt sử dụng ');
                    return redirect()->back();
            }
        }
        else
        {
            Session::forget('vcMa');
            Session::flash('err','Mã voucher không hợp lệ !');
            return redirect()->back();
        }
    }
    
    //////////////////TIN TỨC ////////////////////
    public function viewTintuc()
    {
        $data1 = DB::table('tintuc')->where('ttTinhtrang','0')->where('ttLoai','1')->orderBy('ttNgaydang','desc')->get();
        $data2 = DB::table('tintuc')->where('ttTinhtrang','0')->where('ttLoai','2')->orderBy('ttNgaydang','desc')->get();
     
        return view('Userpage.danh-sach-tin-tuc')->with('data1',$data1)->with('data2',$data2);
    }
     public function tintucInfo($id)
    {
       $data = DB::table('tintuc')->where('ttMa',$id)->get();
       $data2 = DB::table('tintuc')->where('ttTinhtrang','0')->where('ttLoai','2')->orderBy('ttNgaydang','desc')->get();
       $viewOld = DB::table('tintuc')->select('ttLuotxem')->where('ttMa',$id)->first();
       $changeView = array();
       $changeView['ttLuotxem']=$viewOld->ttLuotxem+1; 
       DB::table('tintuc')->where('ttMa',$id)->update($changeView);
        return view('Userpage.chi-tiet-tin-tuc')->with('data',$data)->with('data2',$data2);
    }

    //////////////////////////////Serial//////////////////////////
    public function checkSerialpage()
    {
        $result=null;
        $log = null;
        $month=null;
        return view('Userpage.checkSerial',compact('result','log','month'));
    }

    public function checkSerial(Request $re)
    {
        $result=null;
        if($re->serMa == null)
        {
            Session::flash('error','Vui lòng nhập mã để kiểm tra !');
            return Redirect::to('checkSerialpage');
        }
        $today = date('Y-m-d');
        $result=sanpham::join('serial','serial.spMa','sanpham.spMa')->join('hinh','hinh.spMa','sanpham.spMa')->where('hinh.thutu',1)->where('serial.serMa',$re->serMa)->first();
        $dh=donhang::leftjoin('chitietdonhang','chitietdonhang.hdMa','donhang.hdMa')->where('chitietdonhang.serMa',$re->serMa)->first();
        if($dh)
        {
            $month = strtotime(date("Y-m-d", strtotime($dh->hdNgaytao)) . " +".$result->spHanbh." month");
            $month = strftime("%Y-%m-%d", $month);
            $details=mota::where('spMa',$result->spMa)->first();
            $log=baohanh_log::where('serial',$re->serMa)->orderBy('bhNgay','desc')->get();
            
            return view('Userpage.checkSerial',compact('result','details','log','month'));
        }
        else
        {
            Session::flash('error','Mã không hợp lệ vui lòng kiểm tra lại !');
        }
        return redirect()->back()->withInput();
    }

    public function bannerInfo($id)
    {
         $data = DB::table('slide')->where('bnMa',$id)->get();
         return view('Userpage.chi-tiet-banner')->with('data',$data);
    }


    public function addEmailTintuc(Request $re,$id)
    {
        $exist = DB::table('emailthongtin')->where('email',$id)->count();
        if($exist==0)
        {
            $data = array();
           $data['email']=$id;
           DB::table('emailthongtin')->insert($data);

      
        return response()->json(["message"=>0]); 
        }
        else
        {
             return response()->json(["message"=>1]); 
        }

    }

    // compare product 
    public function compare(Request $re)
    {
        if($re->prod1 !=null && $re->prod2)
        {
            $details=sanpham::join('hinh','hinh.spMa','sanpham.spMa')->join('mota','mota.spMa','sanpham.spMa')->where('hinh.thutu',1)->where('sanpham.spMa',$re->prod1)->first();
            $details2=sanpham::join('hinh','hinh.spMa','sanpham.spMa')->join('mota','mota.spMa','sanpham.spMa')->where('hinh.thutu',1)->where('sanpham.spMa',$re->prod2)->first();    
        }
        else
        {
            Session::flash('err','Vui lòng chọn 2 sản phẩm !');
            return Redirect()->route('productpage');
        }
        // dd($details,$details2);
        return view('Userpage.compareproduct',compact('details','details2'));

    }
    
}

