<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Mail\mailTintuc;
use Illuminate\Support\Facades\Mail;


//Models
use App\Models\admin;
use App\Models\khachhang;
use App\Models\sanpham;
use App\Models\kho;
use App\Models\hinh;
use App\Models\mota;
use App\Models\phieunhap;
use App\Models\phieunhap_ser;
use App\Models\danhgia;
use App\Models\thuonghieu;
use App\Models\loai;
use App\Models\nhucau;
use App\Models\nhacungcap;
use App\Models\slide;
use App\Models\admin_log;
use App\Models\donhang;
use App\Models\khuyenmai;
use App\Models\voucher;
use App\Models\chitietphieunhap;
use App\Models\chitietdonhang;
use App\Models\serial;
use App\Models\baohanh_log;
use App\Models\payment;
use App\Models\tknganhang;
//Auth
use Auth;



session_start();
class adminController extends Controller
{
    use quyThongke;
    public function index()
    {
        // if(Auth::user()->adTaikhoan != null)
        if(Auth::user()!=null)
        {
            $quy_default = 0;
            $quy_spNow = $this->quy_spNow();

            $don_moi = $this->don_moi();
            $don_danggiao = $this->don_danggiao();
            $don_xong = $this->don_xong();
            $don_no = $this->don_no();

            $show_dongiao = $this->show_dongiao();

            $quy_lap1 = $this->quy_lap1();
            $quy_pc1 = $this->quy_pc1();
            $quy_lap2 = $this->quy_lap2();
            $quy_pc2 = $this->quy_pc2();
            $quy_lap3 = $this->quy_lap3();
            $quy_pc3 = $this->quy_pc3();
            $quy_lap4 = $this->quy_lap4();
            $quy_pc4 = $this->quy_pc4();

            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $nv = DB::table('admin')->get();
            $sp = DB::table('sanpham')
                ->join('hinh','hinh.spMa','=','sanpham.spMa')
                ->where('hinh.thutu','=','1')
                ->join('kho','kho.spMa','=','sanpham.spMa')
                ->where('kho.khoSoluong','>','0')
                ->get();
            $dh = DB::table('donhang')->where('hdTinhtrang',2)->count();
            $start = date_create("2021-07-01 00:00:00");
            $end = date_create("2021-09-01 00:00:00");
            $total_price = donhang::selectRaw('hdNgaytao,MONTH(donhang.hdNgaytao) AS month,YEAR(donhang.hdNgaytao) AS year')->whereBetween('donhang.hdNgaytao',[$start,$end])
                                ->where('hdTinhtrang',2)
                                ->sum('hdTongtien');
            $total_pay = phieunhap::selectRaw('pnNgaylap,MONTH(phieunhap.pnNgaylap) AS month,YEAR(phieunhap.pnNgaylap) AS year')->whereBetween('phieunhap.pnNgaylap',[$start,$end])
                                ->sum('pnTongtien');

          
            //$total_price = DB::table('donhang')->where('hdTinhtrang',2)->sum('hdTongtien');
            $total_sp = DB::table('sanpham')->count();
            //$total_pay = DB::table('phieunhap')->sum('pnTongtien');
            return view('admin.index',compact('nv','sp','dh','total_price','total_sp','total_pay','quy_lap1','quy_pc1','quy_lap2','quy_pc2','quy_lap3','quy_pc3','quy_lap4','quy_pc4','quy_spNow','quy_default','don_moi','don_danggiao','don_xong','show_dongiao','noteDonhang','noteDonhang1','noteDanhgia','don_no'));
        }
        if(Auth::user()==0 || Auth::user()== NULL)
        { 
            return Redirect('/adLogin'); 
        }
    } 
   

    // ADMIN AND LOGIN
    public function adLoginView()
    {
        return view('admin.login');
    }
    public function checkLogin(Request $re)
    {
        if(Auth::attempt(['adTaikhoan'=>$re->account,'adMatkhau'=>$re->password]))
            {       
                $quy_default = 0;
                $quy_spNow = $this->quy_spNow();

                $don_moi = $this->don_moi();
                $don_danggiao = $this->don_danggiao();
                $don_xong = $this->don_xong();
                $don_no = $this->don_no();

                $show_dongiao = $this->show_dongiao();

                $quy_lap1 = $this->quy_lap1();
                $quy_pc1 = $this->quy_pc1();
                $quy_lap2 = $this->quy_lap2();
                $quy_pc2 = $this->quy_pc2();
                $quy_lap3 = $this->quy_lap3();
                $quy_pc3 = $this->quy_pc3();
                $quy_lap4 = $this->quy_lap4();
                $quy_pc4 = $this->quy_pc4();
               
                    $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
                    Session::put('dgTrangthai',$noteDanhgia);
                    $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
                    Session::put('hdTinhtrang',$noteDonhang);
                    $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
                    Session::put('hdTinhtrang1',$noteDonhang1);
                    $nv = DB::table('admin')->get();
                    $sp = DB::table('sanpham')
                        ->join('hinh','hinh.spMa','=','sanpham.spMa')
                        ->where('hinh.thutu','=','1')
                        ->join('kho','kho.spMa','=','sanpham.spMa')
                        ->get();
                    $total_sp = DB::table('sanpham')->count();
                    $dh = DB::table('donhang')->where('hdTinhtrang',2)->count();
                    $total_price = DB::table('donhang')->where('hdTinhtrang',2)->sum('hdTongtien');
                    $total_pay = DB::table('phieunhap')->sum('pnTongtien');
        
            if(Auth::user()->adQuyen == 2 || Auth::user()->adQuyen == 3)
            {
                return redirect('don-hang');
            }
            if(Auth::user()->adQuyen == 4)
            {
                return redirect('quan-ly-giao-hang/'.Auth::user()->adMa);
            }
            if(Auth::user()->adTinhtrang == 1)
            {
                Session::flash('note_err','T??i kho???n ???? b??? kh??a!');
               return redirect('login');
            }
            else
            {
                return view('admin.index',compact('nv','sp','dh','total_price','total_sp','total_pay','quy_lap1','quy_pc1','quy_lap2','quy_pc2','quy_lap3','quy_pc3','quy_lap4','quy_pc4','quy_spNow','quy_default','don_moi','don_danggiao','don_xong','show_dongiao','noteDonhang','noteDonhang1','noteDanhgia','don_no'));
            }
            
            }

            else
            {
                Session::flash('note_err','T??n t??i kho???n ho???c m???t kh???u kh??ng ch??nh x??c!');
                 return "<script>window.history.back();</script>"; 
            }
          
    }

    public function logout()
    {
        // session::forget('adTaikhoan');
        // Session::forget('error_login');
        // Session::forget('adTen');
        // Session::forget('adHinh');
        // Session::forget('adQuyen');
        Auth::logout();
        return view('admin.login');
    }


    //VIEW MANAGE
    public function viewNhanvien()
    {

        if(Auth::user()->adTaikhoan != null)
        {
             $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data = DB::table('admin')->whereNotIn('adTinhtrang',[99])->get();
            return view('admin.nhanvien')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        {  return Redirect('/adLogin'); }
       
    }
      public function viewKhachhang()
    {
          if(Auth::user()->adTaikhoan != null)
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data = DB::table('khachhang')->get();
        return view('admin.khachhang')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
      public function viewSanpham()
    {
        if(Auth::user()->adTaikhoan != null)
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);

            $data=DB::table('sanpham')
                    ->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')
                    ->leftjoin('loai','loai.loaiMa','=','sanpham.loaiMa')
                    ->leftjoin('thuonghieu','thuonghieu.thMa','=','sanpham.thMa')
                    ->join('nhucau','nhucau.ncMa','=','sanpham.ncMa')
                    ->leftjoin('nhacungcap','nhacungcap.nccMa','=','sanpham.nccMa')
                    ->leftjoin('hinh','hinh.spMa','=','sanpham.spMa')
                    ->where('hinh.thutu','1')
                    ->get();
           // $exist = DB::table('serial')->distinct()->get('spMa'); 
           // $check=array();
           // $data=array();
           // foreach($x as $item)
           // {
           //      foreach($exist as $ser)
           //      {
           //          if($ser->spMa == $item->spMa)
           //          {
           //              if(in_array($item,$check)==false)
           //              {
           //                  array_push($check,$item);
           //              }
           //          }
           //      }
           //       if(in_array($item,$check)==false)
           //          {
           //              array_push($data,$item);
           //          }
           // }

           return view('admin.sanpham')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
     public function viewBinhluan()
     {
        if(Auth::user()->adTaikhoan != null)
        {
            Session::forget('dgTrangthai');
             $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
             // $data = DB::table("sanpham")->leftjoin('danhgia','danhgia.spMa',"=","sanpham.spMa")->orderBy('dgTrangthai','desc')->get();
             $data = DB::table("danhgia")->leftjoin('sanpham','sanpham.spMa',"=","danhgia.spMa")->orderBy('dgTrangthai','desc')->get();
            return view('admin.binhluan')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else
            { return Redirect('/adLogin'); }
     }
    public function viewKho()
    {
        if(Auth::user()->adTaikhoan != null)
        {
             $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data=DB::table('kho')->join('sanpham','sanpham.spMa','=','kho.spMa')->get();
            return view('admin.kho')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }    
    }
      public function viewKhoHong()
    {
        if(Auth::user()->adTaikhoan != null)
        {
             $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data=DB::table('kho_sp_hong')->join('sanpham','sanpham.spMa','=','kho_sp_hong.spMa')->get();
            return view('admin.kho-hong')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }    
    }

    public function viewLoai()
    {
         if(Auth::user()->adTaikhoan != null)
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
              $data = DB::table('loai')->get();
             return view('admin.loai')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }
     
       
    }
      public function viewThuonghieu()
    {
         if(Auth::user()->adTaikhoan != null)
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
              $data = DB::table('thuonghieu')->get();
        return view('admin.thuonghieu')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
      public function viewNhucau()
    {
        if(Auth::user()->adTaikhoan != null)
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
             $data=DB::table('nhucau')->get();
        return view('admin.nhucau')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
        

   public function viewBanner($trang,$vitri)
    {
         if(Auth::user()->adTaikhoan != null)
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);

            $vtTopdb = DB::table('slide')->select('bnVitri')
                    ->where('bnTrang',$trang)->orderBy('bnVitri','asc')->distinct()->limit(1)->get();
           
             $page = $trang;
            $vtEmpty = DB::table('slide')
                    ->where('bnTrang',$trang)->count();

            $vt1Empty = DB::table('slide')
                    ->where('bnVitri',1)
                    ->where('bnTrang',$trang)->count();

            $vt = DB::table('slide')->select('bnVitri')
                    ->where('bnTrang',$trang)
                    ->orderBy('bnVitri','asc')->distinct()->get();

            $default = DB::table('slide')
                    ->select('bnVitri')
                    ->where('bnVitri',$vitri)
                    ->where('bnTrang',$trang)->distinct()->get();

            $default2 = DB::table('slide')
                    ->select('bnVitri')
                    ->where('bnVitri',$vitri)
                    ->where('bnTrang',$trang)->first();

            $vtShow = $vitri;
            
           
         //N???u trang banner m???c ?????nh c?? v??? tr?? = 1
           if($vitri == 1)
           {
                $vtDB = DB::table('slide')->select('bnVitri')
                    ->where('bnTrang',$trang)->orderBy('bnVitri','asc')->limit(1)->first();  

                //N???u ch??a c?? d??? li???u trang m???c ?????nh
                if($vtDB==null)
                {
                    $data = DB::table('slide')->where('bnVitri',$vitri)
                    ->where('bnTrang',$trang)
                    ->orderBy('bnNgay','desc')->get();
                    return view('admin.banner')->with('data',$data)
                                        ->with('page',$page)
                                        ->with('vtEmpty',$vtEmpty)
                                        ->with('vt1Empty',$vt1Empty)
                                        ->with('vtTop',$vtTopdb)
                                        ->with('vtDefault',$default)
                                        ->with('vtDefault2',$default2)
                                        ->with('vitri',$vt)
                                        ->with('vtShow',$vtShow)
                                        ->with('noteDanhgia',$noteDanhgia)
                                        ->with('noteDonhang',$noteDonhang)
                                        ->with('noteDonhang1',$noteDonhang1);
                }
                //N???u c?? d??? li???u nh??ng v??? tr?? kh??c 1
                if($vtDB->bnVitri != 1)
                {
                    $vtDb= $vtDB->bnVitri;
                   // dd($vtDb);
                    $data = DB::table('slide')->where('bnVitri',$vtDb)
                    ->where('bnTrang',$trang)
                    ->orderBy('bnNgay','desc')->get();
                    return view('admin.banner')->with('data',$data)
                                        ->with('page',$page)
                                        ->with('vtEmpty',$vtEmpty)
                                        ->with('vt1Empty',$vt1Empty)
                                        ->with('vtTop',$vtTopdb)
                                        ->with('vtDefault',$default)
                                        ->with('vtDefault2',$default2)
                                        ->with('vitri',$vt)
                                        ->with('vtShow',$vtShow)
                                        ->with('noteDanhgia',$noteDanhgia)
                                        ->with('noteDonhang',$noteDonhang)
                                        ->with('noteDonhang1',$noteDonhang1);

                }
                //N???u c?? d??? li???u v??? tr?? m???c ??inh = 1
                if($vtDB->bnVitri == 1)
                {
                    $data = DB::table('slide')->where('bnVitri',$vitri)
                    ->where('bnTrang',$trang)
                    ->orderBy('bnNgay','desc')->get();
                    return view('admin.banner')->with('data',$data)
                                        ->with('page',$page)
                                        ->with('vtEmpty',$vtEmpty)
                                        ->with('vt1Empty',$vt1Empty)
                                        ->with('vtTop',$vtTopdb)
                                        ->with('vtDefault',$default)
                                        ->with('vtDefault2',$default2)
                                        ->with('vitri',$vt)
                                        ->with('vtShow',$vtShow)
                                        ->with('noteDanhgia',$noteDanhgia)
                                        ->with('noteDonhang',$noteDonhang)
                                        ->with('noteDonhang1',$noteDonhang1);

                }
              
           }
           //N???u trang banner thay ?????i v??? tr?? kh??c 1
           if($vitri != 1)
           {
            $data = DB::table('slide')->where('bnVitri',$vitri)
                    ->where('bnTrang',$trang)
                    ->orderBy('bnNgay','desc')->get();
             return view('admin.banner')->with('data',$data)
                                        ->with('page',$page)
                                        ->with('vtEmpty',$vtEmpty)
                                        ->with('vt1Empty',$vt1Empty)
                                        ->with('vtTop',$vtTopdb)
                                        ->with('vtDefault',$default)
                                        ->with('vtDefault2',$default2)
                                        ->with('vitri',$vt)
                                        ->with('vtShow',$vtShow)
                                        ->with('noteDanhgia',$noteDanhgia)
                                        ->with('noteDonhang',$noteDonhang)
                                        ->with('noteDonhang1',$noteDonhang1);
           }
        }
        else 
        { return Redirect('/adLogin'); }

    }

    public function viewLShoatdong()
    {
        if(Auth::user()->adTaikhoan != null)
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $alNgaygio = DB::table('admin_log')->distinct()->get('alNgaygio');
            $data = DB::table('admin_log')->leftjoin('admin','admin.adMa','=','admin_log.adMa')->orderBy('alNgaygio','desc')->get();
            return view('admin.lich-su-hoat-dong')->with('data',$data)->with('ngaygio',$alNgaygio)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
    //   public function viewLSgiaohang()
    // {
    //     if(Auth::user()->adTaikhoan != null)
    //     {
    //         $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
    //         Session::put('dgTrangthai',$noteDanhgia);
    //         $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
    //         Session::put('hdTinhtrang',$noteDonhang);
    //         $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
    //         Session::put('hdTinhtrang1',$noteDonhang1);
    //         if(Auth::user()->adQuyen != 4)
    //         {
    //              $data = DB::table('admin_log')
    //                         ->leftjoin('admin','admin.adMa','=','admin_log.adMa')
    //                         ->where('alChitiet','like','%'.'Giao h??ng:'.'%')
    //                         ->orderBy('alNgaygio','desc')->get();
    //         return view('admin.lich-su-giao-hang')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
    //         }
    //         else if(Auth::user()->adQuyen == 4)
    //         {
    //         $data = DB::table('admin_log')
    //                         ->leftjoin('admin','admin.adMa','=','admin_log.adMa')
    //                         ->where('')
    //                         ->orderBy('alNgaygio','desc')->get();
    //         return view('admin.lich-su-giao-hang')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
    //         }
           
    //     }
    //     else 
    //     { return Redirect('/adLogin'); }
       
    // }

    public function viewTintuc()
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);

        $data = DB::table('tintuc')->join('admin','admin.adMa','=','tintuc.adMa')->get();
        return view('admin.tin-tuc')
                                ->with('data',$data)->with('noteDanhgia',$noteDanhgia)
                                ->with('noteDonhang',$noteDonhang)
                                ->with('noteDonhang1',$noteDonhang1);
    }

    public function viewLoiThemHinhSP()
    {
        return view('admin.loiThemHinhSP');
    }
    public function viewLoiXoa()
    {
        return view("admin.loiXoa");
    }
    public function viewdonhang()
    {
        if(Auth::user()->adTaikhoan != null)
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data1=DB::table('donhang')
                            ->leftjoin('khachhang','khachhang.khMa','=','donhang.khMa')
                            ->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->get();
            $data2=DB::table('donhang')
                            ->leftjoin('khachhang','khachhang.khMa','=','donhang.khMa')
                            ->leftjoin('admin','admin.adMa','=','donhang.adMa')
                            ->where('hdTinhtrang',1)->orWhere('hdTinhtrang',4)->orWhere('hdTinhtrang',6)->orWhere('hdTinhtrang',8)->get();
            $data3=DB::table('donhang')
                            ->leftjoin('khachhang','khachhang.khMa','=','donhang.khMa')
                            ->leftjoin('admin','admin.adMa','=','donhang.adMa')
                            ->where('hdTinhtrang',2)->get();
            $data4=DB::table('donhang')
                            ->leftjoin('khachhang','khachhang.khMa','=','donhang.khMa')
                            ->leftjoin('admin','admin.adMa','=','donhang.adMa')
                            ->where('hdTinhtrang',9)->get();
            $data6=DB::table('donhang')
                            ->leftjoin('khachhang','khachhang.khMa','=','donhang.khMa')
                            ->leftjoin('admin','admin.adMa','=','donhang.adMa')
                            ->where('hdTinhtrang',5)->orWhere('hdTinhtrang',7)->get();

            $data5=DB::table('donhang')
                            ->leftjoin('khachhang','khachhang.khMa','=','donhang.khMa')
                            ->leftjoin('admin','admin.adMa','=','donhang.adMa')
                            ->where('hdTinhtrang',10)->get();
        return view('admin.don-hang')->with('data1',$data1)->with('data2',$data2)->with('data3',$data3)->with('data4',$data4)->with('data5',$data5)->with('data6',$data6)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }
    }
  

    public function viewQlPhieunhap()
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")
                    ->where('hdTinhtrang',3)->count();
        $pn = DB::table('phieunhap')
                    ->join('admin','admin.adMa','=','phieunhap.adMa')
                    ->orderBy('pnNgaylap','desc')
                    ->get();

        return view('admin.quan-ly-phieu-nhap',compact('pn','noteDanhgia','noteDonhang','noteDonhang1'));
    }
    public function nhanvienInfo($id)
    {
        $data = DB::table('admin')->where('adMa',$id)->get();
        return view('admin.thong-tin-nhan-vien',compact('data'));
    }
    public function viewGiaohang($id)
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")
                    ->where('hdTinhtrang',3)->count();
        $default = DB::table('admin')->where('adMa',$id)->count();
        $nvdefault = DB::table('admin')->where('adMa',$id)->first();
        $nv = DB::table('admin')->where('adQuyen',4)->get();
        if($default == 1 && $nvdefault->adMa == $id)
        {
            $note = DB::table('donhang')
                                ->where('adMa',$id)
                                ->where('hdTinhtrang',1)
                                ->count();
            $nvName = DB::table('admin')->where('adMa',$id)->first();
            $data = DB::table('donhang')
                                ->where('adMa',$id)
                                ->where('hdTinhtrang',1)
                                ->get();
            $data2 = DB::table('donhang')
                                ->where('adMa',$id)
                                ->where('hdTinhtrang',2)
                                ->get();
             return view('admin.quan-ly-giao-hang',compact('nv','data','data2','default','nvdefault','nvName','noteDanhgia','noteDonhang','noteDonhang1','note'));
        }
        else
        {
            $nvName = null;
            $data = DB::table('donhang')
                                    ->join('admin','admin.adMa','=','donhang.adMa')
                                    ->where('hdTinhtrang',1)
                                    ->get();
            $data2 = DB::table('donhang')
                                ->join('admin','admin.adMa','=','donhang.adMa')
                                ->where('hdTinhtrang',2)
                                ->get();
             return view('admin.quan-ly-giao-hang',compact('nv','data','data2','default','nvdefault','nvName','noteDanhgia','noteDonhang','noteDonhang1'));
        }
    }

    //////////////////////////////Add Manage
    

    // Nh??n vi??n
      public function themAdmin()
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
        return view('admin.themnhanvien',compact('noteDanhgia','noteDonhang','noteDonhang1'));
    }
    public function adCheckAddAdmin(Request $re)
    {
        if($re->adTen == null)
        {
             Session::flash('note_err','T??n kh??ng ???????c r???ng!!');
             return "<script>window.history.back();</script>"; 
        }
        if($re->adTaikhoan == null)
        {
             Session::flash('note_err','T??i kho???n kh??ng ???????c r???ng!');
             return "<script>window.history.back();</script>"; 
        }
         if($re->adSdt == null)
        {
             Session::flash('note_err','S??? ??i???n tho???i kh??ng ???????c r???ng!');
             return "<script>window.history.back();</script>"; 
        }
         if($re->adEmail == null)
        {
             Session::flash('note_err','Email kh??ng ???????c r???ng!');
             return "<script>window.history.back();</script>"; 
        }
        if($re->cmnd==null)
        {
             Session::flash('note_err','Ch???ng minh nh??n d??n kh??ng ???????c tr???ng!');
             return "<script>window.history.back();</script>"; 
        }
        if($re->adDiachi==null)
        {
             Session::flash('note_err','?????a ch??? kh??ng ???????c tr???ng!');
             return "<script>window.history.back();</script>"; 
        }
        if($re->adMatkhau==null)
        {
             Session::flash('note_err','M???t kh???u kh??ng ???????c tr???ng!');
             return "<script>window.history.back();</script>"; 
        }
        if(strlen($re->adTen) > 50)
        {
             Session::flash('note_err','T??n qu?? d??i!');
             return "<script>window.history.back();</script>"; 
        }
        if(strlen($re->adTaikhoan) > 50)
        {
             Session::flash('note_err','T??i kho???n qu?? d??i!');
             return "<script>window.history.back();</script>"; 
        }
        if(strlen($re->adMatkhau) > 50)
        {
             Session::flash('note_err','M???t kh???u qu?? d??i!');
             return "<script>window.history.back();</script>"; 
        }
        if(strlen($re->adSdt)<10 || strlen($re->adSdt)>11)
        {
             Session::flash('note_err','S??? ??i???n tho???i kh??ng ????ng!');
             return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->adEmail) > 50)
        {
             Session::flash('note_err','Email qu?? d??i!');
             return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->cmnd) > 12)
        {
             Session::flash('note_err','Ch???ng minh nh??n d??n kh??ng ????ng');
             return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->adDiachi) > 50)
        {
             Session::flash('note_err','?????a ch??? qu?? d??i');
             return "<script>window.history.back();</script>"; 
        }
        else
         {
            $dataBefore1 = DB::table('admin')->where('adTaikhoan',$re->adTaikhoan)->first();
            $dataBefore2 = DB::table('admin')->where('adEmail',$re->adEmail)->first();
            $dataBefore3 = DB::table('admin')->where('adSdt',$re->adSdt)->first();
            $dataBefore4 = DB::table('admin')->where('adHinhcmnd',$re->cmnd)->first();
            if($dataBefore1)
            {
                Session::flash('note_err','T??i kho???n ???? t???n t???i, vui l??ng nh???p t??i kho???n kh??c!');
               return "<script>window.history.back();</script>"; 
            
            }
            else if( $dataBefore2)
            {
                Session::flash('note_err','Email ???? t???n t???i, vui l??ng nh???p email kh??c!');
                return "<script>window.history.back();</script>"; 
            }
            else if( $dataBefore3)
            {
                Session::flash('note_err','S??? ??i???n tho???i ???? t???n t???i, vui l??ng nh???p s??? kh??c!');
               return "<script>window.history.back();</script>"; 
            }
            else if( $dataBefore4)
            {
                Session::flash('note_err','???? c?? nh??n vi??n c?? ch???ng minh nh??n d??n n??y!');
              return "<script>window.history.back();</script>";
            }
           else
           {
                if($re->hasFile('adHinh')==true)
                {
                    $data = array();
                    $data['adMa']=rand(0,1000).strlen($re->adTen);
                    $data['adTen']=$re->adTen;
                    $data['adTaikhoan']=$re->adTaikhoan;
                    $data['adMatkhau']=$re->adMatkhau;
                    $data['adSdt']=$re->adSdt;
                    $data['adHinhcmnd']=$re->cmnd;
                     $data['adDiachi']=$re->adDiachi;
                    $data['adEmail']=$re->adEmail;
                    $data['adHinh'] = $re->file('adHinh')->getClientOriginalName();
                    $imgextention=$re->file('adHinh')->extension();
                                $file=$re->file('adHinh');
                                $file->move('public/images/nhanvien',$data['adHinh']);
                    $data['adQuyen']=$re->adQuyen;
                    $data['adTinhtrang']=1;
                    DB::table('admin')->insert($data);

                    $data1 = array();
                    $data1['adMa'] = Auth::user()->adMa;
                    $data1['alChitiet'] = "Th??m nh??n m???i: ".$re->adTen;
                    $data1['alNgaygio']= now();
                    DB::table('admin_log')->insert($data1);

                    Session::forget('ad_err');
                    return redirect('adNhanvien');
                    }
                    else
                    {
                    Session::flash("note_err","H??nh c???a nh??n vi??n kh??ng ???????c tr???ng!");
                    return "<script>window.history.back();</script>"; 
                    }
            }
        }
    }
 
    public function adDeleteAdmin($id)
    {
      $db = DB::table('admin')->select('adTen')->where('adMa',$id)->first();
               
          $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "X??a nh??n vi??n:".$db->adTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);


            $data = array();
            $data['adTinhtrang']=99;
            DB::table('admin')->where('adMa',$id)->update($data);
         return redirect('adNhanvien');
        
    }

     public function adUpdateAdmin($id)
    {
        $hadData = DB::table('admin')->where('adMa',$id)->get();
        return view('admin.suanhanvien')->with('adMaCu',$hadData);
    }
    public function editAdmin(Request $re, $id)
    {
      if($re->adTen == null)
        {
             Session::flash('note_err','T??n kh??ng ???????c r???ng!!');
             return "<script>window.history.back();</script>"; 
        }
        if($re->adTaikhoan == null)
        {
             Session::flash('note_err','T??i kho???n kh??ng ???????c r???ng!');
             return "<script>window.history.back();</script>"; 
        }
         if($re->adSdt == null)
        {
             Session::flash('note_err','S??? ??i???n tho???i kh??ng ???????c r???ng!');
             return "<script>window.history.back();</script>"; 
        }
         if($re->adEmail == null)
        {
             Session::flash('note_err','Email kh??ng ???????c r???ng!');
             return "<script>window.history.back();</script>"; 
        }
        if($re->cmnd==null)
        {
             Session::flash('note_err','Ch???ng minh nh??n d??n kh??ng ???????c tr???ng!');
             return "<script>window.history.back();</script>"; 
        }
        if($re->adDiachi==null)
        {
             Session::flash('note_err','?????a ch??? kh??ng ???????c tr???ng!');
             return "<script>window.history.back();</script>"; 
        }
       
        if(strlen($re->adTen) > 50)
        {
             Session::flash('note_err','T??n qu?? d??i!');
             return "<script>window.history.back();</script>"; 
        }
        if(strlen($re->adTaikhoan) > 50)
        {
             Session::flash('note_err','T??i kho???n qu?? d??i!');
             return "<script>window.history.back();</script>"; 
        }
       
        if(strlen($re->adSdt)<10 || strlen($re->adSdt)>11)
        {
             Session::flash('note_err','S??? ??i???n tho???i kh??ng ????ng!');
             return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->adEmail) > 50)
        {
             Session::flash('note_err','Email qu?? d??i!');
             return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->cmnd) > 12)
        {
             Session::flash('note_err','Ch???ng minh nh??n d??n kh??ng ????ng');
             return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->adDiachi) > 50)
        {
             Session::flash('note_err','?????a ch??? qu?? d??i');
             return "<script>window.history.back();</script>"; 
        }
        else
        {
            if($re->hasFile('adHinh')==true)
            {
                $db = DB::table('admin')->where('adMa',$id)->get();
                $a = array($db);
                $adTen = str_replace('"','',json_encode($a[0][0]->adTen));
                $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "C???p nh???t nh??n vi??n:".$adTen."->".$re->adTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

                $data = array();
                $data['adMa']=$id;
                $data['adTen']=$re->adTen;
                $data['adTaikhoan']=$re->adTaikhoan;
                //$data['adMatkhau']=$re->adMatkhau;
                $data['adSdt']=$re->adSdt;
                $data['adHinhcmnd']=$re->cmnd;
                $data['adDiachi']=$re->adDiachi;
                $data['adEmail']=$re->adEmail;
                $data['adHinh'] = $re->file('adHinh')->getClientOriginalName();
                $imgextention=$re->file('adHinh')->extension();
                            $file=$re->file('adHinh');
                            $file->move('public/images/nhanvien',$data['adHinh']);
                $data['adQuyen']=$re->adQuyen;
                DB::table('admin')->where('adMa',$id)->update($data);
                return redirect('adNhanvien');
            }
            else
            {
                $db = DB::table('admin')->where('adMa',$id)->first();
                
                $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "C???p nh???t nh??n vi??n:".$db->adTen."->".$re->adTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

                $data = array();
                $data['adMa']=$id;
                $data['adTen']=$re->adTen;
                $data['adTaikhoan']=$re->adTaikhoan;
                //$data['adMatkhau']=$re->adMatkhau;
                $data['adEmail']=$re->adEmail;
                $data['adSdt']=$re->adSdt;
                $data['adHinhcmnd']=$re->cmnd;
                $data['adDiachi']=$re->adDiachi;
                 $data['adQuyen']=$re->adQuyen;
                DB::table('admin')->where('adMa',$id)->update($data);
                return redirect('adNhanvien');
            }
            
        }
    }

    // End Nh??n vi??n
    //  Khach h??ng
      public function themkhachhang()
    {
        return view('admin.themkhachhang');
    }
    public function adCheckAddKhachhang(Request $re)
    {
        if($re->khTen ==null||$re->khTaikhoan == null||$re->khMatkhau == null||$re->khEmail==null||$re->khDiachi==null||$re->khNgaysinh==null||$re->khGioitinh==null)
        {

             Session::flash('note_err','Kh??ng ???????c ????? tr???ng th??ng tin!');
                  return "<script>window.history.back();</script>"; 
        }
        if($re->khGioitinh == null || $re->khGioitinh == 0)
        {
              Session::flash('note_err','Vui l??ng ch???n gi???i t??nh!');
                  return "<script>window.history.back();</script>"; 
        }
        if($re->khNgaysinh == null || $re->khNgaysinh == 0)
        {
              Session::flash('note_err','Vui l??ng ch???n ng??y sinh!');
                  return "<script>window.history.back();</script>"; 
        }
        if(strlen($re->khTen) > 50)
        {
            Session::flash('note_err','T??n qu?? d??i!');
                  return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->khTaikhoan) > 50)
        {
            Session::flash('note_err','T??i kho???n qu?? d??i!');
                  return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->khMatkhau) > 50)
        {
            Session::flash('note_err','M???t kh???u qu?? d??i!');
                  return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->khEmail) > 50)
        {
            Session::flash('note_err','Email qu?? d??i!');
                  return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->khDiachi) > 255)
        {
            Session::flash('note_err','?????a ch??? qu?? d??i!');
            return "<script>window.history.back();</script>"; 
        }
        else
        {
                $dataBefore1 = DB::table('khachhang')->where('khTaikhoan',$re->khTaikhoan)->first();
                $dataBefore2 = DB::table('khachhang')->where('khEmail',$re->khEmail)->first();
                $dataBefore3 = DB::table('khachhang')->where('khSdt',$re->khSdt)->first();
                $yearNow = Carbon::now()->year;
                $yearKh = new Carbon($re->khNgaysinh);
                $yearKhNgaysinh = $yearKh->year;
                if($yearNow - $yearKhNgaysinh<=10)
                {
                   Session::flash('note_err','Kh??ch h??ng ph???i tr??n 10 tu???i');
                    return "<script>window.history.back();</script>"; 
                }
                if($dataBefore1)
                {
                    Session::flash('note_err','T??i kho???n ???? t???n t???i, vui l??ng nh???p t??i kho???n kh??c!');
                    return "<script>window.history.back();</script>"; 
                }
                else if( $dataBefore2)
                {
                    Session::flash('note_err','Email ???? t???n t???i, vui l??ng nh???p email kh??c!');
                   return "<script>window.history.back();</script>"; 
                }
                else if( $dataBefore3)
                {
                    Session::flash('note_err','S??? ??i???n tho???i ???? t???n t???i, vui l??ng nh???p s??? kh??c!');
                   return "<script>window.history.back();</script>"; 
                }
                if($re->hasFile('khHinh'))
                {
                    $data = array();
                    $data['khMa']=rand(0,100).strlen($re->khTen).strlen($re->khEmail);
                    $data['khTen']=$re->khTen;
                    $data['khEmail']=$re->khEmail;
                    $data['khMatkhau']=md5($re->khMatkhau);
                    $data['khNgaysinh']=$re->khNgaysinh;
                    $data['khDiachi']=$re->khDiachi;
                    $data['khGioitinh']=$re->khGioitinh;
                    $data['khTaikhoan']=$re->khTaikhoan;
                    $data['khSdt']=$re->khSdt;
                    $data['khHinh'] = $re->file('khHinh')->getClientOriginalName();
                        $imgextention=$re->file('khHinh')->extension();
                                    $file=$re->file('khHinh');
                                    $file->move('public/images/khachhang',$data['khHinh']);
                   $data['khXtemail'] = 1;
                    $data['khResetpassword']=null;
                    $data['khNgaythamgia']=now();
                    $data['khQuyen']=0;
                    
                    DB::table('khachhang')->insert($data);
                    Session::forget('kh_err');
                    return redirect('adKhachhang');
                }
                else
                {
                    $data = array();
                    $data['khMa']=rand(0,100).strlen($re->khTen).strlen($re->khEmail);
                    $data['khTen']=$re->khTen;
                    $data['khEmail']=$re->khEmail;
                    $data['khMatkhau']=md5($re->khMatkhau);
                    $data['khNgaysinh']=$re->khNgaysinh;
                    $data['khDiachi']=$re->khDiachi;
                    $data['khGioitinh']=$re->khGioitinh;
                    $data['khTaikhoan']=$re->khTaikhoan;
                    $data['khSdt']=$re->khSdt;
                    $data['khHinh'] = "";
                    $data['khXtemail'] = 1;
                    $data['khResetpassword']=null;
                    $data['khNgaythamgia']=now();
                    $data['khQuyen']=0;
                    DB::table('khachhang')->insert($data);
                    Session::forget('kh_err');
                    return redirect('adKhachhang');
                }
            
            
        }
        
    }
    public function adDeleteKhachhang($id)
    {
        DB::table('khachhang')->where('khMa',$id)->delete();
         return redirect('adKhachhang');
    }
     public function adUpdatekhachhang($id)
    {
        $hadData = DB::table('khachhang')->where('khMa',$id)->get();
        return view('admin.suakhachhang')->with('khMaCu',$hadData);
    }
    public function editkhachhang(Request $re, $id)
    {
        if($re->khTen ==null||$re->khTaikhoan == null||$re->khMatkhau == null||$re->khEmail==null||$re->khDiachi==null||$re->khNgaysinh==null||$re->khGioitinh==null)
        {

             Session::flash('note_err','Kh??ng ???????c ????? tr???ng th??ng tin!');
                  return "<script>window.history.back();</script>"; 
        }
        if($re->khGioitinh == null || $re->khGioitinh == 0)
        {
              Session::flash('note_err','Vui l??ng ch???n gi???i t??nh!');
                  return "<script>window.history.back();</script>"; 
        }
        if($re->khNgaysinh == null || $re->khNgaysinh == 0)
        {
              Session::flash('note_err','Vui l??ng ch???n ng??y sinh!');
                  return "<script>window.history.back();</script>"; 
        }
        if(strlen($re->khTen) > 50)
        {
            Session::flash('note_err','T??n qu?? d??i!');
                  return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->khTaikhoan) > 50)
        {
            Session::flash('note_err','T??i kho???n qu?? d??i!');
                  return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->khMatkhau) > 50)
        {
            Session::flash('note_err','M???t kh???u qu?? d??i!');
                  return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->khEmail) > 50)
        {
            Session::flash('note_err','Email qu?? d??i!');
                  return "<script>window.history.back();</script>"; 
        }
         if(strlen($re->khDiachi) > 255)
        {
            Session::flash('note_err','?????a ch??? qu?? d??i!');
            return "<script>window.history.back();</script>"; 
        }
        else
        {
            $yearNow = Carbon::now()->year;
            $yearKh = new Carbon($re->khNgaysinh);
            $yearKhNgaysinh = $yearKh->year;
            if($yearNow - $yearKhNgaysinh<=10)
            {
                Session::flash('note_err','Kh??ch h??ng ph???i tr??n 10 tu???i');
                return "<script>window.history.back();</script>"; 
            }
            if($re->hasFile('khHinh')==true)
            {
                $data = array();
                $data['khTen']=$re->khTen;
                $data['khEmail']=$re->khEmail;
                $data['khMatkhau']=md5($re->khMatkhau);
                $data['khNgaysinh']=$re->khNgaysinh;
                $data['khDiachi']=$re->khDiachi;
                $data['khGioitinh']=$re->khGioitinh;
                $data['khTaikhoan']=$re->khTaikhoan;
                $data['khSdt']=$re->khSdt;
                $data['khHinh'] = $re->file('khHinh')->getClientOriginalName();
                    $imgextention=$re->file('khHinh')->extension();
                                $file=$re->file('khHinh');
                                $file->move('public/images/khachhang',$data['khHinh']);
                 $data['khQuyen']=$re->khQuyen;
                DB::table('khachhang')->where('khMa',$id)->update($data);
                return redirect('adKhachhang');
            }
            else
            {
                $data = array();
                $data['khTen']=$re->khTen;
                $data['khEmail']=$re->khEmail;
                $data['khMatkhau']=md5($re->khMatkhau);
                $data['khNgaysinh']=$re->khNgaysinh;
                $data['khDiachi']=$re->khDiachi;
                $data['khGioitinh']=$re->khGioitinh;
                $data['khTaikhoan']=$re->khTaikhoan;
                $data['khSdt']=$re->khSdt;
                $data['khQuyen']=$re->khQuyen;
                DB::table('khachhang')->where('khMa',$id)->update($data);
                return redirect('adKhachhang');
            }
           
        }
    }
      public function khoaKH($id)
    {
        $khQuyen = DB::table('khachhang')->select('khQuyen')->where('khMa',$id)->first();
        $data = array();
        if($khQuyen->khQuyen ==0)
        {
            $data['khQuyen'] = 1;
        }
        else
        {
             $data['khQuyen'] = 0;
        }
        DB::table('khachhang')->where('khMa',$id)->update($data);

                return redirect()->back(); 
    }
    // End kh??ch h??ng
    
    // S???n ph???m
    public function themSanpham()
    {
        $kmMa=DB::table('khuyenmai')->get();
        $loaiMa=DB::table('loai')->select('loaiMa','loaiTen')->get();
        $thMa=DB::table('thuonghieu')->select('thMa','thTen')->get();
        $ncMa=DB::table('nhucau')->select('ncMa','ncTen')->get();
        $nccMa=DB::table('nhacungcap')->select('nccMa','nccTen')->get();

        return view('admin.themsanpham')->with('kmMa',$kmMa)->with('loaiMa',$loaiMa)->with('thMa',$thMa)->with('ncMa',$ncMa)->with('nccMa',$nccMa);
    }
    public function adCheckAddSanpham(Request $re)
    {
        if($re->spTen == null)
        {
            Session::flash('note_err','Vui l??ng ??i???n t??n s???n ph???m!!');
                      return "<script>window.history.back();</script>"; 
        }
        if(strlen($re->spTen) > 50)
        {
            Session::flash('note_err','T??n s???n ph???m qu?? d??i!');
                      return "<script>window.history.back();</script>"; 
        }
        if($re->spHanbh == null)
        {
            Session::flash('note_err','Vui l??ng ch???n h???n b???o h??ng!');
                      return "<script>window.history.back();</script>"; 
        }
         if($re->ram == null || $re->cpu == null|| $re->ocung == null)
                    {
                    Session::flash('note_err','Vui l??ng ??i???n ?????y ????? th??ng tin!');
                      return "<script>window.history.back();</script>"; 
            }
        else
        {  
            if($re->hasFile('img')==true)
            {
                $dataBefore = DB::table('sanpham')->where('spTen',$re->spTen)->first();
                if( $dataBefore)
                {
                    Session::flash('note_err','S???n ph???m ???? c?? s???n trong d??? li???u!');
                      return "<script>window.history.back();</script>"; 
                }
                else
                {
                $spMa = rand(0,100).strlen($re->spGia).strlen($re->spTen).rand(0,1000);
                $data = array();
                $data['spMa']=$spMa;
                $data['spTen']=$re->spTen;
                $data['spGia']=0;
                $data['spHanbh']=$re->spHanbh;
                $data['kmMa']=null;
                $data['thMa']=$re->thMa;
                $data['loaiMa']=$re->loaiMa;
                $data['ncMa']=$re->ncMa;
                $data['nccMa']=$re->nccMa;
                $data['kmMa']=$re->kmMa;
                
                

                $dataLog = array();
                $dataLog['adMa'] = Auth::user()->adMa;
                $dataLog['alChitiet'] = "Th??m s???n ph???m m???i:".$re->spTen;
                $dataLog['alNgaygio']= now();
                DB::table('admin_log')->insert($dataLog);


                if($re->loaiMa==1)
                {
                    if($re->manhinh == null || $re->chuot == null|| $re->banphim == null|| $re->pin == null|| $re->tannhiet == null|| $re->loa == null|| $re->mau == null|| $re->trongluong == null|| $re->conggiaotiep == null|| $re->webcam == null|| $re->chuanlan == null|| $re->chuanwifi == null|| $re->hedieuhanh == null)
                    {
                    Session::flash('note_err','Vui l??ng ??i???n ?????y ????? th??ng tin c???a s???n ph???m laptop!');
                      return "<script>window.history.back();</script>"; 
                    }
                    else
                    {
                        $data2 = array();
                        $data2['spMa']= $spMa;
                        $data2['ram'] = $re->ram;
                        $data2['cpu'] = $re->cpu;
                        $data2['ocung'] = $re->ocung;
                        $data2['psu'] = "";
                        $data2['vga'] = "";
                        $data2['mainboard'] = "";
                        $data2['manhinh'] = $re->manhinh;
                        $data2['chuot'] = $re->chuot;
                        $data2['banphim'] = $re->banphim;
                        $data2['vocase'] = "";
                        $data2['pin'] = $re->pin;
                        $data2['tannhiet'] = $re->tannhiet;
                        $data2['loa'] =$re->loa;
                        $data2['mau']=$re->mau;
                        $data2['trongluong'] = $re->trongluong;
                        $data2['conggiaotiep'] = $re->conggiaotiep;
                        $data2['webcam'] = $re->webcam;
                        $data2['chuanlan'] = $re->chuanlan;
                        $data2['chuanwifi'] = $re->chuanwifi;
                        $data2['hedieuhanh'] = $re->hedieuhanh;

                         DB::table('sanpham')->insert($data);
                        DB::table('mota')->insert($data2);

                       
                    }
                }
               if($re->loaiMa == 2)
               {
                 if($re->psu == null || $re->vga == null|| $re->case == null|| $re->mainboard == null)
                    {
                    Session::flash('note_err','Vui l??ng ??i???n ?????y ????? th??ng tin c???a s???n ph???m PC!');
                      return "<script>window.history.back();</script>"; 
                    }
                    else
                    {
                    $data2 = array();
                    $data2['spMa']= $spMa;
                    $data2['ram'] = $re->ram;
                    $data2['cpu'] = $re->cpu;
                    $data2['ocung'] = $re->ocung;
                    $data2['psu'] = $re->psu;
                    $data2['vga'] = $re->vga;
                    $data2['mainboard'] = $re->mainboard;
                    $data2['manhinh'] = "";
                    $data2['chuot'] = "";
                    $data2['banphim'] = "";
                    $data2['vocase'] = $re->case;
                    $data2['pin'] = "";
                    $data2['tannhiet'] = "";
                    $data2['loa'] ="";
                    $data2['mau']="";
                    $data2['trongluong'] = "";
                    $data2['conggiaotiep'] = "";
                    $data2['webcam'] = "";
                    $data2['chuanlan'] = "";
                    $data2['chuanwifi'] = "";
                    $data2['hedieuhanh'] = "";

                     DB::table('sanpham')->insert($data);
                    DB::table('mota')->insert($data2);

                   
                    }
                }
              
                $data3 = array();
                $data3['spMa']= $spMa;
                $data3['spHinh']=$re->file('img')->getClientOriginalName();
                        $imgextention=$re->file('img')->extension();
                        $file=$re->file('img');
                        $file->move('public/images/products',$data3['spHinh']);
                 $data3['thutu'] = 1;
                DB::table('hinh')->insert($data3);

                //END
                return redirect('adSanpham');
                }
              }
            else
            {
              Session::flash('note_err','Vui l??ng th??m ???nh ?????i di???n cho s???n ph???m!');
                      return "<script>window.history.back();</script>"; 
            }
        }

    }
  
    public function adDeleteSanpham($id)
    {
        $db = DB::table('sanpham')->select('spTen')->where('spMa',$id)->first();
          $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "X??a s???n ph???m: ".$db->spTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
        DB::table('sanpham')->where('spMa',$id)->delete();
         return redirect('adSanpham');
    }
    public function adUpdateSanpham($id)
    {
        $spMa=DB::table('sanpham')->where('spMa',$id)->first();
        $ncOld = DB::table('nhucau')->where('ncMa',$spMa->ncMa)->get();
        $kmOld = DB::table('khuyenmai')->where('kmMa',$spMa->kmMa)->get(); 
        $loaiOld = DB::table('loai')->where('loaiMa',$spMa->loaiMa)->get(); 
        $thOld = DB::table('thuonghieu')->where('thMa',$spMa->thMa)->get();
        $nccOld = DB::table('nhacungcap')->where('nccMa',$spMa->nccMa)->get();
        //
        $kmMa=DB::table('khuyenmai')->get();
        $loaiMa=DB::table('loai')->get();
        $thMa=DB::table('thuonghieu')->get();
        $ncMa=DB::table('nhucau')->get();
        $nccMa=DB::table('nhacungcap')->get();
        $mota=DB::table('mota')->where('spMa',$id)->get();
        $hinh=DB::table('hinh')->where('spMa',$id)->get();
        $kho=DB::table('kho')->where('spMa',$id)->get();
        $data = DB::table('sanpham')->where('spMa',$id)->get();
        return view('admin.suasanpham')->with('spMaCu',$data)->with('kmMa',$kmMa)->with('loaiMa',$loaiMa)->with('thMa',$thMa)->with('ncMa',$ncMa)->with('mota',$mota)->with('kho',$kho)->with('hinh',$hinh)->with('ncOld',$ncOld)->with('kmOld',$kmOld)->with('loaiOld',$loaiOld)->with('thOld',$thOld)->with('nccOld',$nccOld)->with('nccMa',$nccMa);
    }
   
    public function editSanpham(Request $re, $id)
    {
             if($re->spTen == null)
            {
                Session::flash('note_err','Vui l??ng ??i???n t??n s???n ph???m!!');
                          return "<script>window.history.back();</script>"; 
            }
            if(strlen($re->spTen) > 50)
            {
                Session::flash('note_err','T??n s???n ph???m qu?? d??i!');
                          return "<script>window.history.back();</script>"; 
            }
            if($re->spHanbh == null)
            {
                Session::flash('note_err','Vui l??ng ch???n h???n b???o h??ng!');
                          return "<script>window.history.back();</script>"; 
            }
             if($re->ram == null || $re->cpu == null|| $re->ocung == null)
                        {
                        Session::flash('note_err','Vui l??ng ??i???n ?????y ????? th??ng tin!');
                          return "<script>window.history.back();</script>"; 
            }
            else
            {
                $dataLog = array();
                $dataLog['adMa'] = Auth::user()->adMa;
                $dataLog['alChitiet'] = "C???p nh???t s???n ph???m:".$re->spTen;
                $dataLog['alNgaygio']= now();
                DB::table('admin_log')->insert($dataLog);

                $data = array();
                $data['spMa']=$re->spMa;
                $data['spTen']=$re->spTen;
                $data['spHanbh']=$re->spHanbh;
                $data['kmMa']=null;
                $data['thMa']=$re->thMa;
                $data['nccMa']=$re->nccMa;
                $data['loaiMa']=$re->loaiMa;
                $data['ncMa']=$re->ncMa;
                $data['spSlkmtoida']=$re->spSlkmtoida;

                 if($re->loaiMa==1)
                {
                     if($re->manhinh == null || $re->chuot == null|| $re->banphim == null|| $re->pin == null|| $re->tannhiet == null|| $re->loa == null|| $re->mau == null|| $re->trongluong == null|| $re->conggiaotiep == null|| $re->webcam == null|| $re->chuanlan == null|| $re->chuanwifi == null|| $re->hedieuhanh == null)
                    {
                    Session::flash('note_err','Vui l??ng ??i???n ?????y ????? th??ng tin c???a s???n ph???m laptop!');
                      return "<script>window.history.back();</script>"; 
                    }
                    else
                    {
                    $data2 = array();
                    $data2['spMa']= $id;
                    $data2['ram'] = $re->ram;
                    $data2['cpu'] = $re->cpu;
                    $data2['ocung'] = $re->ocung;
                    $data2['psu'] = "";
                    $data2['vga'] = "";
                    $data2['mainboard'] = "";
                    $data2['manhinh'] = $re->manhinh;
                    $data2['chuot'] = $re->chuot;
                    $data2['banphim'] = $re->banphim;
                    $data2['vocase'] = "";
                    $data2['pin'] = $re->pin;
                    $data2['tannhiet'] = $re->tannhiet;
                    $data2['loa'] =$re->loa;
                    $data2['mau']=$re->mau;
                    $data2['trongluong'] = $re->trongluong;
                    $data2['conggiaotiep'] = $re->conggiaotiep;
                    $data2['webcam'] = $re->webcam;
                    $data2['chuanlan'] = $re->chuanlan;
                    $data2['chuanwifi'] = $re->chuanwifi;
                    $data2['hedieuhanh'] = $re->hedieuhanh;

                     DB::table('sanpham')->where('spMa',$id)->update($data);
                   DB::table('mota')->where('spMa',$id)->update($data2);
               }
            }
               else if($re->loaiMa==2)
               {
                 if($re->psu == null || $re->vga == null|| $re->case == null|| $re->mainboard == null)
                    {
                    Session::flash('note_err','Vui l??ng ??i???n ?????y ????? th??ng tin c???a s???n ph???m PC!');
                      return "<script>window.history.back();</script>"; 
                    }
                    else
                    {
                    $data2 = array();
                    $data2['spMa']= $id;
                    $data2['ram'] = $re->ram;
                    $data2['cpu'] = $re->cpu;
                    $data2['ocung'] = $re->ocung;
                    $data2['psu'] = $re->psu;
                    $data2['vga'] = $re->vga;
                    $data2['mainboard'] = $re->mainboard;
                    $data2['manhinh'] = "";
                    $data2['chuot'] = "";
                    $data2['banphim'] = "";
                    $data2['vocase'] = $re->case;
                    $data2['pin'] = "";
                    $data2['tannhiet'] = "";
                    $data2['loa'] ="";
                    $data2['mau']="";
                    $data2['trongluong'] = "";
                    $data2['conggiaotiep'] = "";
                    $data2['webcam'] = "";
                    $data2['chuanlan'] = "";
                    $data2['chuanwifi'] = "";
                    $data2['hedieuhanh'] = "";
                     DB::table('sanpham')->where('spMa',$id)->update($data);
                    DB::table('mota')->where('spMa',$id)->update($data2);
                    }
                }
                
                
                 DB::table('mota')->where('spMa',$id)->update($data2);

                 return redirect('/updateSanpham/'.$re->spMa);
            }

        
    }
    public function editStatusHinh($tenhinh, $id)
    {
        $count = DB::table('hinh')->where('spMa',$id)->select("spHinh")->where("thutu","1")->count();
        $oldDB = DB::table('hinh')->where('spMa',$id)->where("thutu","1")->first();
        if($count == 0)
        {
            $data = array();
            $data["thutu"] = 1;
            DB::table('hinh')->where('spHinh',$tenhinh)->update($data);
            return redirect('/updateSanpham/'.$id);
        }
        elseif($count>=1)
        {
           
            $data1 = array();
            $data1["thutu"] = 0;
            DB::table('hinh')->where('spHinh',$oldDB->spHinh)->update($data1);

              $data = array();
                $data["thutu"] = 1;
                DB::table('hinh')->where('spHinh',$tenhinh)->update($data);
                return redirect('/updateSanpham/'.$id);
        }
    }
    public function addHinhSanpham(Request $re)
    {
       
        if($re->hasFile('img')==true)
        {
            $data = array();
            $data['spMa']=$re->spMa;
            $data['sphinh']=$re->file('img')->getClientOriginalName();
                $imgextention = $re->file('img')->extension();
                $file = $re->file('img');
                $file->move('public/images/products',$data['sphinh']);
             $data['thutu']=0;
                 DB::table('hinh')->insert($data);
                Session::forget('img_err','Ch??a ch???n ???nh!');
                return redirect('/updateSanpham/'.$re->spMa);
        }
        else
        {
        Session::put('img_err','Ch??a ch???n ???nh!');
        return redirect('/updateSanpham/'.$re->spMa);

        }
    }
    public function deleteHinhSanpham($tenhinh,$id)
    {
        
        DB::table('hinh')->where('spHinh',$tenhinh)->delete();
        return redirect('/updateSanpham/'.$id);

    }
    public function sanphamHienAn($id)
    {
        $spTinhtrang = DB::table('sanpham')->select('spTinhtrang')->where('spMa',$id)->first();
        $data = array();
        if($spTinhtrang->spTinhtrang ==0)
        {
            $data['spTinhtrang'] = 1;
        }
        else
        {
             $data['spTinhtrang'] = 0;
        }
        DB::table('sanpham')->where('spMa',$id)->update($data);

                return redirect()->back(); 
    }
    //End s???n ph???m
   

    //Loai
    public function adCheckAddLoai(Request $re)
    {
        if($re->loaiTen == null)
        {
            Session::forget('loai_err');
            $messages =[
                'loaiTen.required'=>'T??n lo???i kh??ng ???????c ????? tr???ng',
            ];
            $this->validate($re,[
                'loaiTen'=>'required',
            ],$messages);

            $errors=$validate->errors();
        }
        else
        {
             $dataBefore=DB::table('loai')->where('loaiTen',$re->loaiTen)->first();
            if($dataBefore)
            {
                Session::flash('note_err',"Lo???i ???? t???n t???i!");
                 return "<script>window.history.back();</script>"; 
            }
            else
            {
                $data = array();

                $data['loaiTen']=$re->loaiTen;
                DB::table('loai')->insert($data);

                $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "Th??m lo???i m???i:".$re->loaiTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
  
                return redirect('adLoai');
            }
        }
    }

    public function adDeleteLoai($id)
    {
        $exist = DB::table('sanpham')->where('loaiMa',$id)->count();
        if($exist >= 1)
        {
             //Session::flash('note_err','???? c?? s???n ph???m thu???c lo???i n??y, kh??ng ???????c x??a!');
            return response()->json(['message'=>1]);
        }
        else
        {
        $dbOld = DB::table('loai')->select('loaiTen')->where('loaiMa',$id)->first();
               
          $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "X??a lo???i:".$dbOld->loaiTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
       
        DB::table('loai')->where('loaiMa',$id)->delete();
        return response()->json(['message'=>0]);
       // return redirect('adLoai');
        }
    }
    public function editLoai(Request $re, $id)
    {  
        if($re->loaiTen==null)
        {
            Session::flash('note_err','Kh??ng ???????c ????? r???ng!');
             return "<script>window.history.back();</script>"; 
        }
        else
        {
                $dbOld = DB::table('loai')->select('loaiTen')->where('loaiMa',$id)->first();
               
                $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "S???a lo???i:".$dbOld->loaiTen."->".$re->loaiTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

                $data = array();
                $data['loaiTen'] = $re->loaiTen;
                DB::table('loai')->where('loaiMa',$id)->update($data);
                return redirect('adLoai');
        }
    }
    //End Loai
    
    //Nhu cau
  
    public function adCheckAddNhucau(Request $re)
    {
       if($re->ncTen == null)
        {
          return response()->json(['message'=>1]);
        }
        if(strlen($re->ncTen) > 30)
        {
          return response()->json(['message'=>3]);
        }
        else
        {
              $dataBefore=DB::table('nhucau')->where('ncTen',$re->ncTen)->first();
            if($dataBefore)
            {
                // Session::flash('note_err',"Nhu c???u ???? t???n t???i!");
                //   return "<script>window.history.back();</script>"; 
                 return response()->json(['message'=>2]);
            }
            else
            {
            $data = array();
            $data['ncTen']=$re->ncTen;
            DB::table('nhucau')->insert($data);

               $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "Th??m nhu c???u m???i:".$re->ncTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
           // return redirect('adNhucau');
           $retu = DB::table('nhucau')->where('ncTen',$re->ncTen)->first();
           return response()->json(['message'=>0,'ncMa'=>$retu->ncMa,'ncTen'=>$retu->ncTen]);
            }
        }
    }
    public function adDeleteNhucau($id)
    {

        $exist = DB::table('sanpham')->where('ncMa',$id)->count();
        if($exist >= 1)
        {
            //  Session::flash('note_err','???? c?? s???n ph???m thu???c nhu c???u n??y, kh??ng ???????c x??a!');
            //  return "<script>window.history.back();</script>"; 
             return response()->json(['message'=>1]);
        }
        else
        {
         $db = DB::table('nhucau')->select('ncTen')->where('ncMa',$id)->first();
          $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "X??a nhu c???u:".$db->ncTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
        DB::table('nhucau')->where('ncMa',$id)->delete();
        //return redirect('adNhucau');
         return response()->json(['message'=>0]);
        }

    }
    public function editNhucau(Request $re, $id)
    {
          if($re->ncTen==null)
        {
            Session::flash('note_err','Kh??ng ???????c ????? r???ng!');
              return "<script>window.history.back();</script>"; 
        }
        else
        {
             $db = DB::table('nhucau')->select('ncTen')->where('ncMa',$id)->first();
                    
                $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "S???a nhu c???u:".$db->ncTen."->".$re->ncTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

            $data = array();
            $data['ncTen'] = $re->ncTen;
            DB::table('nhucau')->where('ncMa',$id)->update($data);
            return redirect('adNhucau');
        }
    }
    //End nhu cau
    

    //Th????ng hi???u
   
    public function adCheckAddThuonghieu(Request $re)
    {
        if($re->thTen == null)
        {
           // Session::flash('note_err',"Th????ng hi???u kh??ng ???????c tr???ng!");
           //   return "<script>window.history.back();</script>"; 
           return response()->json(['message'=>1]);
        }
         if(strlen($re->thTen) > 30)
        {
             return response()->json(['message'=>3]);
        }
        else
        {
            $dataBefore=DB::table('thuonghieu')->where('thTen',$re->thTen)->first();
            if($dataBefore)
            {
                // Session::flash('note_err',"Th????ng hi???u ???? t???n t???i!");
                //  return "<script>window.history.back();</script>"; 
                return response()->json(['message'=>2]);
            }
            else
            {
                $data = array();
                $data['thTen']=$re->thTen;
                DB::table('thuonghieu')->insert($data);
                
                $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "Th??m th????ng hi???u m???i:".$re->thTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
                // return redirect('adThuonghieu');
                $retu = DB::table('thuonghieu')->where('thTen',$re->thTen)->first();
               
                return response()->json(['message'=>0,'thMa'=>$retu->thMa,'thTen'=>$retu->thTen]);
            }
        }
    }
    public function adDeleteThuonghieu($id)
    {
        $exist = DB::table('sanpham')->where('thMa',$id)->count();
        if($exist >= 1)
        {
            return response()->json(['message'=>1]);
        }
        else
        {
        $db = DB::table('thuonghieu')->select('thTen')->where('thMa',$id)->first();
       
          $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "X??a th????ng hi???u:".$db->thTen;
                $data1['alNgaygio']= now();
                //dd($data1['alChitiet']);
                DB::table('admin_log')->insert($data1);
       DB::table('thuonghieu')->where('thMa',$id)->delete();
       return response()->json(['message'=>0]);
        }
       
    }
    public function editThuonghieu(Request $re, $id)
    {
        if($re->thTen==null)
        {
            Session::flash('note_err','Kh??ng ???????c ????? r???ng!');
              return "<script>window.history.back();</script>"; 
        }
        else
        {
             $db = DB::table('thuonghieu')->select('thTen')->where('thMa',$id)->first();
                    
                $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "S???a th????ng hi???u:".$db->thTen."->".$re->thTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

            $data = array();
            $data['thTen'] = $re->thTen;
            DB::table('thuonghieu')->where('thMa',$id)->update($data);
            return redirect('adThuonghieu');
        }
        
    }
    //end th????ng hi???u

  //Khuy???n m??i
public function viewKhuyenmai()
    {
        if(Auth::user()->adTaikhoan != null)
        {   
            $noteDanhgia = danhgia::where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
             $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
             $data=khuyenmai::where('kmTinhtrang','!=',99)->get();

            return view('admin.khuyenmai')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }

public function addKhuyenmaiPage()
{
    if(Auth::user()->adTaikhoan != null)
        {   
            $checksanpham=sanpham::join('nhacungcap','nhacungcap.nccMa','sanpham.nccMa')
            ->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')
            ->join('hinh','sanpham.spMa','hinh.spMa')
            ->join('loai','loai.loaiMa','sanpham.loaiMa')
            ->get();
            // danh gia
            $noteDanhgia = danhgia::where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
             $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            // 
            $a=array();
            $sanpham=array();
            foreach($checksanpham as $i)
            {
              
                if(in_array($i->spMa, $a)==null)
                {
                    array_push($a, $i->spMa);
                    array_push($sanpham, $i);
                }
            }
            
            return view('admin.themkhuyenmai',compact('sanpham','noteDanhgia','noteDonhang','noteDonhang1'));
        }
        else
        {
            return Redirect('/adLogin');
        }
}

    public function adCheckAddKhuyenmai(Request $re)
    {
        if($re->kmNgaybd ==null)
        {
            Session::flash('err', 'Ng??y b???t ?????u kh??ng ???????c ????? tr???ng');
             return "<script>window.history.back();</script>"; 
        }
        if($re->kmNgaykt ==null)
        {
            Session::flash('err', 'Ng??y k???t th??c kh??ng ???????c ????? tr???ng');
             return "<script>window.history.back();</script>"; 
        }
        if($re->kmTrigia ==null)
        {
            Session::flash('err', 'Tr??? gi?? kh??ng ???????c ????? tr???ng !');
             return "<script>window.history.back();</script>"; 
        }
        $km = new khuyenmai();
        $checkExistKhuyenmai = khuyenmai::where('kmTen', $re->kmTen)->first();
        if ($checkExistKhuyenmai) {
            Session::flash('err', 'Khuy???n m??i n??y ???? t???n t???i');
             return "<script>window.history.back();</script>"; 
        }
        $km->kmTen = $re->kmTen;
        if ($re->kmTrigia < 1) {
            Session::flash('err', "Gi?? tr??? khuy???n m??i ph???i l???n h??n 1 ");
             return "<script>window.history.back();</script>"; 
        } elseif ($re->kmTrigia > 100) {
            Session::flash('err', "Gi?? tr??? khuy???n m??i ph???i nh??? h??n 100 !");
             return "<script>window.history.back();</script>"; 
        }
        $km->kmTrigia = $re->kmTrigia;
        $km->kmMota = $re->kmMota;
        $today = date_create();
        if ($re->kmNgaybd <= $re->kmNgaykt) {
            $km->kmNgaybd = $re->kmNgaybd;
            $km->kmNgaykt = $re->kmNgaykt;
        } else {
            Session::flash('err', "Ng??y k???t th??c ph???i sau ng??y b???t ?????u !");
             return "<script>window.history.back();</script>"; 
        }
        if ($re->kmSoluong != null) {
            $km->kmSoluong = $re->kmSoluong;
        } else {
            $km->kmSoluong = null;
        }
        if ($re->kmGioihanmoikh != null) {
            $km->kmGioihanmoikh = $re->kmGioihanmoikh;
        } else {
            $km->kmGioihanmoikh = null;
        }
        $km->kmGiatritoida = $re->kmGiatritoida;
        $date = getdate();
        if ($re->kmTinhtrang != 0) {
            $km->kmTinhtrang = 1;
        } else {
            $km->kmTinhtrang = 0;
        }
        $km->kmMa = $date['seconds'] . $date['minutes'] . $date['yday'] . $date['mon'];
        //dd($km->kmMa);
        $kmMa = $km->kmMa;
        Session::flash('success', 'Th??m th??nh c??ng !');
        $list = "";
        $km->save();
        if ($re->checkboxsp != null) {
            foreach ($re->checkboxsp as $v) {
                $sp = sanpham::where('spMa', $v)->first();
                $sp->kmMa = $kmMa;
                $sp->spSlkmtoida = $km->kmSoluong;
                $list.= ' ' . $v . ',';
                $sp->update();
            }
        }
        //Save_log
        $ad_log = new admin_log();
        $ad_log->adMa = Auth::user()->adMa;
        $ad_log->alChitiet = "Th??m khuy???n m??i: " . $re->kmTen . '; S???n ph???m ???????c ??p d???ng: ' . $list;
        $ad_log->alNgaygio = now();
        $ad_log->save();
        return redirect('adKhuyenmai');       
    }
      public function adDeleteKhuyenmai(Request $re)
      {
        $promoInfo=khuyenmai::where('kmMa',$re->id)->first();
        if(!$promoInfo)
        {
            Session::flash('err',"Khuy???n m??i kh??ng t???n t???i !");
             return "<script>window.history.back();</script>"; 
        }
        //check product of this promotion
        $promoInfo->kmTinhtrang=99;
        $checkExistProduct=sanpham::where('kmMa',$re->id)->get();
        if($checkExistProduct)
        {
            foreach($checkExistProduct as $i)
            {
                $sp = sanpham::where('spMa',$i->spMa)->first();
                $sp->kmMa==null;
                $sp->spSlkmtoida=null;
                $sp->update();
            }
        }
        $ad_log=new admin_log();
        $ad_log->adMa=Auth::user()->adMa;
        $ad_log->alChitiet='X??a ch????ng tr??nh khuy???n m??i: '.$promoInfo->kmTen.':'.$promoInfo->kmMota;
        $ad_log->alNgaygio=now();
        $ad_log->save();
        Session::flash('success',"???? x??a khuy???n m??i: ".$promoInfo->kmTen);
        $promoInfo->update();
        return redirect('adKhuyenmai');
      }

     

      public function suaKhuyenmaipage(Request $re)
      {

        $km=khuyenmai::where('kmMa',$re->id)->first();
        //dd($checkExistKhuyenmai);
        if(!$km)
        {
           
            Session::flash("err","Ch????ng tr??nh khuy???n m??i kh??ng t???n t???i !");
            return redirect::to('adKhuyenmai');
        }
       
        if(Auth::user()->adTaikhoan != null)
        {   
            $checksanpham=sanpham::join('nhacungcap','nhacungcap.nccMa','sanpham.nccMa')->join('hinh','sanpham.spMa','hinh.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->get();
            $noteDanhgia = danhgia::where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
             $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $a=array();
            $sanpham=array();
            foreach($checksanpham as $i)
            {
              
                if(in_array($i->spMa, $a)==null)
                {
                    array_push($a, $i->spMa);
                    array_push($sanpham, $i);
                }
            }
            //dd($sanpham);
            return view('admin.suakhuyenmai',compact('km','sanpham','noteDanhgia','noteDonhang','noteDonhang1'));
        }
        else
        {
            return Redirect('/adLogin');
        }
      }

      public function suaKhuyenmai(Request $re)
      {
        if($re->kmNgaybd ==null)
        {
            Session::flash('err', 'Ng??y b???t ?????u kh??ng ???????c ????? tr???ng');
             return "<script>window.history.back();</script>"; 
        }
        if($re->kmNgaykt ==null)
        {
            Session::flash('err', 'Ng??y k???t th??c kh??ng ???????c ????? tr???ng');
             return "<script>window.history.back();</script>"; 
        }
        if($re->kmTrigia ==null)
        {
            Session::flash('err', 'Tr??? gi?? kh??ng ???????c ????? tr???ng !');
             return "<script>window.history.back();</script>"; 
        }

        $km = khuyenmai::where('kmMa', $re->id)->first();
        //Declare message for change
        $checkFixed = 0;
        $kmTenOld = "";
        $kmMotaOld = "";
        $kmTrigiaOld = "";
        $kmNgaybdOld = "";
        $kmNgayktOld = "";
        $kmSoluongOld = "";
        $kmGioihanmoikhOld = "";
        $kmGiatritoidaOld = "";
        //
        if ($km->kmTen != $re->kmTen) {
            $kmTenOld = 'T??n: ' . $km->kmTen . ' => ' . $re->kmTen . '; ';
            $km->kmTen = $re->kmTen;
            $checkFixed++;
        }
        if ($re->kmTrigia < 1) {
            Session::flash('err', "Gi?? tr??? khuy???n m??i ph???i l???n h??n 1 ");
             return "<script>window.history.back();</script>"; 
        } elseif ($re->kmTrigia > 100) {
            Session::flash('err', "Gi?? tr??? khuy???n m??i ph???i nh??? h??n 100 !");
             return "<script>window.history.back();</script>"; 
        }
        if ($km->kmTrigia != $re->kmTrigia) {
            $kmTrigiaOld = 'Tr??? gi??: ' . $km->kmTrigia . ' => ' . $re->kmTrigia . '; ';
            $km->kmTrigia = $re->kmTrigia;
            $checkFixed++;
        }
        if ($km->kmMota != $re->kmMota) {
            $kmMotaOld = 'M?? t???: ' . $km->kmMota . ' => ' . $re->kmMota . '; ';
            $km->kmMota = $re->kmMota;
            $checkFixed++;
        }
        $today = date_create();
        if ($re->kmNgaybd <= $re->kmNgaykt) {
            if ($km->kmNgaybd != $re->kmNgaybd) {
                $kmNgaybdOld = 'Ng??y b???t ?????u: ' . $km->kmNgaybd . ' => ' . $re->kmNgaybd . '; ';
                $km->kmNgaybd = $re->kmNgaybd;
                $checkFixed++;
            }
            if ($km->kmNgaykt != $re->kmNgaykt) {
                $kmNgayktOld = 'Ng??y k???t th??c: ' . $km->kmNgaykt . ' => ' . $re->kmNgaykt . '; ';
                $km->kmNgaykt = $re->kmNgaykt;
                $checkFixed++;
            }
        } else {
            Session::flash('err', "Ng??y k???t th??c ph???i sau ng??y b???t ?????u !");
             return "<script>window.history.back();</script>"; 
        }
        if ($km->kmSoluong != $re->kmSoluong) {
            if ($re->kmSoluong != null) {
                $kmSoluongOld = 'S??? l?????ng khuy???n m??i: ' . $km->kmSoluong . ' => ' . $re->kmSoluong . '; ';
                $km->kmSoluong = $re->kmSoluong;
                $checkFixed++;
            } else {
                $kmSoluongOld = 'S??? l?????ng khuy???n m??i: ' . $km->kmSoluong . ' => Kh??ng gi???i h???n.' . '; ';
                $km->kmSoluong = null;
                $checkFixed++;
            }
        }
        if ($km->kmGioihanmoikh != $re->kmGioihanmoikh) {
            if ($re->kmGioihanmoikh != null) {
                $kmGioihanmoikhOld = 'Gi???i h???n m???i kh??ch h??ng: ' . $km->kmGioihanmoikh . ' => ' . $re->kmGioihanmoikh . '; ';
                $km->kmGioihanmoikh = $re->kmGioihanmoikh;
                $checkFixed++;
            } else {
                $kmGioihanmoikhOld = 'Gi???i h???n m???i kh??ch h??ng: ' . $km->kmGioihanmoikh . ' => Kh??ng gi???i h???n.' . '; ';
                $km->kmGioihanmoikh = null;
                $checkFixed++;
            }
        }
        if ($km->kmGiatritoida != $re->kmGiatritoida) {
            $kmGiatritoidaOld = 'G??a tri t???i ??a ???????c khuy???n m??i: ' . $km->kmGiatritoida . ' => ' . $re->kmGiatritoida . '; ';
            $km->kmGiatritoida = $re->kmGiatritoida;
            $checkFixed++;
        }
        if ($re->kmTinhtrang != 0) {
            $km->kmTinhtrang = 1;
        } else {
            $km->kmTinhtrang = 0;
        }
        $date = getdate();
        $kmMa = $km->kmMa;
        Session::flash('success', 'S???a th??nh c??ng !');
        $km->update();
        //Remove this promotion for product
        $sp = sanpham::where('kmMa', $re->id)->get();
        $removelist = "S???n ph???m ???? x??a kh???i khuy???n m??i: ";
        $addlist = "";
        // dd($sp);
        //add promotion code to products
        //dd($re->checkboxsp);
        foreach ($sp as $v) {
            $v->kmMa = null;
            //$removelist.=', '.$v->spMa;
            $v->save();
            $checkFixed++;
        }
        if ($re->checkboxsp != null) {
            foreach ($re->checkboxsp as $v) {
                $sp = sanpham::where('spMa', $v)->first();
                $sp->kmMa = $kmMa;
                $sp->spSlkmtoida = $km->kmSoluong;
                $checkFixed++;
                //dd($km,$sp);
                $addlist.= $v . ', ';
                $sp->update();
            }
        }
        //Save_log
        if ($checkFixed != 0) {
            $ad_log = new admin_log();
            $ad_log->adMa = Auth::user()->adMa;
            $ad_log->alChitiet = "S???a khuy???n m??i: " . $re->kmTen . '; ' . /*$removelist.*/
            '; ' . 'S???n ph???m ???????c ??p d???ng: ' . $addlist . '; ' . $kmTenOld . $kmMotaOld . $kmTrigiaOld . $kmNgaybdOld . $kmNgayktOld . $kmSoluongOld . $kmGioihanmoikhOld . $kmGiatritoidaOld;
            $ad_log->alNgaygio = now();
            $ad_log->save();
        }
        return redirect('adKhuyenmai');        
    }

      public function switchStatus(Request $re)
      {
        $checkExistKhuyenmai=khuyenmai::Where('kmMa',$re->id)->first();
        if($checkExistKhuyenmai)
        {
            if($checkExistKhuyenmai->kmTinhtrang!=0)
            {
                $checkExistKhuyenmai->kmTinhtrang=0;
                $checkExistKhuyenmai->update();
                $log= new admin_log();
                        $log->adMa=Auth::user()->adMa;
                        $log->alChitiet='?????i tr???ng th??i khuy???n m??i: '.$checkExistKhuyenmai->kmTen.' th??nh ???n.';
                        $log->alNgaygio=now();
                        $log->save();
            }
            else
            {
                $checkExistKhuyenmai->kmTinhtrang=1;
                $checkExistKhuyenmai->update();
                $log= new admin_log();
                        $log->adMa=Auth::user()->adMa;
                        $log->alChitiet='?????i tr???ng th??i khuy???n m??i: '.$checkExistKhuyenmai->kmTen.' th??nh ???n.';
                        $log->alNgaygio=now();
                        $log->save();
            }
        }
        else
        {
            Session::flash('err','Khuy???n m??i kh??ng t???n t???i !');
        }
        return redirect::to('adKhuyenmai');
      }
//end khuy???n m??i  

  //B??nh lu???n ????nh gi??
  public function viewBLSP($id)
  {
     $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
 $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
    $dg = DB::table('danhgia')->leftjoin('khachhang','khachhang.khMa','=','danhgia.khMa')->where('spMa',$id)->orderBy('dgTrangthai','desc')->get();
    return view('admin.binhluansanpham')->with('dg',$dg);
  }
  public function chitietBLSP($id)
  {
            Session::forget('dgTrangthai');
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
     $dg = DB::table('danhgia')->where('dgMa',$id)->join('khachhang','khachhang.khMa','=','danhgia.khMa')->get();
     $data = array();
     $data['dgTrangthai']=0;
     DB::table('danhgia')->where('dgMa',$id)->update($data);
    return view('admin.chitietbinhluan')->with('dg',$dg)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
  }

  // Nh?? cung c???p
    
    public function adviewNhacungcap()
    {
        if(Auth::user()->adTaikhoan != null)
        {
            $noteDanhgia = danhgia::where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data = nhacungcap::all()->where('nccTinhtrang',0);
            return view('admin.nhacungcap')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }  
        return Redirect('/adLogin');  
    } 

    public function checkAddNcc(Request $re)
    {
        if($re->nccTen == null || $re->nccSdt ==null || $re->nccDiachi == null)
        {
             return response()->json(['message'=>1]);
        }
         if(strlen($re->nccTen) > 50)
         {
             return response()->json(['message'=>7,'err'=>"T??n nh?? cung c???p qu?? d??i"]);
         }
          if(strlen($re->nccDiachi) > 100)
         {
             return response()->json(['message'=>7,'err'=>"?????a ch??? qu?? d??i"]);
         }
        if(strlen($re->nccDiachi)<10)
        {
                    // Session::flash('err','?????a ch??? kh??ng h???p l??? !');
                    //  return "<script>window.history.back();</script>"; 
                     return response()->json(['message'=>2]);
         }
        if($re->nccSdt<1 || strlen($re->nccSdt)>11 || strlen($re->nccSdt)<10)
        {
                    // Session::flash('err','S??? ??i???n tho???i kh??ng h???p l??? !');
                    //  return "<script>window.history.back();</script>"; 
                     return response()->json(['message'=>3]);
        }
        else
        {
            $checkExistNhacungcap=nhacungcap::where('nccTen',$re->nccTen)->first();
            if($checkExistNhacungcap)
            {
                // Session::flash('err','Nh?? cung c???p ???? t???n t???i !');
                //  return "<script>window.history.back();</script>"; 
                 return response()->json(['message'=>4]);
            }
            $checkExistSdt=nhacungcap::where('nccSdt',$re->nccSdt)->first();
            if($checkExistSdt)
            {
                // Session::flash('err','Nh?? cung c???p ???? t???n t???i !');
                // return "<script>window.history.back();</script>";
                 return response()->json(['message'=>5]);
            }
             $checkExistDiachi=nhacungcap::where('nccDiachi',$re->nccDiachi)->first();
            if($checkExistDiachi)
            {
                // Session::flash('err','Nh?? cung c???p ???? t???n t???i !');
                // return "<script>window.history.back();</script>";
                 return response()->json(['message'=>6]);
            }
            else
            {
                $ncc=new nhacungcap();
                $ncc->nccTen=$re->nccTen;
                $ncc->nccDiachi=$re->nccDiachi;
                $ncc->nccSdt=$re->nccSdt;
                $ncc->nccTinhtrang=0;
                Session::flash('success','Th??m th??nh c??ng !');
                $ncc->save();
                
                $ad_log=new admin_log();
                $ad_log->adMa=Auth::user()->adMa;
                $ad_log->alChitiet= "Th??m nh?? cung c???p m???i: ".$re->nccTen;
                $ad_log->alNgaygio=now();
                $ad_log->save();
               
               // return redirect('adNhacungcap');
                return response()->json(['message'=>0]);
            }
        }
    }

    public function deleteNhacungcap(Request $re)
    {
        $exist =sanpham::where('nccMa',$re->id)->count();
        $ncc =nhacungcap::where('nccMa',$re->id)->first();
        if($exist>=1)
        {
            // Session::flash('err','???? c?? s???n ph???m thu???c nh?? cung c???p n??y, kh??ng ???????c x??a!');
            //  return "<script>window.history.back();</script>"; 
             return response()->json(['message'=>1]);
        }      
        else
        { 
            $ad_log=new admin_log();
            $ad_log->adMa=Auth::user()->adMa;
            $ad_log->alChitiet="X??a nh?? cung c???p: ".$ncc->nccTen;
            $ad_log->alNgaygio=now();        
            $ad_log->save();               
            
           // Session::flash('success','???? x??a nh?? cung c???p: '.$exist->nccTen);
         
            $ncc->nccTinhtrang=99;
            $ncc->update();
             return response()->json(['message'=>0]);
           
           // return redirect('adNhacungcap');
           
        }  
       
    }

    public function suaNhacungcappage(Request $re)
    {
    $checkExistNhacungcap=nhacungcap::where('nccMa',$re->id)->first();
      if(Auth::user()!=null)
       {
            if($checkExistNhacungcap)
            {
                return view('admin.suanhacungcap')->with('data',$checkExistNhacungcap);
            }
            else
            {
                Session::flash('err','Nh?? cung c???p kh??ng t???n t???i!');
                 return "<script>window.history.back();</script>"; 
            }
        }
        else
        {
        return Redirect('/adLogin'); 
        }
    }

    public function suaNhacungcap(Request $re)
    {
        if($re->nccTen == NULL || $re->nccSdt == NULL || $re->nccDiachi == NULL)
        {

             Session::flash('err','Kh??ng ???????c ????? tr???ng th??ng tin!');
                return "<script>window.history.back();</script>";
        }
        if(strlen($re->nccTen) > 50)
        {
            Session::flash('err','T??n nh?? cung c???p qu?? d??i!');
                return "<script>window.history.back();</script>";
        }
        if(strlen($re->nccDiachi) > 100)
        {
            Session::flash('err','?????a ch??? qu?? d??i!');
                return "<script>window.history.back();</script>";
        }
        if(strlen($re->nccSdt)<10 || strlen($re->nccSdt)>11 || $re->nccSdt<1)
        {
            Session::flash('err','S??? ??i???n tho???i kh??ng ????ng!');
                return "<script>window.history.back();</script>";
        }
        else
        {
            $getNhacungcap=nhacungcap::where('nccMa',$re->id)->first();
            $nccTenOld=$getNhacungcap->nccTen;
            $nccDiachiOld=$getNhacungcap->nccDiachi;
            $nccSdtOld=$getNhacungcap->nccSdt;
            $ad_log=new admin_log();
            $ad_log->alChitiet="S???a th??ng tin nh?? cung c???p:  ";
            if($getNhacungcap->nccTen!=$re->nccTen)
            {   
                $ad_log->alChitiet.='T??n: '.$nccTenOld.' => '.$re->nccTen.'; ';
                $getNhacungcap->nccTen=$re->nccTen;
            }
            if($getNhacungcap->nccDiachi!=$re->nccDiachi)
            {
                $ad_log->alChitiet.='?????a ch???: '.$nccDiachiOld.' => '.$re->nccDiachi.'; ';
                $getNhacungcap->nccDiachi=$re->nccDiachi;
            }
            if($getNhacungcap->nccSdt!=$re->nccSdt)
            {
                $ad_log->alChitiet.='S??? ??i???n tho???i: '.$nccSdtOld.' => '.$re->nccSdt.'; ';
                $getNhacungcap->nccSdt=$re->nccSdt;
            }
            $ad_log->adMa=Auth::user()->adMa;
            $ad_log->alNgaygio=now();
            $getNhacungcap->update();
            $ad_log->save();

            return Redirect::to('adNhacungcap');
        }
    }

    // T??m ng??y ho???t ?????ng
    // public function timLSHD(Request $re)
    // {
    //         $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
    //         Session::put('dgTrangthai',$noteDanhgia);
    //         $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
    //         Session::put('hdTinhtrang',$noteDonhang);
    //         $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
    //         Session::put('hdTinhtrang1',$noteDonhang1);
    //         $alNgaygio = DB::table('admin_log')->distinct()->get('alNgaygio');
        
    //     $data = DB::table('admin_log')->leftjoin('admin','admin.adMa','=','admin_log.adMa')->where('alNgaygio','like','%'.$re->alNgaygio.'%')->get();
    //     return view('admin.lich-su-hoat-dong')->with('data',$data)->with('ngaygio',$alNgaygio)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
    // }

    //Phi???u nh???p
    public function viewCTPhieunhap($id)
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);
        $data = DB::table("phieunhap")
                ->where('pnMa',$id)
                ->join('admin','admin.adMa','=','phieunhap.adMa')
                ->get();
        $data2 = DB::table("chitietphieunhap")->where('pnMa',$id)
                ->join('sanpham','sanpham.spMa','=','chitietphieunhap.spMa')
                ->join('nhacungcap','nhacungcap.nccMa','=','chitietphieunhap.nccMa')
                ->get();
       
        return view('admin.chi-tiet-phieu-nhap')
                    ->with('data',$data)
                    ->with('data2',$data2) 
                    ->with('noteDanhgia',$noteDanhgia)
                    ->with('noteDonhang',$noteDonhang)
                    ->with('noteDonhang1',$noteDonhang1);
    }
    public function viewLapPhieuNhap()
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);
        $sanpham = DB::table('sanpham')->select('spMa','spTen')->get();
        $nhacungcap = DB::table('nhacungcap')->select('nccMa','nccTen')->where('nccTinhtrang',0)->get();
        return view('admin.lap-phieu-nhap')->with('sanpham',$sanpham)->with('nhacungcap',$nhacungcap)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
    }
    public function addPhieunhap(Request $re)
    {
        $data = array();
        $data['pnMa'] = rand(0,100).strlen("adMa").strlen($re->tongsl).strlen( $re->tonggia);
        $data['pnNgaylap'] = now();
        $data['adMa'] = Auth::user()->adMa;
        $data['pnSoluongsp']=$re->tongsl;
        $data['pnTongtien']=  $re->tonggia; 
        
        DB::table('phieunhap')->insert($data);
         
        foreach($re->spMa as $key => $v)
        {
            $checkSer = DB::table('serial')->where('serMa',$re->serMa[$key])->count();
            if($checkSer >= 1)
            {

             Session::flash('err','M?? serial '.$re->serMa[$key].' ???? t???n t???i vui l??ng thay ?????i!');
            return "<script>window.history.back();</script>";
            }
            else
            {
            $data2 = array();
            $data2["ctpnSoluong"]= 1;
            $data2["ctpnDongia"]= $re->gia[$key];
            $data2["ctpnThanhtien"]=0;
            $data2["spMa"] =  $v;
            $data2["nccMa"] = $re->nccMa[$key];
            $data2["pnMa"] =  $data['pnMa'];
            $data2["serMa"] =  $re->serMa[$key];
           
            DB::table('chitietphieunhap')->insert($data2);

            $data5 =array();
            $data5['spMa']=$v;
            $data5['serMa']=$re->serMa[$key];
            $data5['serTinhtrang']=0;
            DB::table('serial')->insert($data5);

            $sumSerial = DB::table('serial')->where('spMa',$v)->count();
            $checkExist = DB::table('kho')->where('spMa',$v)->count();
            $checkKho = DB::table('kho')->select('khoSoluong')->where('spMa',$v)->count();
            if($checkExist==0)
            {
                $data3 = array();
                $data3["spMa"] = $v;
                $data3["khoSoluong"] = $sumSerial;
                $data3["khoNgaynhap"] = now(); 
                $data3["khoSoluongdaban"] = 0;   
                DB::table('kho')->insert($data3);
            }
            else
            {
                if($checkKho > 0)
                {
                    $data3 = array();
                    $data3["khoSoluong"] = $checkKho + $sumSerial - 1;
                    $data3["khoNgaynhap"] = now(); 
                    $data3["khoSoluongdaban"] = 0;   
                    DB::table('kho')->where('spMa', $v)->update($data3);
                }
                else
                {
                    $data3 = array();
                    $data3["khoSoluong"] = $sumSerial;
                    $data3["khoNgaynhap"] = now(); 
                    $data3["khoSoluongdaban"] = 0;   
                    DB::table('kho')->where('spMa', $v)->update($data3);
                }
                
            }

            $data4 = array();
            $data4['spGia'] =$re->gia[$key];
            $data4["nccMa"] =$re->nccMa[$key];
            DB::table('sanpham')->where('spMa', $v)->update($data4);
            }


         }
         
        

        $data6 = array();
        $data6['adMa'] = Auth::user()->adMa;
        $data6['alChitiet'] = "L???p phi???u nh???p m???i, ng??y ".now();
        $data6['alNgaygio']= now();
        DB::table('admin_log')->insert($data6);

        return redirect("quan-ly-phieu-nhap");
    }

     public function viewCTDonhang($id)
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);
        $data = DB::table('donhang')->where('hdMa',$id)
                    ->join('admin','admin.adMa','=','donhang.adMa')
                    ->join('khachhang','khachhang.khMa','=','donhang.khMa')->get();
        $data2 = DB::table('chitietdonhang')->where("hdMa",$id)
                    ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                    ->get();
        $data3 = DB::table('admin')
                    ->leftjoin("donhang","donhang.adMa","=","admin.adMa")
                    ->where("donhang.hdMa","=",$id)
                    ->get();
       
       $donhuy = DB::table('donhang')->where('hdMa',$id)->where('hdTinhtrang',9)->count();
       if($donhuy == 1)
       {
            $db = array();
            $db['hdTinhtrang']=10;
            DB::table('donhang')->where('hdMa',$id)->update($db);
       }
         $logo = DB::table('slide')
                ->where('bnTrang',1)
                ->where('bnVitri',2)
                ->where('bnTrangthai',0)
                ->get('bnHinh');
       $dataBosung = DB::table('donhang')->where('hdMa',$id)->first();
        if($dataBosung->hdBosung != NULL)
        {
        $hdOld = DB::table('donhang')->select('hdMa','hdTongtien','hdTinhtrang')->where('hdMa',$dataBosung->hdBosung)->get();
        return view('admin.chi-tiet-phieu-thu',compact('data','data2','data3','logo','noteDanhgia','noteDonhang','noteDonhang1','donhuy','hdOld'));
        }
        else
        {
            return view('admin.chi-tiet-phieu-thu',compact('data','data2','data3','logo','noteDanhgia','noteDonhang','noteDonhang1','donhuy'));
        }
       
        
    }
// VOUCHER
    public function viewVoucher()
    {
        if(Auth::user()->adTaikhoan != null)
        {   
            $noteDanhgia = danhgia::where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
             $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            
            $vc= DB::table('voucher')->leftjoin('sanpham','sanpham.spMa','voucher.spMa')->where('vcTinhtrang','!=' ,99)->get();;
            return view('admin.voucher',compact('vc'))->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        {
            return view('admin.login');    
        }
    }

    public function addVoucherpage()
    {
        if(Auth::user()->adTaikhoan != null)
        {   
            $checksanpham=sanpham::join('nhacungcap','nhacungcap.nccMa','sanpham.nccMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->join('hinh','sanpham.spMa','hinh.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->get();
            $noteDanhgia = danhgia::where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
             $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $a=array();
            $sanpham=array();

            foreach($checksanpham as $i)
            {
              
                if(in_array($i->spMa, $a)==null)
                {
                    array_push($a, $i->spMa);
                    array_push($sanpham, $i);
                }
            }
            
            return view('admin.themvoucher',compact('sanpham','noteDanhgia','noteDonhang','noteDonhang1'));
        }
        else 
        {
            return view('admin.login');    
        }
    }

    public function checkAddVoucher(Request $re)
    {
        $vc=new voucher();
        if($re->vcMa != null)
        {
            $vc->vcMa=$re->vcMa;
        }
        else
        {
            Session::flash('err','M?? voucher kh??ng ???????c ????? tr???ng !');
             return "<script>window.history.back();</script>"; 
        }
        $checkExistVoucher= voucher::find($re->vcMa);
        if($checkExistVoucher)
        {
            Session::flash('err','M?? voucher ???? t???n t???i !');
             return "<script>window.history.back();</script>"; 
        }
        

        //Ki???m tra m?? h???p l???
        $flag='';
        for($i=0;$i < strlen($re->vcMa);$i++)
        {
            for($j=65;$j<=91;$j++)
            {
                if(chr($j)==$re->vcMa[$i])
                {
                    $flag.=$re->vcMa[$i];
                }
            }
            for($j=48;$j<=57;$j++)
            {
                if(chr($j)==$re->vcMa[$i])
                {
                    $flag.=$re->vcMa[$i];
                }
            }
            for($j=97;$j<=122;$j++)
            {
                if(chr($j)==$re->vcMa[$i])
                {
                    $flag.=$re->vcMa[$i];
                }
            }
            if(chr(32)==$re->vcMa[$i])
            {
                $flag.=$re->vcMa[$i];
            }
        }
        if(strlen($flag)==strlen($re->vcMa))
        {
            $vc->vcMa=$re->vcMa;
        }
        else
        {
            Session::flash('err','M?? kh??ng ???????c ch???a k?? t??? ?????c bi???t !');
             return "<script>window.history.back();</script>"; 
        }
        // 
        if($re->vcTen !=null)
        {
            $checkExistVoucherName=voucher::where('vcTen',$re->vcTen)->first();
            if($checkExistVoucherName)
            {
                Session::flash('err','Voucher n??y ???? t???n t???i !');
                 return "<script>window.history.back();</script>"; 
            }
            else
            {
                $vc->vcTen=$re->vcTen;    
            }
        }
        else
        {
            Session::flash('err','T??n kh??ng ???????c ????? tr???ng !');
             return "<script>window.history.back();</script>"; 
        }
        
        if($re->vcSoluot != null)
        {
            if($re->vcSoluot<1)
            {
                Session::flash('err','S??? l?????t ph???i l???n h??n 0 !');
                 return "<script>window.history.back();</script>"; 
            }
            $vc->vcSoluot=$re->vcSoluot;
        }
        else
        {
            Session::flash('err','S??? l?????t kh??ng ???????c ????? tr???ng !');
             return "<script>window.history.back();</script>"; 
        }
        

        if($re->vcNgaybd  != null)
        {
            $vc->vcNgaybd=$re->vcNgaybd;
        }
        else
        {
            Session::flash('err','Vui l??ng ch???n ng??y b???t ?????u !');
             return "<script>window.history.back();</script>"; 
        }

        if($re->vcNgaykt == null)
        {
            Session::flash('err','Vui l??ng ch???n ng??y k???t th??c !');
             return "<script>window.history.back();</script>"; 
        }
        if($re->vcNgaybd > $re->vcNgaykt)
        {
            Session::flash('err','Ng??y k???t th??c ph???i sau ng??y b???t ?????u !');
             return "<script>window.history.back();</script>"; 
        }
        $vc->vcNgaykt=$re->vcNgaykt;
        $vc->vcLoaigiamgia=$re->vcLoaigiamgia;
        if($re->vcLoaigiamgia==0)//Theo gia
        {
            if($re->vcMucgiam<1000)// < 1000VND dong bao loi
            {
                Session::flash('err','M???c gi???m gi?? ph???i l???n h??n 1000?? !');
                 return "<script>window.history.back();</script>"; 
            }
            else
            {
                $vc->vcMucgiam=$re->vcMucgiam;        
            }
        }
        else
        {
            if($re->vcMucgiam<0)
            {
                Session::flash('err','M???c gi???m ph???i l???n h??n 0!');
                 return "<script>window.history.back();</script>"; 
            }
            if($re->vcMucgiam > 100)
            {
                Session::flash('err','Ph???n tr??m gi???m gi?? ph???i nh??? h??n ho???c b???ng 100 %');
                 return "<script>window.history.back();</script>"; 
            }
            else
            {
                $vc->vcMucgiam=$re->vcMucgiam;        
            }
        }

        if($re->vcGiatritoida<0)
        {
            Session::flash('err','Gi?? tr??? t???i ??a ph???i l???n h??n 0!');
             return "<script>window.history.back();</script>"; 
        }
        $vc->vcGiatritoida=$re->vcGiatritoida;
        $vc->vcLoai=$re->vcLoai;
        if($re->vcLoai==0)
        {
            if($re->checkboxsp==null)
                {
                    Session::flash('err','Vui l??ng ch???n 1 s???n ph???m !');
                 return "<script>window.history.back();</script>"; 
            }
            else
            {
                $vc->spMa=$re->checkboxsp;
            }
        }
        $vc->vcDkapdung=$re->vcDkapdung;
        if($re->vcDkapdung == 0)
        {
            if($re->vcGtcandat != null)
            {
                if($re->vcGtcandat >= 1000)
                {
                    $vc->vcGtcandat = $re->vcGtcandat;
                }
                else
                {
                    Session::flash('err','??i???u ki???n ??p d???ng theo gi?? ph???i l???n h??n 1000?? !');
                     return "<script>window.history.back();</script>"; 
                }
            }
        }
        else
        {
            if($re->vcGtcandat != null)
            {
                if($re->vcGtcandat > 0)
                {
                    $vc->vcGtcandat=$re->vcGtcandat;
                }
                else
                {
                    Session::flash('err','??i???u ki???n ??p d???ng theo s???n ph???m ph???i l???n h??n 0 !');
                     return "<script>window.history.back();</script>"; 
                }
            }
        }
        if($re->vcTinhtrang!=null)
        {
            $vc->vcTinhtrang=$re->vcTinhtrang;
        }
        else
        {
            $vc->vcTinhtrang=0;
        }
        $vc->save();

        //save log
        $log = new admin_log();
        $log->adMa=Auth::user()->adMa;
        $log->alChitiet="Th??m voucher: ".$re->vcTen;
        $log->alNgaygio=now();
        $log->save();

        Session::flash('success',"Th??m voucher: ".$re->vcTen." th??nh c??ng!");
        return Redirect::to('adVoucher');

    }

    public function suaVoucherpage(Request $re)
    {
        $vc=DB::table('voucher')->where('vcMa',$re->id)->first();
        //dd($checkExistKhuyenmai);
        if(!$vc)
        {
           
            Session::flash("err","Ch????ng tr??nh khuy???n m??i kh??ng t???n t???i !");
            return redirect::to('adKhuyenmai');
        }
       
        if(Auth::user()->adTaikhoan != null)
        {   
            $checksanpham=sanpham::leftjoin('voucher','voucher.spMa','sanpham.spMa')->join('nhacungcap','nhacungcap.nccMa','sanpham.nccMa')->join('hinh','sanpham.spMa','hinh.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->get();
            $noteDanhgia = danhgia::where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
             $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $a=array();
            $sanpham=array();
            foreach($checksanpham as $i)
            {
              
                if(in_array($i->spMa, $a)==null)
                {
                    array_push($a, $i->spMa);
                    array_push($sanpham, $i);
                }
            }
            
           
            return view('admin.suavoucher',compact('vc','sanpham','noteDanhgia','noteDonhang','noteDonhang1'));
        }
        else
        {
            return Redirect('/adLogin');
        }
    }

    public function checkSuaVoucher(Request $re)
    {
     
        
        $vc=voucher::where('vcMa',$re->id)->first();
        if($re->vcTen == null)
        {
            Session::flash('err','Vui l??ng nh???p t??n !');
             return "<script>window.history.back();</script>"; 
        }
        $vc->vcTen=$re->vcTen;    
        
        if($re->vcSoluot<1)
        {
            Session::flash('err','S??? l?????t ph???i l???n h??n 0 !');
             return "<script>window.history.back();</script>"; 
        }
        $vc->vcSoluot=$re->vcSoluot;
        if($re->vcNgaybd !=null)
        {
            $vc->vcNgaybd=$re->vcNgaybd;
        }
        else
        {
            Session::flash('err','Vui l??ng nh???p ng??y b???t ?????u !');
             return "<script>window.history.back();</script>"; 
        }
        if($re->vcNgaykt==null)
        {
            Session::flash('err','Vui l??ng nh???p ng??y k???t th??c !');
             return "<script>window.history.back();</script>";   
        }
        if($re->vcNgaybd > $re->vcNgaykt)
        {
            Session::flash('err','Ng??y k???t th??c ph???i sau ng??y b???t ?????u !');
             return "<script>window.history.back();</script>"; 
        }
        $vc->vcNgaykt=$re->vcNgaykt;
        $vc->vcLoaigiamgia=$re->vcLoaigiamgia;
        if($re->vcLoaigiamgia==0)//Theo gia
        {
            if($re->vcMucgiam<1000)// < 1000VND dong bao loi
            {
                Session::flash('err','M???c gi???m gi?? ph???i l???n h??n 1000?? !');
                 return "<script>window.history.back();</script>"; 
            }
            else
            {
                $vc->vcMucgiam=$re->vcMucgiam;        
            }
        }
        else
        {
            if($re->vcMucgiam<0)
            {
                Session::flash('err','M???c gi???m ph???i l???n h??n 0!');
                 return "<script>window.history.back();</script>"; 
            }
            if($re->vcMucgiam > 100)// < 1000VND dong bao loi
            {
                Session::flash('err','Ph???n tr??m gi???m gi?? ph???i nh??? h??n ho???c b???ng 100 %');
                 return "<script>window.history.back();</script>"; 
            }
            else
            {
                $vc->vcMucgiam=$re->vcMucgiam;        
            }
        }
        if($re->vcGiatritoida<0)
        {
            Session::flash('err','Gi?? tr??? t???i ??a ph???i l???n h??n 0!');
             return "<script>window.history.back();</script>"; 
        }
        $vc->vcGiatritoida=$re->vcGiatritoida;
        $vc->vcLoai=$re->vcLoai;
        if($re->vcLoai==0)
        {
            if($re->checkboxsp==null)
                {
                    Session::flash('err','Vui l??ng ch???n 1 s???n ph???m !');
                 return "<script>window.history.back();</script>"; 
            }
            else
            {
                $vc->spMa=$re->checkboxsp;
            }
        }
        $vc->vcDkapdung=$re->vcDkapdung;
   
        if($re->vcDkapdung==0)
        {
            if($re->vcGtcandat!=null)
            {
                if($re->vcGtcandat>=1000)
                {
                    $vc->vcGtcandat=$re->vcGtcandat;
                }
                else
                {
                    Session::flash('err','??i???u ki???n ??p d???ng theo gi?? ph???i l???n h??n 1000?? !');
                     return "<script>window.history.back();</script>"; 
                }
            }
        }
        else
        {
            if($re->vcGtcandat!=null)
            {
                if($re->vcGtcandat>0)
                {
                    $vc->vcGtcandat=$re->vcGtcandat;
                }
                else
                {
                    Session::flash('err','??i???u ki???n ??p d???ng theo s???n ph???m ph???i l???n h??n 0 !');
                     return "<script>window.history.back();</script>"; 
                }
            }
        }
        if($re->vcTinhtrang!=null)
        {
            $vc->vcTinhtrang=$re->vcTinhtrang;
        }
        else
        {
               $vc->vcTinhtrang=0;
        }
        $vc->update();

        //save log
        $log = new admin_log();
        $log->adMa=Auth::user()->adMa;
        $log->alChitiet="S???a voucher: ".$re->vcTen;
        $log->alNgaygio=now();
        $log->save();

        Session::flash('success',"S???a voucher: ".$re->vcTen." th??nh c??ng!");
        return Redirect::to('adVoucher');

    }

    public function switchStatusVc(Request $re)
    {
        if(Auth::check())
        {
            $adInfo=admin::where('adMa',Auth::user()->adMa)->first();
            if($adInfo && $adInfo->adQuyen==1)
            {
                $checkExistVoucher=voucher::Where('vcMa',$re->id)->first();
                if($checkExistVoucher)
                {
                    if($checkExistVoucher->vcTinhtrang!=0)
                    {
                        $checkExistVoucher->vcTinhtrang=0;
                        $checkExistVoucher->update();
                        Session::flash('success','???? ?????i t??nh tr???ng voucher: '.$checkExistVoucher->vcTen." th??nh ???n.");
                        $log= new admin_log();
                        $log->adMa=Auth::user()->adMa;
                        $log->alChitiet='?????i tr???ng th??i voucher: '.$checkExistVoucher->vcTen.' th??nh ???n.';
                        $log->alNgaygio=now();
                        $log->save();
                    }
                    else
                    {
                        $checkExistVoucher->vcTinhtrang=1;
                        $checkExistVoucher->update();
                        Session::flash('success','???? ?????i t??nh tr???ng voucher: '.$checkExistVoucher->vcTen." th??nh Hi???n.");
                        $log= new admin_log();
                        $log->adMa=Auth::user()->adMa;
                        $log->alChitiet='?????i tr???ng th??i voucher: '.$checkExistVoucher->vcTen.' th??nh Hi???n.';
                        $log->alNgaygio=now();
                        $log->save();
                    }
                }
                else
                {
                    Session::flash('err','Voucher kh??ng t???n t???i !');
                }
                return redirect::to('adVoucher');
            }
            else
            {
                Session::flash('err','B???n kh??ng c?? quy???n n??y !');
                 return "<script>window.history.back();</script>"; 
            }
        }
    }

    public function adDeleteVoucher(Request $re)
    {
        if(Auth::check())
        {
            $vcInfo=voucher::where('vcMa',$re->id)->first();
            if(!$vcInfo)
            {
                Session::flash('err',"Voucher kh??ng t???n t???i !");
                 return "<script>window.history.back();</script>"; 
            }
            $vcInfo->vcTinhtrang=99;
            //
            $ad_log=new admin_log();
            $ad_log->adMa=Auth::user()->adMa;
            $ad_log->alChitiet='X??a voucher: '.$vcInfo->vcTen;
            $ad_log->alNgaygio=now();
            $ad_log->save();
            Session::flash('success',"???? x??a voucher: ".$vcInfo->vcTen);
            $vcInfo->update();
            return redirect('adVoucher');
        }
        return Redirect::to('adLogin');
    }

    public function tangvoucherview()
    {
        $kh=khachhang::all();
        $dh=array();
        $totalorder=array();
        foreach($kh as $user)
        {
            $dh[$user->khMa]=donhang::where('khMa',$user->khMa)->sum('hdTongtien');
            $totalorder[$user->khMa]=donhang::where('khMa',$user->khMa)->count();
        }

        $vc=DB::table('voucher')->leftjoin('sanpham','sanpham.spMa','voucher.spMa')->where('vcTinhtrang',1)->get();
        return view('admin.tangvoucher',compact('kh','vc','dh','totalorder'));
    }

    public function tangvoucher(Request $re)
    {
        if($re->kh==null)
        {
            Session::flash('error','Vui l??ng ch???n ??t nh???t 1 kh??ch h??ng!');
            return redirect()->back();
        }
        if($re->vc==null)
        {
            Session::flash('error','Vui l??ng ch???n voucher!');
            return redirect()->back();
        }
        foreach($re->kh as $user)
        {
            $user=khachhang::where('khMa',$user)->first();
            $this->sendmail($user->khTen,$user->khEmail,$re->vc);
        }
        return Redirect::to('adVoucher');
    }


    public function sendmail($username,$email,$vcMa)
    {   
        $name=payment::where('pmId',1)->first();
        $details=DB::table('voucher')->where('vcMa',$vcMa)->leftjoin('sanpham','sanpham.spMa','voucher.spMa')->leftjoin('hinh','sanpham.spMa','hinh.spMa')->first();
        // dd($details);
        Mail::to($email)->send(new \App\Mail\tangvoucher($details,$name,$username));
    }
    // 


    public function khoaNhanvien($id)
    {
         $dbOld = DB::table('admin')->select('adTen')->where('adMa',$id)->first();
          $data1 = array();
                $data1['adMa'] = Auth::user()->adMa;
                $data1['alChitiet'] = "Kh??a nh??n vi??n: ".$dbOld->adTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
        

        $data = array();
        $data['adTinhtrang']=1;
        DB::table('admin')->where('adMa',$id)->update($data);
         return redirect('adNhanvien');
    }
     public function moKhoaNhanvien($id)
    {
        $dbOld = DB::table('admin')->where('adMa',$id)->first();
        $data1 = array();
        $data1['adMa'] = Auth::user()->adMa;
        $data1['alChitiet'] = "M??? kh??a nh??n vi??n:".$dbOld->adTen;
        $data1['alNgaygio']= now();
        DB::table('admin_log')->insert($data1);
        

        $data = array();
        $data['adTinhtrang']=0;
        DB::table('admin')->where('adMa',$id)->update($data);
         return redirect('adNhanvien');
    }


    public function themTintuc()
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);

        return view('admin.them-tin-tuc')
                                ->with('noteDanhgia',$noteDanhgia)
                                ->with('noteDonhang',$noteDonhang)
                                ->with('noteDonhang1',$noteDonhang1);
    }
     public function adCheckAddTT(Request $re)
    {
        if($re->ttTieude == NULL)
        {
            Session::flash('note_err','Ti??u ????? tin t???c kh??ng ???????c tr???ng');
            return "<script>window.history.back();</script>";
        }
         if(strlen($re->ttTieude) > 150)
        {
            Session::flash('note_err','Ti??u ????? tin t???c qu?? d??i!');
            return "<script>window.history.back();</script>";
        }
        if($re->ttGioithieu == NULL)
        {
            Session::flash('note_err','Gi???i thi???u n???i dung kh??ng ???????c tr???ng');
            return "<script>window.history.back();</script>";
        }
         if(strlen($re->ttGioithieu) > 50)
        {
            Session::flash('note_err','Gi???i thi???u qu?? d??i ph???i d?????i 50 k?? t???');
            return "<script>window.history.back();</script>";
        }
        if($re->ttNoidung == NULL)
        {
            Session::flash('note_err','N???i dung kh??ng ???????c tr???ng');
            return "<script>window.history.back();</script>";
        }
        if($re->ttLoai == NULL)
        {
            Session::flash('note_err','Vui l??ng ch???n lo???i tin t???c');
            return "<script>window.history.back();</script>";
        }
        if($re->hasFile('ttHinh')==true)
        {
            $data = array();
            $data['ttMa'] = rand(0,1000).strlen($re->ttTieude).strlen($re->ttNoidung);
            $data['ttTieude'] = $re->ttTieude;
            $data['ttGioithieu'] = $re->ttGioithieu;
            $data['ttNoidung'] = $re->ttNoidung;
            $data['ttLoai'] =$re->ttLoai; 
            $data['ttHinh'] = $re->file('ttHinh')->getClientOriginalName();
                $imgextention=$re->file('ttHinh')->extension();
                $file=$re->file('ttHinh');
                $file->move('public/images/tintuc',$data['ttHinh']);
            $data['ttNgaydang'] = now();
            $data['ttTinhtrang'] =0;
            $data['ttLuotxem'] =0;
            $data['adMa'] =Auth::user()->adMa;
            DB::table('tintuc')->insert($data);

            $data1 = array();
            $data1['adMa'] = Auth::user()->adMa;
            $data1['alChitiet'] = "Th??m tin t???c ti??u ?????: ".$re->ttTieude;
            $data1['alNgaygio']= now();
            DB::table('admin_log')->insert($data1);

             $details = [
            'tieude'=>"Tin t???c m???i nh???t t??? STUCPT",
            'ngaydang'=>now(),
            'gioithieu'=>$re->ttTieude,

            ];

            $emailTintuc = DB::table('emailthongtin')->get();
            foreach($emailTintuc as $email)
            {
                $mail = $email->email;
                 Mail::to($mail)->send(new mailTintuc($details));
            }

            return redirect('tin-tuc');
        }
        else
        {
            Session::flash('note_err','Vui l??ng th??m h??nh ch??? ????? cho tin t???c');
             return "<script>window.history.back();</script>"; 
       }
    }
    public function adUpdateTintuc($id)
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);
        $data = DB::table('tintuc')->where('ttMa',$id)->get();
        return view('admin.cap-nhat-tin-tuc')
                                ->with('data',$data)
                                ->with('noteDanhgia',$noteDanhgia)
                                ->with('noteDonhang',$noteDonhang)
                                ->with('noteDonhang1',$noteDonhang1);
    }
    public function editTintuc(Request $re,$id)
    {
        if($re->ttTieude == NULL)
        {
            Session::flash('note_err','Ti??u ????? tin t???c kh??ng ???????c tr???ng');
            return "<script>window.history.back();</script>";
        }
         if(strlen($re->ttTieude) > 150)
        {
            Session::flash('note_err','Ti??u ????? tin t???c qu?? d??i!');
            return "<script>window.history.back();</script>";
        }
        if($re->ttGioithieu == NULL)
        {
            Session::flash('note_err','Gi???i thi???u n???i dung kh??ng ???????c tr???ng');
            return "<script>window.history.back();</script>";
        }
         if(strlen($re->ttGioithieu) > 50)
        {
            Session::flash('note_err','Gi???i thi???u qu?? d??i ph???i d?????i 50 k?? t???');
            return "<script>window.history.back();</script>";
        }
        if($re->ttNoidung == NULL)
        {
            Session::flash('note_err','N???i dung kh??ng ???????c tr???ng');
            return "<script>window.history.back();</script>";
        }
        if($re->ttLoai == NULL)
        {
            Session::flash('note_err','Vui l??ng ch???n lo???i tin t???c');
            return "<script>window.history.back();</script>";
        }
        if($re->hasFile('ttHinh')==true)
        {
        $data = array();
        $data['ttTieude'] = $re->ttTieude;
        $data['ttGioithieu'] = $re->ttGioithieu;
        $data['ttNoidung'] = $re->ttNoidung;
        $data['ttLoai'] =$re->ttLoai; 
        $data['ttHinh'] = $re->file('ttHinh')->getClientOriginalName();
            $imgextention=$re->file('ttHinh')->extension();
            $file=$re->file('ttHinh');
            $file->move('public/images/tintuc',$data['ttHinh']);
        $data['ttTinhtrang'] = $re->ttTinhtrang;
        DB::table('tintuc')->where('ttMa',$id)->update($data);

        $data1 = array();
        $data1['adMa'] = Auth::user()->adMa;
        $data1['alChitiet'] = "C???p nh???t tin t???c ti??u ????? ".$re->ttTieude;
        $data1['alNgaygio']= now();
        DB::table('admin_log')->insert($data1);

        return redirect('tin-tuc');
        }
        else
        {
        $data = array();
        $data['ttTieude'] = $re->ttTieude;
        $data['ttGioithieu'] = $re->ttGioithieu;
        $data['ttNoidung'] = $re->ttNoidung;
        $data['ttLoai'] =$re->ttLoai; 
        $data['ttTinhtrang'] = $re->ttTinhtrang;
        DB::table('tintuc')->where('ttMa',$id)->update($data);

        $data1 = array();
        $data1['adMa'] = Auth::user()->adMa;
        $data1['alChitiet'] = "C???p nh???t tin t???c ti??u ????? ".$re->ttTieude;
        $data1['alNgaygio']= now();
        DB::table('admin_log')->insert($data1);

        return redirect('tin-tuc');
        }
    }
    public function deleteTintuc($id)
    { 
        $dbOld = DB::table('tintuc')->select('ttTieude')->where('ttMa',$id)->first();
        $data1 = array();
        $data1['adMa'] = Auth::user()->adMa;
        $data1['alChitiet'] = "X??a tin t???c ti??u ?????: ".$dbOld->ttTieude;
        $data1['alNgaygio']= now();
        DB::table('admin_log')->insert($data1);

        DB::table('tintuc')->where('ttMa',$id)->delete();
        return response()->json(['message'=>0]);
    }



        //Banner
     public function vitriBanner($trang)
     {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);

            $page = $trang;
            return view('admin.vi-tri-banner')
                                ->with('page',$page)
                                ->with('noteDanhgia',$noteDanhgia)
                                ->with('noteDonhang',$noteDonhang)
                                ->with('noteDonhang1',$noteDonhang1);
     }
      public function themBanner($trang,$id)
     {
         $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);

            $vitri = $id;
            $trang = $trang;

            return view('admin.them-banner',compact('vitri','trang'))
                                ->with('noteDanhgia',$noteDanhgia)
                                ->with('noteDonhang',$noteDonhang)
                                ->with('noteDonhang1',$noteDonhang1);
     }
      public function adCheckAddBanner(Request $re,$trang,$vitri)
      {
          if($re->bnTieude == NULL)
          {
            Session::flash('note_err',"Ti??u ????? banner kh??ng ???????c r???ng");
                return "<script>window.history.back();</script>";
          }
          if($re->bnNoidung == NULL)
          {
            Session::flash('note_err',"N???i dung banner kh??ng ???????c r???ng");
                return "<script>window.history.back();</script>";
          }
          if($re->bnTrangthai == NULL)
          {
            Session::flash('note_err',"Vui l??ng ch???n tr???ng th??i!");
                return "<script>window.history.back();</script>";
          }
          else{
            $count = DB::table('slide')->where('bnVitri',$vitri)->where('bnTrang',$trang)->where('bnTrangthai',0)->count();
            $bnOld = DB::table('slide')->select('bnMa')->where('bnVitri',$vitri)->where('bnTrang',$trang)->where('bnTrangthai',0)->first();
            
            if($re->hasFile('bnHinh'))
            {
                if($re->bnTrangthai == 0)
                {
                    if($count == 0)
                    {
                        $data = array();
                        $data['bnMa']= time();
                        $data['bnTieude']= $re->bnTieude;
                        $data['bnNoidung']= $re->bnNoidung;
                        $data['bnHinh'] = $re->file('bnHinh')->getClientOriginalName();
                            $imgextention = $re->file('bnHinh')->extension();
                            $file = $re->file('bnHinh');
                            $file->move('public/images/banners',$data['bnHinh']);
                        $data['bnNgay']= now();
                        $data['bnVitri']= $vitri;
                        $data['bnTrangthai']= $re->bnTrangthai;
                         $data['bnTrang']= $trang;
                        DB::table('slide')->insert($data);
                       
                        return redirect('adBanner/'.$trang."/".$vitri);
                    }
                    if($count >= 1)
                    {
                        if($vitri==2 && $trang == 2)
                        {
                              $data = array();
                            $data['bnMa']= time();
                            $data['bnTieude']= $re->bnTieude;
                            $data['bnNoidung']= $re->bnNoidung;
                            $data['bnHinh'] = $re->file('bnHinh')->getClientOriginalName();
                                $imgextention = $re->file('bnHinh')->extension();
                                $file = $re->file('bnHinh');
                                $file->move('public/images/banners',$data['bnHinh']);
                            $data['bnNgay']= now();
                            $data['bnVitri']= $vitri;
                            $data['bnTrangthai']= $re->bnTrangthai;
                             $data['bnTrang']= $trang;
                            DB::table('slide')->insert($data);
                             return redirect('adBanner/'.$trang."/".$vitri);
                        }
                        else
                        {
                             $data1 = array();
                        $data1['bnTrangthai'] = 1;
                        DB::table('slide')->where('bnMa', $bnOld->bnMa)->update($data1);

                        $data = array();
                        $data['bnMa']= time();
                        $data['bnTieude']= $re->bnTieude;
                        $data['bnNoidung']= $re->bnNoidung;
                        $data['bnHinh'] = $re->file('bnHinh')->getClientOriginalName();
                            $imgextention = $re->file('bnHinh')->extension();
                            $file = $re->file('bnHinh');
                            $file->move('public/images/banners',$data['bnHinh']);
                        $data['bnNgay']= now();
                        $data['bnVitri']= $vitri;
                        $data['bnTrangthai']= $re->bnTrangthai;
                         $data['bnTrang']= $trang;
                        DB::table('slide')->insert($data);
                         return redirect('adBanner/'.$trang."/".$vitri);
                        }
                    }
                    } 
                    else
                    {
                        $data = array();
                        $data['bnMa']= time();
                        $data['bnTieude']= $re->bnTieude;
                        $data['bnNoidung']= $re->bnNoidung;
                        $data['bnHinh'] = $re->file('bnHinh')->getClientOriginalName();
                            $imgextention = $re->file('bnHinh')->extension();
                            $file = $re->file('bnHinh');
                            $file->move('public/images/banners',$data['bnHinh']);
                        $data['bnNgay']= now();
                        $data['bnVitri']= $vitri;
                        $data['bnTrangthai']= $re->bnTrangthai;
                         $data['bnTrang']= $trang;
                        DB::table('slide')->insert($data);
                       
                        return redirect('adBanner/'.$trang."/".$vitri);
                    }        
            }
            else
            {
                Session::flash('note_err',"Vui l??ng th??m h??nh");
                 return "<script>window.history.back();</script>"; 
            }
          }
            
      }
      public function adDeleteBanner($id)
      {
         $trang = DB::table('slide')->select('bnTrang','bnVitri')->where('bnMa', $id)->first();
        DB::table('slide')->where('bnMa',$id)->delete();
       
        return redirect('adBanner/'.$trang->bnTrang."/".$trang->bnVitri);
      }
      public function showBanner($id)
      {
        $trang = DB::table('slide')->select('bnTrang','bnVitri')->where('bnMa', $id)->first();
        $count = DB::table('slide')->where('bnVitri',$trang->bnVitri)->where('bnTrang',$trang->bnTrang)->where('bnTrangthai',0)->count();
        $bnOld = DB::table('slide')->select('bnMa')->where('bnVitri',$trang->bnVitri)->where('bnTrang',$trang->bnTrang)->where('bnTrangthai',0)->first();
       
        if($count == 0)
        {
            $data = array();
            $data['bnTrangthai'] = 0;
            DB::table('slide')->where('bnMa', $id)->update($data);

        return redirect('adBanner/'.$trang->bnTrang."/".$trang->bnVitri);
        }
        if($count >= 1)
        {
            if($trang->bnTrang == 2 && $trang->bnVitri == 2)
            {
                  $data1 = array();
                $data1['bnTrangthai'] = 0;
                DB::table('slide')->where('bnMa', $id)->update($data1);
                 return redirect('adBanner/'.$trang->bnTrang."/".$trang->bnVitri);
            }
            else
            {
                 $data = array();
            $data['bnTrangthai'] = 1;
            DB::table('slide')->where('bnMa', $bnOld->bnMa)->update($data);

            $data1 = array();
            $data1['bnTrangthai'] = 0;
            DB::table('slide')->where('bnMa', $id)->update($data1);
             return redirect('adBanner/'.$trang->bnTrang."/".$trang->bnVitri);
            }  
        }
      }
       //endbanner
      //Kho
      public function viewCTKho($id)
      {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);

        $data = DB::table('serial')
                            ->join('sanpham','sanpham.spMa','=','serial.spMa')
                            ->where('sanpham.spMa',$id)
                            ->whereNotIn('serTinhtrang',[3])
                            ->get();
        return view('admin.chi-tiet-kho')->with('data',$data);
      }
       //Kho h???ng
      public function viewCTKhoHong($id)
      {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);

        $data = DB::table('serial')
                            ->join('sanpham','sanpham.spMa','=','serial.spMa')
                            ->where('sanpham.spMa',$id)
                            ->where('serTinhtrang',3)
                            ->get();
        return view('admin.chi-tiet-kho-hong')->with('data',$data);
      }
      //????n m???i x??? l??
      public function viewXuLyDon($id)
      {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);
        $data = DB::table('donhang')->where('hdMa',$id)
                    ->join('khachhang','khachhang.khMa','=','donhang.khMa')->get();
        $data2 = DB::table('chitietdonhang')->where("hdMa",$id)
                    ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                    ->get();
        $dataNV = DB::table('admin')->where('adQuyen',4)->get();
        $dataSer = DB::table('serial')->where('serTinhtrang',0)->get();

        return view('admin.xu-ly-don-moi',compact('data','data2','dataNV','dataSer','noteDanhgia','noteDonhang','noteDonhang1'));
      }

        //H??a ????n
 
      public function giaohang(Request $re,$id)
      {
        if(in_array(0,$re->serMa))
        {
            Session::flash('error','Vui l??ng nh???p ?????y ????? m??');
             return "<script>window.history.back();</script>"; 
        }

        $array=array();
        foreach($re->serMa as $item)
        {
            if(in_array($item,$array)==false)
            {
                array_push($array,$item);
            }
        }
        if(count($re->serMa) != count($array))
        {
            Session::flash('error','???? nh???p tr??ng m?? vui l??ng nh???p l???i');
             return "<script>window.history.back();</script>"; 
        }
        
        $count=0;
        $update=array();
        $cthd = chitietdonhang::where('hdMa',$id)->get();
        foreach($cthd as $v)
        {
            if($v->serMa == null)
            {
                foreach($re->serMa as $item)
                {
                    $c = serial::join('sanpham','sanpham.spMa','serial.spMa')->where('serial.serMa',$item)->first();

                    if($v->spMa==$c->spMa)
                    {
                    $update['serMa']=$item;
                    $x=DB::table('chitietdonhang')->where('hdMa',$id)->where('spMa',$v->spMa)->where('serMa',null)->take(1)->update($update);

                    $dbSer = array();
                    $dbSer['serTinhtrang'] = 1; 
                    DB::table('serial')->where('serMa',$item)->update($dbSer);
                    }
               
                }
            }
        }


        $hdOld = DB::table('donhang')->where('hdMa',$id)->first();
        $data = array();
        if($hdOld->hdTinhtrang==0)
        {
            $data["hdTinhtrang"]=1;
        }
        else if($hdOld->hdTinhtrang==3)
        {
            $data["hdTinhtrang"]=4;
        }
        else if($hdOld->hdTinhtrang==5)
        {
            $data["hdTinhtrang"]=6;
        }
         else if($hdOld->hdTinhtrang==7)
        {
            $data["hdTinhtrang"]=8;
        }
        $data["adMa"]=$re->hdNhanvien;
        DB::table('donhang')->where('hdMa',$id)->update($data);
        
        $nv = DB::table('admin')->select('adTen')->where('adMa',$data["adMa"])->first();
        $data1 = array();
        $data1['adMa'] = Auth::user()->adMa;
        $data1['alChitiet'] = "Giao h??ng: Nh??n vi??n ".$nv->adTen." nh???n ????n h??ng c?? m?? ".$id;
        $data1['alNgaygio']= now();
        DB::table('admin_log')->insert($data1);
        
        Session::flash('success','C???p nh???t th??nh c??ng');
        return redirect('don-hang');
      }
      public function thanhtoan($id)
      {
        // $d = array();
        // $d['serTinhtrang'] = 0;
        //DB::table('serial')->where('serTinhtrang',2)->update($d);
        $data = array();
        $data["hdTinhtrang"]=2;
        DB::table('donhang')->where('hdMa',$id)->update($data);

        $db = DB::table('chitietdonhang')->where('hdMa',$id)->get();
        $kho = DB::table('kho')->get();
        $upKho = array();
       $up = array();
       $ser = DB::table('serial')->get();

       foreach($db as $v)
       {
           foreach($ser as $value)
           {
             foreach($kho as $k)
            {
                if($value->serMa == $v->serMa && $v->spMa == $k->spMa)
                {
                    $sl = DB::table('chitietdonhang')->where('hdMa',$v->hdMa)->where('spMa',$v->spMa)->count('spMa');
                  
                     $upKho['khoSoluongdaban']=$k->khoSoluongdaban+$sl;
                    $up['serTinhtrang'] = 2;
                     DB::table('serial')->where('serMa',$value->serMa)->update($up);
                    DB::table('kho')->where('spMa',$v->spMa)->update($upKho);
                }
            }
           }
        }



        return "<script>window.history.back();</script>"; 
      }
// tao don hang //
    public function taodonhangview()
    {
        $user = khachhang::all();
        $product= sanpham::leftjoin('hinh','hinh.spMa','sanpham.spMa')->leftjoin('loai','loai.loaiMa','sanpham.loaiMa')->leftjoin('thuonghieu','thuonghieu.thMa','sanpham.thMa')->leftjoin('kho','kho.spMa','sanpham.spMa')->leftjoin('nhacungcap','nhacungcap.nccMa','sanpham.nccMa')->where('hinh.thutu',1)->get();
        $dh=donhang::where('hdTinhtrang',1)->orWhere('hdTinhtrang',4)->get();
        return view('admin.taodonhang',compact('product','user','dh'));
    }

    public function findPhoneNum(Request $re)
    {
        if($re->sdt == null)
        {
            return response()->json(['message'=>1]);
        }
        $check=khachhang::where('khSdt',$re->sdt)->first();
        if($check)
        {
            return response()->json(['message'=>1,'khTen'=>$check->khTen,'khMa'=>$check->khMa,'khDiachi'=>$check->khDiachi,'khSdt'=>$check->khSdt]);
        }
        return response()->json(['message'=>0]);
    }


    public function addDonhang(Request $re)
    {
        if($re->khMa == null)
        {
            Session::flash('error'," Vui l??ng nh???p ?????y ????? th??ng tin kh??ch h??ng!");
             return "<script>window.history.back();</script>"; 
        }
        if($re->checkboxsp==null)
        {
            Session::flash('error'," Vui l??ng ch???n s???n ph???m!");
             return "<script>window.history.back();</script>"; 
        }
        else
        {
            $Cart=array();
            $total=0;
            $count=0;
            $user['khMa']=$re->khMa;
            $user['khTen']=$re->khTen;
            $user['khDiachi']=$re->khDiachi;
            $user['khSdt']=$re->khSdt;
            if($re->dhbosung == 1)
            {
                Session::put('dhbosung',$re->dh);
            }
            foreach($re->checkboxsp as $item)
            {
                $productinfo=sanpham::join('hinh','hinh.spMa','sanpham.spMa')->where('sanpham.spMa',$item)->first();
                if($re->input('spSl'.$item)==null || $re->input('spSl'.$item)==0 )
                {
                    Session::flash('error'," Vui l??ng nh???p s??? l?????ng!");
                     return "<script>window.history.back();</script>"; 
                }
                $productinfo->soluong=$re->input('spSl'.$item);
                $Cart[$item]=$productinfo;
                $total+=$productinfo->spGia*$re->input('spSl'.$item);
                $count+=$re->input('spSl'.$item);
            }
            return view('admin.xacnhandonhang',compact('Cart','total','user','count'));
        }
    }

    public function acceptOrder(Request $re)
    {
        if(Session::get('dhbosung')!=NULL)
        {
            $dhOld = DB::table('donhang')->where('hdMa',Session::get('dhbosung'))->first();
        }
       
        //Create don hang
        $dh = new donhang();
        $dh->khMa=$re->khMa;
        $dh->hdSoluongsp=$re->count;
        $dh->hdTongtien=$re->total;
        $dh->hdNgaytao=date_create();
        if($dhOld->hdTinhtrang==1)
        {
             $dh->hdTinhtrang=5;
        }
        else if($dhOld->hdTinhtrang==4)
        {
            $dh->hdTinhtrang=7;
        }
         else
        {
            $dh->hdTinhtrang=0;
        }
        $dh->hdbosung=Session::get('dhbosung');
        $dh->hdSdtnguoinhan=$re->khSdt;
        $dh->hdDiachi=$re->khDiachi;
        $date=getdate();
        $dh->hdMa=''.$date['seconds'].$date['minutes'].substr($dh->hdTongtien,0,1).$date['yday'].$date['mon'];
        $dhMa=$dh->hdMa;
        $dh->save();
        foreach($re->spMa as $item)
        {
            for($i=0;$i < $re->input("$item");$i++)
            {
                $product=sanpham::where('sanpham.spMa',$item)->join('kho','kho.spMa','sanpham.spMa')->first();
                $sl['khoSoluong']=$product->khoSoluong-1;
                DB::table('kho')->where('spMa',$item)->update($sl);
                $ct=new chitietdonhang();
                $ct->hdMa=$dhMa;
                $ct->spMa=$item;
                $ct->cthdGia=$product->spGia;
                $ct->save();
            }
        }

        $dataOld = array();
        $dataOld['hdTinhtrang'] = 10;
        DB::table('donhang')->where('hdMa',Session::get('dhbosung'))->update($dataOld);

        Session::forget('dhbosung');
        Session::flash('success','T???o ????n h??ng th??nh c??ng !');
        return Redirect::to('don-hang');
    }
    // bao hanh
    public function baohanhview()
    {
        $log = baohanh_log::orderBy('bhNgay')->get();
        return view('admin.baohanh',compact('log'));
    }

    public function findproductSerial(Request $re)
    {
        $today=date('y-m-d');
         $sp=donhang::leftjoin('chitietdonhang','chitietdonhang.hdMa','donhang.hdMa')->leftjoin('sanpham','sanpham.spMa','chitietdonhang.spMa')->where('chitietdonhang.serMa',$re->id)->get();
        $thoigianbaohanh=donhang::leftjoin('chitietdonhang','chitietdonhang.hdMa','donhang.hdMa')->leftjoin('sanpham','sanpham.spMa','chitietdonhang.spMa')->where('chitietdonhang.serMa',$re->id)->first();
        if($thoigianbaohanh)
        {
            $bh_log= baohanh_log::where('serial',$re->id)->orderBy('bhNgay','desc')->get();
            $thangbaohanh=$thoigianbaohanh->spHanbh;
            $thoigianbaohanhsaukhimua = strtotime(date("Y-m-d", strtotime($thoigianbaohanh->hdNgaytao)) . " + $thangbaohanh month");
            $thoigianbaohanhsaukhimua = strftime("%Y-%m-%d", $thoigianbaohanhsaukhimua);
            if(strtotime($today) < strtotime($thoigianbaohanhsaukhimua))    
            {
                return response()->json(['message'=>1,'bhlog'=>$bh_log,'productinfo'=>$sp]);
            }
            return response()->json(['message'=>0]);   
        }
        else
        {
            $checkinkho = serial::where('serMa',$re->id)->first();
            if($checkinkho)
            {
                return response()->json(['message'=>3]);
            }
        }
        return response()->json(['message'=>2]);
    }

    public function addbaohanhview()
    {
        return view('admin.thembaohanh');
    }
    
    public function thembaohanh(Request $re)
    {
        $messages =[
                'bhNoidung.required'=>'Vui l??ng nh???p n???i dung !',
                'bhSdt.required'=>'Vui l??ng nh???p s??? ??i???n tho???i kh??ch!',
            ];
            $this->validate($re,[
               'bhNoidung'=>'required',
                'bhSdt'=>'required',
            ],$messages);
        $checkExistBh= baohanh_log::where('serial',$re->serMa)->where('bhTinhtrang',0)->first();
        if($checkExistBh)
        {
            Session::flash('err','S???n ph???m ??ang ???????c b???o h??nh!');
             return "<script>window.history.back();</script>"; 
        }

        $bh=new baohanh_log();
        $bh->bhNgay=now();
        $bh->serial=$re->serMa;
        $bh->khMa=$re->khMa;
        $bh->bhSdt=$re->bhSdt;
        $bh->bhNoidung=$re->bhNoidung;
        $bh->save();
        return Redirect::to('adBaohanh');
    }
    public function xacnhantrahang(Request $re)
    {
        $bh=baohanh_log::where('bhMa',$re->id)->first();
        $bh->bhTinhtrang = 1;
        $bh->save();
        return Redirect()->back();
    }
    //tknganhang
    public function themtknhpage()
    {
        return view('admin.themtknhpage');
    }

    public function themtknh(Request $re)
    {
        if($re->stk ==null)
        {
            Session::flash('error','Vui l??ng nh???p s??? t??i kho???n!');
             return "<script>window.history.back();</script>";   
        }
        if($re->tenchuthe ==null)
        {
            Session::flash('error','Vui l??ng nh???p t??n ch??? th???!');
             return "<script>window.history.back();</script>"; 
        }
        if($re->tennganhang ==null)
        {
            Session::flash('error','Vui l??ng nh???p t??n ng??n h??ng!');
             return "<script>window.history.back();</script>"; 
        }
        $checkexist=tknganhang::where('stk',$re->stk)->where('tennganhang',$re->tennganhang)->first();
        if($checkexist)
        {
            Session::flash('error','T??i kho???n ???? t???n t???i!');
             return "<script>window.history.back();</script>"; 
        }
        $tk= new tknganhang();
        $tk->stk=$re->stk;
        $tk->tenchuthe=$re->tenchuthe;
        $tk->tennganhang=$re->tennganhang;
        $tk->save();
        Session::flash('success','Th??m th??nh c??ng!');
            return $this->ptthanhtoanpage();

    }
    
    public function deletetknh(Request $re)
    {
        DB::table('tknganhang')->where('stk',$re->id)->delete();
        Session::flash('success','X??a th??nh c??ng !');
        return redirect()->back();
    }

    // Momo
    // 
    public function ptthanhtoanpage()
    {
        $momo = payment::where('pmId',1)->first();
        $tknganhang=tknganhang::all();
        return view('admin.ptthanhtoan',compact('momo','tknganhang'));
    }

    public function updatepayment(Request $re)
    {
        $messages =[
            "pmNamemomo.required"=>"T??n kh??ng ???????c ????? tr???ng!",
            "endpointmomo.required"=>"endpoint kh??ng ???????c ????? tr???ng!",
            "partnerCodemomo.required"=>"partnerCode kh??ng ???????c ????? tr???ng!",
            "accessKeymomo.required"=>"accessKey kh??ng ???????c ????? tr???ng !",
            "secrectKeymomo.required"=>"secrectKey kh??ng ???????c ????? tr???ng!",
            "extraDatamomo.required"=>"extraData  kh??ng ???????c ????? tr???ng!",
            ];
            $this->validate($re,[
            "pmNamemomo"=>"required",
            "endpointmomo"=>"required",
            "partnerCodemomo"=>"required",
            "accessKeymomo"=>"required",
            "secrectKeymomo"=>"required",
            "extraDatamomo"=>"required",
            ],$messages);
            $pmNamemomo=$re->pmNamemomo;
            $endpointmomo=$re->endpointmomo;
            $partnerCodemomo=$re->partnerCodemomo;
            $accessKeymomo=$re->accessKeymomo;
            $secrectKeymomo=$re->secrectKeymomo;
            $extraDatamomo=$re->extraDatamomo;
            $pm=payment::where('pmId',$re->pmIdmomo)->first();
            $pm->pmName=$pmNamemomo;
            $pm->endpoint=$endpointmomo;
            $pm->partnerCode=$partnerCodemomo;
            $pm->accessKey=$accessKeymomo;
            $pm->serectkey=$secrectKeymomo;
            $pm->extraData=$extraDatamomo;
            //check available
                $endpoint = $endpointmomo;
                $partnerCode =$partnerCodemomo;
                $accessKey =$accessKeymomo;
                $serectkey =$secrectKeymomo;
                $orderInfo = "Thanh to??n ????n h??ng ";
                $amount = '1000';
                $orderId ="".rand(100,100000)."";
                $returnUrl = route('resultpayment');
                $notifyurl = 'adminapi';
                // L??u ??: link notifyUrl kh??ng ph???i l?? d???ng localhost
                $extraData = "merchantName=STU";
                $requestId = "".rand(100,100000)."";
                $requestType = "captureMoMoWallet";
                //before sign HMAC SHA256 signature
                $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData;
                        $signature = hash_hmac("sha256", $rawHash, $serectkey);
                        $data = array('partnerCode' => $partnerCode,
                'accessKey' => $accessKey,
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'returnUrl' => $returnUrl,
                'notifyUrl' => $notifyurl,
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);            
                $result= Http::post($endpoint, $data);
                if($result['errorCode']!=0)
                {
                    Session::flash('error','Th??ng tin v???a nh???p kh??ng h???p l??? vui l??ng ki???m tra l???i!');
                    return redirect()->back();
                }
            //----------------------
            $pm->update();
            Session::flash('success','C???p nh???t th??nh c??ng !');
            return redirect()->back();
        }

        public function changePaymentStatus($id)
        {
            $pm=payment::where('pmId',$id)->first();
            if($pm->pmStatus == 0 )
            {
                Session::flash('success','???? chuy???n tr???ng th??i ph????ng th???c thanh to??n '.$pm->pmName.'  th??nh ???n !');
                $pm->pmStatus =1 ;
                $pm->update();
            }
            else
            {
                Session::flash('success','???? chuy???n tr???ng th??i ph????ng th???c thanh to??n '.$pm->pmName.'  th??nh hi???n !');
                $pm->pmStatus =0 ;   
                $pm->update();
            }
            return Redirect()->back();
        }

    ///TH???NG K??///
     public function searchThongke(Request $re)
    {
            $start = date_create($re->start);
            $end = date_create($re->end);

            $dh = donhang::selectRaw('hdNgaytao,MONTH(donhang.hdNgaytao) AS month,YEAR(donhang.hdNgaytao) AS year')->whereBetween('donhang.hdNgaytao',[$start,$end])
                                ->where('hdTinhtrang',2)
                                ->count();
            $total_price = donhang::selectRaw('hdNgaytao,MONTH(donhang.hdNgaytao) AS month,YEAR(donhang.hdNgaytao) AS year')->whereBetween('donhang.hdNgaytao',[$start,$end])
                                ->where('hdTinhtrang',2)
                                ->sum('hdTongtien');

             $total_pay = phieunhap::selectRaw('pnNgaylap,MONTH(phieunhap.pnNgaylap) AS month,YEAR(phieunhap.pnNgaylap) AS year')->whereBetween('phieunhap.pnNgaylap',[$start,$end])
                                ->sum('pnTongtien');
            //$total_price = DB::table('donhang')->where('hdTinhtrang',2)->sum('hdTongtien');
            $total_sp = DB::table('sanpham')->count();
           // $total_pay = DB::table('phieunhap')->sum('pnTongtien');
           return response()->json(['message'=>0,'dh'=>$dh,'total_price'=>$total_price,'total_pay'=>$total_pay]);

    }

    // Search th???ng k?? ///
    public function searchQuy(Request $re)
    {
            $quy_default = $re->searchQuy;

            $don_moi = $this->don_moi();
            $don_danggiao = $this->don_danggiao();
            $don_xong = $this->don_xong();
            $don_no = $this->don_no();

            $show_dongiao = $this->show_dongiao();

            $quy_lap1 = $this->quy_lap1();
            $quy_pc1 = $this->quy_pc1();
            $quy_lap2 = $this->quy_lap2();
            $quy_pc2 = $this->quy_pc2();
            $quy_lap3 = $this->quy_lap3();
            $quy_pc3 = $this->quy_pc3();
            $quy_lap4 = $this->quy_lap4();
            $quy_pc4 = $this->quy_pc4();

            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $nv = DB::table('admin')->get();
            $sp = DB::table('sanpham')
                ->join('hinh','hinh.spMa','=','sanpham.spMa')
                ->where('hinh.thutu','=','1')
                ->join('kho','kho.spMa','=','sanpham.spMa')
                ->where('kho.khoSoluong','>','0')
                ->get();
            $dh = DB::table('donhang')->where('hdTinhtrang',2)->count();
            $start = date_create("2021-07-01 00:00:00");
            $end = date_create("2021-09-01 00:00:00");
            $total_price = donhang::selectRaw('hdNgaytao,MONTH(donhang.hdNgaytao) AS month,YEAR(donhang.hdNgaytao) AS year')->whereBetween('donhang.hdNgaytao',[$start,$end])
                                ->where('hdTinhtrang',2)
                                ->sum('hdTongtien');
            $total_pay = phieunhap::selectRaw('pnNgaylap,MONTH(phieunhap.pnNgaylap) AS month,YEAR(phieunhap.pnNgaylap) AS year')->whereBetween('phieunhap.pnNgaylap',[$start,$end])->sum('pnTongtien');
            $total_sp = DB::table('sanpham')->count();
            if($re->searchQuy == 1)
            {
                $quy_spNow = $this->quy_sp1();
                 return view('admin.index',compact('nv','sp','dh','total_price','total_sp','total_pay','quy_lap1','quy_pc1','quy_lap2','quy_pc2','quy_lap3','quy_pc3','quy_lap4','quy_pc4','quy_spNow','quy_default','don_danggiao','don_xong','show_dongiao','noteDonhang','noteDonhang1','noteDanhgia','don_moi','don_no'));
            }
            if($re->searchQuy == 2)
            {
                $quy_spNow = $this->quy_sp2();
                 return view('admin.index',compact('nv','sp','dh','total_price','total_sp','total_pay','quy_lap1','quy_pc1','quy_lap2','quy_pc2','quy_lap3','quy_pc3','quy_lap4','quy_pc4','quy_spNow','quy_default','quy_default','don_danggiao','don_xong','show_dongiao','noteDonhang','noteDonhang1','noteDanhgia','don_moi','don_no'));
            }
            if($re->searchQuy == 3)
            {
                $quy_spNow = $this->quy_sp3();
                 return view('admin.index',compact('nv','sp','dh','total_price','total_sp','total_pay','quy_lap1','quy_pc1','quy_lap2','quy_pc2','quy_lap3','quy_pc3','quy_lap4','quy_pc4','quy_spNow','quy_default','don_danggiao','don_xong','show_dongiao','noteDonhang','noteDonhang1','noteDanhgia','don_moi','don_no'));
            }
             if($re->searchQuy == 4)
            {
                $quy_spNow = $this->quy_sp4();
                 return view('admin.index',compact('nv','sp','dh','total_price','total_sp','total_pay','quy_lap1','quy_pc1','quy_lap2','quy_pc2','quy_lap3','quy_pc3','quy_lap4','quy_pc4','quy_spNow','quy_default','don_danggiao','don_xong','show_dongiao','noteDonhang','noteDonhang1','noteDanhgia','don_moi','don_no'));
            }
    }

    // B??o c??o //
    public function viewBcTong()
    {
           $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);

            $data = DB::table('baocao')->orderBy('bcNgaylap','desc')
                        ->join('admin','admin.adMa','=','baocao.adMa')
                        ->get(); 
            return view('admin.bao-cao-tong',compact('data'));
    }
     public function viewThemBcTong()
    {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);  
            
            return view('admin.lap-bao-cao-tong'); 
    }
     public function searchBaocao(Request $re)
    {  
        if($re->start !=null && $re->end != null)
        {
            $total_hn = DB::table('phieunhap')
                    ->whereBetween('pnNgaylap',[$re->start,$re->end])
                    ->sum('pnSoluongsp'); 
            $total_hx = DB::table('donhang')
                    ->whereBetween('hdNgaytao',[$re->start,$re->end])
                    ->sum('hdSoluongsp'); 
            $spChi = DB::table('phieunhap')
                    ->whereBetween('pnNgaylap',[$re->start,$re->end])
                    ->sum('pnSoluongsp'); 
            $ttChi = DB::table('phieunhap')
                    ->whereBetween('pnNgaylap',[$re->start,$re->end])
                    ->sum('pnTongtien'); 
            $spXuat = DB::table('donhang')
                    ->whereBetween('hdNgaytao',[$re->start,$re->end])
                    ->sum('hdSoluongsp'); 
            $ttThu = DB::table('donhang')
                    ->whereBetween('hdNgaytao',[$re->start,$re->end])
                    ->sum('hdTongtien'); 
            return response()->json(['message'=>0,'tongnhap'=>$total_hn,'tongxuat'=>$total_hx,'start'=>$re->start,'end'=>$re->end,'spChi'=>$spChi,'ttChi'=>$ttChi,'spXuat'=>$spXuat,'ttThu'=>$ttThu]);
        }
        else if($re->start !=null && $re->end == null || $re->end == 0)
        {
            $total_hn = DB::table('phieunhap')
                    ->whereDate('pnNgaylap','=',$re->start)
                    ->sum('pnSoluongsp'); 
            $total_hx = DB::table('donhang')
                    ->whereDate('hdNgaytao','=',$re->start)
                    ->sum('hdSoluongsp');
            $spChi = DB::table('phieunhap')
                    ->whereDate('pnNgaylap','=',$re->start)
                    ->sum('pnSoluongsp'); 
            $ttChi = DB::table('phieunhap')
                    ->whereDate('pnNgaylap','=',$re->start)
                    ->sum('pnTongtien');
            $spXuat = DB::table('donhang')
                    ->whereDate('hdNgaytao','=',$re->start)
                    ->sum('hdSoluongsp'); 
            $ttThu = DB::table('donhang')
                    ->whereDate('hdNgaytao','=',$re->start)
                    ->sum('hdTongtien');   
            return response()->json(['message'=>0,'tongnhap'=>$total_hn,'tongxuat'=>$total_hx,'start'=>$re->start,'end'=>null,'spChi'=>$spChi,'ttChi'=>$ttChi,'spXuat'=>$spXuat,'ttThu'=>$ttThu]);
        }  
    }
    public function adCheckAddBcTong(Request $re)
    {
        $data1 = array();
        $data1['chiMa'] = rand(100,1000).strlen($re->chiTongtien).rand(10,100);
        $data1['chiNgaylap'] = now();
        $data1['chiNgaybd'] = $re->bcTungay;
        $data1['chiNgaykt'] = $re->bcDenngay;
        $data1['chiSoluong'] = $re->chiSoluong;
        $data1['chiTongtien'] = $re->chiTongtien;
        $data1['chiGhichu'] = null;
        $data1['adMa'] = Auth::user()->adMa;
        DB::table('chi')->insert($data1);

        $data2 = array();
        $data2['thuMa'] = rand(100,1000).strlen($re->thuTongtien).rand(10,100);
        $data2['thuNgaylap'] = now();
        $data2['thuNgaybd'] = $re->bcTungay;
        $data2['thuNgaykt'] = $re->bcDenngay;
        $data2['thuSoluong'] = $re->thuSoluong;
        $data2['thuTongtien'] = $re->thuTongtien;
        $data2['thuGhichu'] = null;
        $data2['adMa'] = Auth::user()->adMa;
        DB::table('thu')->insert($data2);

        $tonkho = DB::table('kho')->sum('khoSoluong');
        $data = array();
        $data['bcMa'] = rand(100,1000).time().rand(10,100);
        $data['bcTonghangxuat'] =  $re->bcTonghangxuat;
        $data['bcTonghangnhap'] =  $re->bcTonghangxuat;
        $data['bcThu'] =  $data2['thuMa'];
        $data['bcChi'] =  $data1['chiMa'];
        $data['bcTonkho'] = $tonkho;
        $data['bcNgaylap'] = now();
        $data['bcTungay'] = $re->bcTungay;
        $data['bcDenngay'] = $re->bcDenngay;
        $data['bcGhichu'] = $re->chiGhichu;
        $data['adMa'] = Auth::user()->adMa;

        DB::table('baocao')->insert($data);


        if($re->bcTungay != NULL && $re->bcDenngay !=NULL)
        {
            $chiInfo = DB::table('phieunhap')->whereBetween('pnNgaylap',[$re->bcTungay,$re->bcDenngay])->get('pnMa');
            foreach($chiInfo as $k => $v)
            {
                $data1 = array();
                $data1['chiMa'] = $data['bcChi'];
                $data1['pnMa'] = $v->pnMa;
                DB::table('chitietchi')->insert($data1);
            }
             $thuInfo = DB::table('donhang')->whereBetween('hdNgaytao',[$re->bcTungay,$re->bcDenngay])->get('hdMa');
            foreach($thuInfo as $k => $v)
            {
                $data1 = array();
                $data1['thuMa'] = $data['bcThu'];
                $data1['hdMa'] = $v->hdMa;
                DB::table('chitietthu')->insert($data1);
            }  
        }
        else if($re->bcTungay != NULL && $re->bcDenngay == NULL || $re->bcDenngay == 0)
        {
        $chiInfo = DB::table('phieunhap')->whereDate('pnNgaylap','=',$re->bcTungay)->get('pnMa');
                foreach($chiInfo as $k => $v)
                {
                $data = array();
                $data['chiMa'] = $data['bcChi'];
                $data['pnMa'] = $v->pnMa;
                DB::table('chitietchi')->insert($data);
                }    
          
          $thuInfo = DB::table('donhang')->whereDate('hdNgaytao','=',$re->bcTungay)->get('hdMa');
          foreach($thuInfo as $k => $v)
            {
                $data = array();
                $data['thuMa'] = $data['bcThu'];
                $data['hdMa'] = $v->hdMa;
                DB::table('chitietthu')->insert($data);
            }    
        }
        return Redirect('adBaocao');
    }
    public function chitietBctong($id)
    {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);  

            $data = DB::table('baocao')->where('bcMa',$id)
                        ->join('admin','admin.adMa','=','baocao.adMa')
                        ->get();

            $bcChi = DB::table('baocao')->where('bcMa',$id)->first('bcChi');
            $data2 = DB::table('chitietchi')->where('chiMa',$bcChi->bcChi)
                            ->join('phieunhap','phieunhap.pnMa','=','chitietchi.pnMa')
                            ->join('admin','admin.adMa','=','phieunhap.adMa')
                            ->orderBy('pnNgaylap','asc')
                            ->get();

            $bcThu = DB::table('baocao')->where('bcMa',$id)->first('bcThu');
            $data3 = DB::table('chitietthu')->where('thuMa',$bcThu->bcThu)
                            ->join('donhang','donhang.hdMa','=','chitietthu.hdMa')
                            ->join('khachhang','khachhang.khMa','=','donhang.khMa')
                            ->orderBy('hdNgaytao','asc')
                            ->get();
            
            return view('admin.chi-tiet-bao-cao-tong',compact('data','data2','data3'));
    }
   



   // B??o c??o chi
    public function viewChi()
    {
           $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);

            $data = DB::table('chi')->orderBy('chiNgaylap','desc')
                            ->join('admin','admin.adMa','=','chi.adMa')
                            ->get(); 

            return view('admin.bao-cao-chi',compact('data'));
    }
     public function viewThemChi()
    {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);  
            
            return view('admin.lap-bao-cao-chi'); 
    }
    public function searchChi(Request $re)
    {
        if($re->start !=null && $re->end != null)
        {
            $total_sp = DB::table('phieunhap')
                    ->whereBetween('pnNgaylap',[$re->start,$re->end])
                    ->sum('pnSoluongsp'); 
            $total_tt = DB::table('phieunhap')
                    ->whereBetween('pnNgaylap',[$re->start,$re->end])
                    ->sum('pnTongtien'); 
            return response()->json(['message'=>0,'tongsp'=>$total_sp,'tongtien'=>$total_tt,'start'=>$re->start,'end'=>$re->end]);
        }
        else if($re->start !=null && $re->end == null || $re->end == 0)
        {
            $total_sp = DB::table('phieunhap')
                    ->whereDate('pnNgaylap','=',$re->start)
                    ->sum('pnSoluongsp'); 
            $total_tt = DB::table('phieunhap')
                    ->whereDate('pnNgaylap','=',$re->start)
                    ->sum('pnTongtien'); 
            return response()->json(['message'=>0,'tongsp'=>$total_sp,'tongtien'=>$total_tt,'start'=>$re->start,'end'=>null]);
        }  
    }
    public function adCheckAddChi(Request $re)
    {
        $data = array();
        $data['chiMa'] = rand(100,1000).strlen($re->chiTongtien).rand(10,100);
        $data['chiNgaylap'] = now();
        $data['chiNgaybd'] = $re->chiNgaybd;
        $data['chiNgaykt'] = $re->chiNgaykt;
        $data['chiSoluong'] = $re->chiSoluong;
        $data['chiTongtien'] = $re->chiTongtien;
        $data['chiGhichu'] = $re->chiGhichu;
        $data['adMa'] = Auth::user()->adMa;

         DB::table('chi')->insert($data);

        if($re->chiNgaybd != NULL && $re->chiNgaykt !=NULL)
        {
            $chiInfo = DB::table('phieunhap')->whereBetween('pnNgaylap',[$re->chiNgaybd,$re->chiNgaykt])->get('pnMa');
            foreach($chiInfo as $k => $v)
            {
                $data1 = array();
                $data1['chiMa'] = $data['chiMa'];
                $data1['pnMa'] = $v->pnMa;
                DB::table('chitietchi')->insert($data1);
            }  
        }
        else if($re->chiNgaybd != NULL && $re->chiNgaykt == NULL || $re->chiNgaykt == 0)
        {
        $chiInfo = DB::table('phieunhap')->whereDate('pnNgaylap','=',$re->chiNgaybd)->get('pnMa');
          foreach($chiInfo as $k => $v)
            {
                $data1 = array();
                $data1['chiMa'] = $data['chiMa'];
                $data1['pnMa'] = $v->pnMa;
                DB::table('chitietchi')->insert($data1);
            }  
        }
        return Redirect('bcChi');
    }
    public function chitietBcchi($id)
    {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);  

            $data = DB::table('chi')->where('chiMa',$id)->get();
             $data2 = DB::table('chitietchi')->where('chiMa',$id)
                            ->join('phieunhap','phieunhap.pnMa','=','chitietchi.pnMa')
                            ->join('admin','admin.adMa','=','phieunhap.adMa')
                            ->orderBy('phieunhap.pnNgaylap','asc')
                            ->get();
            return view('admin.chi-tiet-bao-cao-chi',compact('data','data2'));
    }


    // B??o c??o thu 
     public function viewThu()
    {
           $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);

            $data = DB::table('thu')->orderBy('thuNgaylap','desc')
                            ->join('admin','admin.adMa','=','thu.adMa')
                            ->get(); 
            return view('admin.bao-cao-thu',compact('data'));
    }
     public function viewThemThu()
    {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);  
            
            return view('admin.lap-bao-cao-thu'); 
    }
    public function searchThu(Request $re)
    {
        if($re->start !=null && $re->end != null)
        {
            $total_sp = DB::table('donhang')
                    ->whereBetween('hdNgaytao',[$re->start,$re->end])
                    ->sum('hdSoluongsp'); 
            $total_tt = DB::table('donhang')
                    ->whereBetween('hdNgaytao',[$re->start,$re->end])
                    ->sum('hdTongtien'); 
            return response()->json(['message'=>0,'tongsp'=>$total_sp,'tongtien'=>$total_tt,'start'=>$re->start,'end'=>$re->end]);
        }
        else if($re->start !=null && $re->end == null || $re->end == 0)
        {
            $total_sp = DB::table('donhang')
                    ->whereDate('hdNgaytao','=',$re->start)
                    ->sum('hdSoluongsp'); 
            $total_tt = DB::table('donhang')
                    ->whereDate('hdNgaytao','=',$re->start)
                    ->sum('hdTongtien'); 
            return response()->json(['message'=>0,'tongsp'=>$total_sp,'tongtien'=>$total_tt,'start'=>$re->start,'end'=>null]);
        }  
    }
    public function adCheckAddThu(Request $re)
    {
        $data = array();
        $data['thuMa'] = rand(100,1000).strlen($re->thuTongtien).rand(10,100);
        $data['thuNgaylap'] = now();
        $data['thuNgaybd'] = $re->thuNgaybd;
        $data['thuNgaykt'] = $re->thuNgaykt;
        $data['thuSoluong'] = $re->thuSoluong;
        $data['thuTongtien'] = $re->thuTongtien;
        $data['thuGhichu'] = $re->thuGhichu;
        $data['adMa'] = Auth::user()->adMa;

         DB::table('thu')->insert($data);

        if($re->thuNgaybd != NULL && $re->thuNgaykt !=NULL)
        {
            $thuInfo = DB::table('donhang')->whereBetween('hdNgaytao',[$re->thuNgaybd,$re->thuNgaykt])->get('hdMa');
            foreach($thuInfo as $k => $v)
            {
                $data1 = array();
                $data1['thuMa'] = $data['thuMa'];
                $data1['hdMa'] = $v->hdMa;
                DB::table('chitietthu')->insert($data1);
            }  
        }
        else if($re->thuNgaybd != NULL && $re->thuNgaykt == NULL || $re->thuNgaykt == 0)
        {
        $thuInfo = DB::table('donhang')->whereDate('pnNgaylap','=',$re->chiNgaybd)->get('hdMa');
          foreach($thuInfo as $k => $v)
            {
                $data1 = array();
                $data1['thuMa'] = $data['thuMa'];
                $data1['hdMa'] = $v->hdMa;
                DB::table('chitietthu')->insert($data1);
            }  
        }
        return Redirect('bcThu');
    }
    public function chitietBcthu($id)
    {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);  

            $data = DB::table('thu')->where('thuMa',$id)->get();
            $data2 = DB::table('chitietthu')->where('thuMa',$id)
                            ->join('donhang','donhang.hdMa','=','chitietthu.hdMa')
                            ->join('khachhang','khachhang.khMa','=','donhang.khMa')
                            ->orderBy('donhang.hdNgaytao','asc')
                            ->get();
            return view('admin.chi-tiet-bao-cao-thu',compact('data','data2'));
    }

    //T??ch ????n
    public function viewTachdon()
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);

        $data = DB::table('donhang')->where('hdTinhtrang',1)->orWhere('hdTinhtrang',3)
                            ->join('khachhang','khachhang.khMa','=','donhang.khMa')
                            ->get();
        return view('admin.tach-don',compact('data'));
    }
    public function xuLyTachDon($id)
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->orWhere('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',9)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);

        $data = DB::table('donhang')->where('hdMa',$id)
                    ->join('admin','admin.adMa','=','donhang.adMa')
                    ->join('khachhang','khachhang.khMa','=','donhang.khMa')->get();
        $data2 = DB::table('chitietdonhang')->where("hdMa",$id)
                    ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                    ->get();
       
        return view('admin.xu-ly-tach-don',compact('data','data2'));
    }
    public function tienHanhTachDon(Request $re, $id)
    {
        if($re->button=="update")
        {
            //dd('c???p nh???t');
            if($re->spBinhthuong != NULL && $re->spHong == NULL)
            {
                  Session::flash('note_err','C??c s???n ph???m ?????u b??nh th?????ng, ????? c???p nh???t ????n h??ng m???i c???n c?? s???n ph???m h???ng!');
                 return "<script>window.history.back();</script>"; 
            }
            else if($re->spHong != NULL && $re->spBinhthuong == NULL)
            {
                Session::flash('note_err','N???u c??c s???n ph???m ?????u h???ng vui l??ng ch???n h???y to??n ????n!');
                 return "<script>window.history.back();</script>"; 
            }
            else if($re->spBinhthuong == NULL && $re->spHong == NULL)
            {
                 Session::flash('note_err','????? ti???n h??nh c???p nh???t ????n h??ng b???n c???n ch???n ra s???n ph???m b??nh th?????ng v?? h???ng!');
                 return "<script>window.history.back();</script>"; 
            }
            else if($re->spBinhthuong == $re->spHong)
            {
               Session::flash('note_err','Kh??ng ???????c ch???n c??? b??nh th?????ng v?? h???ng cho 1 s???n ph???m!');
                 return "<script>window.history.back();</script>"; 
            }
            else
            {

              foreach($re->spHong as $k => $hong)
              {
                $hongExist = DB::table('serial')->where('serMa',$hong)->first();
                $dataSer = array();
                $dataSer['serTinhtrang'] = 3;
               DB::table('serial')->where('serMa',$hong)->update($dataSer);
               $khoHong = DB::table('kho_sp_hong')->where('spMa',$hongExist->spMa)->count();
               $khoHongExist = DB::table('kho_sp_hong')->where('spMa',$hongExist->spMa)->first();
               if($khoHong>=1)
               {
                $dataHong = array();
                $dataHong['khoSlsphong'] = $khoHongExist->khoSlsphong + 1;
              DB::table('kho_sp_hong')->where('spMa',$hongExist->spMa)->update($dataHong);
               }
               else if($khoHong == 0)
               {
                 $dataHong = array();
                 $dataHong['spMa']= $hongExist->spMa; 
                $dataHong['khoSlsphong'] = 1;
               DB::table('kho_sp_hong')->insert($dataHong);
               }
              }

            $idHdOld = $id;
            $arrSpMa = array();
           
            foreach($re->spBinhthuong as $thuong)
            {
                $masp = DB::table('serial')->where('serMa',$thuong)->first();
                $serThuong = array();
                $serThuong['serTinhtrang'] = 0;
               DB::table('serial')->where('serMa',$thuong)->update($serThuong);

                $khoOld = DB::table('kho')->where('spMa',$masp->spMa)->first();
                $khoThuong = array();
                $khoThuong['khoSoluong'] = $khoOld->khoSoluong + 1;
               DB::table('kho')->where('spMa',$khoOld->spMa)->update($khoThuong);

                array_push($arrSpMa,$masp);
                
            }
            $hdKhachhang = DB::table('donhang')->where('hdMa',$id)->join('khachhang','khachhang.khMa','=','donhang.khMa')->get();
            $dataproduct= sanpham::leftjoin('hinh','hinh.spMa','sanpham.spMa')->leftjoin('loai','loai.loaiMa','sanpham.loaiMa')->leftjoin('thuonghieu','thuonghieu.thMa','sanpham.thMa')->leftjoin('kho','kho.spMa','sanpham.spMa')->leftjoin('nhacungcap','nhacungcap.nccMa','sanpham.nccMa')->where('hinh.thutu',1)->get();
           
            $product = array();
            $arrSpOld = array();
            //$arrSpKm = array();
            foreach($dataproduct as $item)
            {   
                foreach($arrSpMa as $thuong)
                {
                    if($item->spMa==$thuong->spMa)
                    {
                        if(in_array($item,$arrSpOld)==false)
                        {
                            array_push($arrSpOld,$item);
                        }
                    }
                }
                if(in_array($item,$arrSpOld)==false)
                {
                     array_push($product,$item);
                }
            }
            $dataKm = DB::table('chitietdonhang')->select('hdMa','spMa','cthdTrigiakm')->where('hdMa',$id)->get();
           foreach($dataKm as $kmThuong)
           {
            foreach($arrSpMa as $thuong)
            {
                if($thuong->spMa == $kmThuong->spMa)
                {
                    if(SESSION::get('arrSpKm',$kmThuong)==null)
                    {
                       SESSION::push('arrSpKm',$kmThuong);  
                    } 
                }
            }
           }
     
       
             return view('admin.cap-nhat-don-hang-moi',compact('idHdOld','hdKhachhang','product','arrSpOld'));
            }
        }
        if($re->button=="split")
        {   
            //dd('t??ch');
        $db = DB::table('donhang')->where('hdMa',$id)->get();
        if($re->spHong==NULL)
        {
             Session::flash('note_err','B???n ch??a ch???n s???n ph???m!');
            return "<script>window.history.back();</script>"; 
        }
        else
        {
            $hdCu = DB::table('donhang')->where('hdMa',$id)->first();
            $hdTach = array();
            $hdTach['hdMa'] = time();
            $hdTach['hdNgaytao'] = now();
            $hdTach['hdSoluongsp'] = 0;
            $hdTach['hdTongtien'] = 0;
            $hdTach['hdTinhtrang'] = 10;
            $hdTach['hdSdtnguoinhan'] = $hdCu->hdSdtnguoinhan;
            $hdTach['hdDiachi'] = $hdCu->hdDiachi;
            $hdTach['hdGhichu'] = null;
            $hdTach['hdBosung'] = $id;
            $hdTach['hdGiamgia'] = null;
            $hdTach['hdGiakhuyenmai']=null;
            $hdTach['vcMa'] = null;
            $hdTach['kmMa']=null;
            $hdTach['adMa']=$hdCu->adMa;
            $hdTach['khMa']=$hdCu->khMa;
            DB::table('donhang')->insert($hdTach);

            foreach($re->spHong as $k => $v)
            {
            $masp = DB::table('serial')->where('serMa',$v)->first();
            $dongia = DB::table('chitietdonhang')->where('hdMa',$id)->where('spMa',$masp->spMa)->where('serMa',$v)->first();
            $hongExist = DB::table('kho_sp_hong')->where('spMa',$masp->spMa)->count();

            $ctdhTach = array();
            $ctdhTach['hdMa'] =  $hdTach['hdMa'];
            $ctdhTach['spMa'] =  $masp->spMa;
            $ctdhTach['cthdGia'] =  $dongia->cthdGia;
            $ctdhTach['serMa'] =  $v;
            $ctdhTach['cthdTrigiakm'] = $dongia->cthdTrigiakm;
            DB::table('chitietdonhang')->insert($ctdhTach);
           
              if($hongExist >= 1)
              {
                $hongSoluong = DB::table('kho_sp_hong')->where('spMa',$masp->spMa)->first();  
                $dataHong = array();
                $dataHong['khoSlsphong'] = $hongSoluong->khoSlsphong + 1;
            DB::table('kho_sp_hong')->where('spMa',$masp->spMa)->update($dataHong);
              }
              else
              {
                $db = array();
                $db['spMa'] = $masp->spMa;
                $db['khoSlsphong'] = 1;
              DB::table('kho_sp_hong')->insert($db);
              }
              $dataSer = array();
              $dataSer['serTinhtrang'] = 3;
           
            DB::table('serial')->where('spMa',$masp->spMa)->where('serMa',$v)->update($dataSer);

            $vocher = DB::table('donhang')->where('hdMa',$id)->first();
            if($vocher->vcMa !=NULL)
            {
                $dhOld = DB::table('donhang')->where('hdMa',$id)->first();
                $tongtien = $dhOld->hdTongtien-$dongia->cthdGia;
                $soluong = $dhOld->hdSoluongsp - 1;
                $vcMa = DB::table('donhang')->where('hdMa',$id)
                            ->join('voucher','voucher.vcMa','=','donhang.vcMa')
                            ->first();
                if($vcMa->vcLoai==1)
                {
                    if($vcMa->vcDkapdung == 0)
                    {
                        if($tongtien < $vcMa->vcGtcandat)
                           {
                             $dataDH = array();
                             $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                             $dataDH['hdTongtien'] = $dhOld->hdTongtien-$dongia->cthdGia+$dhOld->hdGiamgia;
                             $dataDH['hdGiamgia'] = NULL;
                             $dataDH['hdGiakhuyenmai'] = NULL;
                             $dataDH['vcMa'] = NULL;
                           
                             DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                           }
                        else
                           {
                             $dataDH = array();
                             $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                             $dataDH['hdTongtien'] = $dhOld->hdTongtien-$dongia->cthdGia;
                           
                             DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                           }
                    }
                    else if($vcMa->vcDkapdung == 1)
                    {
                        if($soluong < $vcMa->vcGtcandat)
                           {
                            $tonggiagoc = DB::table('chitietdonhang')->where('hdMa',$id)->sum('cthdGia');
                            $giaphantram = $tonggiagoc*($dhOld->hdGiamgia/100);
                           if($giaphantram > $dhOld->hdGiakhuyenmai)
                               {
                                 $dataDH = array();
                                 $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                                 $dataDH['hdTongtien'] = $dhOld->hdTongtien-$dongia->cthdGia+$dhOld->hdGiakhuyenmai;
                                 $dataDH['hdGiamgia'] = NULL;
                                 $dataDH['hdGiakhuyenmai'] = NULL;
                                 $dataDH['vcMa'] = NULL;
                               
                               DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                               }
                            else if($giaphantram < $dhOld->hdGiakhuyenmai)
                                {
                                     $dataDH = array();
                                     $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                                     $dataDH['hdTongtien'] = $dhOld->hdTongtien-$dongia->cthdGia+$giaphantram;
                                     $dataDH['hdGiamgia'] = NULL;
                                     $dataDH['hdGiakhuyenmai'] = NULL;
                                     $dataDH['vcMa'] = NULL;
                                   
                                   DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                                }
                           }
                        else
                           {
                             $dataDH = array();
                             $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                             $dataDH['hdTongtien'] = $dhOld->hdTongtien-$dongia->cthdGia;
                           
                             DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                           }
                    }
                }
                else if($vcMa->vcLoai==0)
                {
                    $ctdhGia = DB::table('chitietdonhang')->where('hdMa',$id)->where('serMa',$v)->first(); 
                    $countSlkm = DB::table('chitietdonhang')->where('hdMa',$id)->where('spMa',$masp->spMa)->count('cthdTrigiakm');
                    $tonggiagoc = DB::table('donhang')->select('hdTongtien')->where('hdMa',$id)->first();
                    if(strlen($ctdhGia->cthdTrigiakm)<=2)// nh??? h??n = 2 l?? %
                    {   
                      
                             if($countSlkm == 1)
                            {
                             $dataDH = array();
                             $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                             $dataDH['hdTongtien'] = $vocher->hdTongtien-($dongia->cthdGia-($dongia->cthdGia*($ctdhGia->cthdTrigiakm*0.01)));
                             $dataDH['hdGiamgia'] = NULL;
                             $dataDH['hdGiakhuyenmai'] = NULL;
                            DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                            }
                            else if($countSlkm > 1)
                            {
                            $dataDH = array();
                             $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                              $dataDH['hdTongtien'] = $vocher->hdTongtien-($dongia->cthdGia-($dongia->cthdGia*($ctdhGia->cthdTrigiakm*0.01)));
                             
                            DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                            }
                        
                        // else if($tonggiakm<$vocher->hdGiakhuyenmai)
                        // {
                        //      if($countSlkm == 1)
                        //     {
                        //      $dataDH = array();
                        //      $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                        //      $dataDH['hdTongtien'] =$vocher->hdTongtien-$dongia->cthdGia+$tonggiakm;
                        //      $dataDH['hdGiamgia'] = NULL;
                        //      $dataDH['hdGiakhuyenmai'] = NULL;
                        //     DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                        //     }
                        //     else if($countSlkm > 1)
                        //     {

                        //     $dataDH = array();
                        //      $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                        //      $dataDH['hdTongtien'] =$vocher->hdTongtien-$dongia->cthdGia;
                             
                        //     DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                        //     }
                        // }
                    }
                    else if(strlen($ctdhGia->cthdTrigiakm)>2)// L???n h??n 2 l?? ti???n m???t
                    {
                        //  $tonggiakm =  $tonggiagoc+$vocher->hdGiamgia;
                        
                        // if($tonggiakm>$vocher->hdGiakhuyenmai)
                        // {
                             if($countSlkm == 1)
                            {
                             $dataDH = array();
                             $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                             $dataDH['hdTongtien'] = $vocher->hdTongtien-($dongia->cthdGia-$ctdhGia->cthdTrigiakm);
                             $dataDH['hdGiamgia'] = NULL;
                             $dataDH['hdGiakhuyenmai'] = NULL;
                             DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                            }
                            else if($countSlkm > 1)
                            {
                            $dataDH = array();
                             $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                             $dataDH['hdTongtien'] = $vocher->hdTongtien-($dongia->cthdGia-$ctdhGia->cthdTrigiakm);
                             DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                            }
                        }
                        // else if($tonggiakm<$vocher->hdGiakhuyenmai)
                        // {
                        //      if($countSlkm == 1)
                        //     {
                        //      $dataDH = array();
                        //      $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                        //      $dataDH['hdTongtien'] =$vocher->hdTongtien-$dongia->cthdGia+$tonggiakm;
                        //      $dataDH['hdGiamgia'] = NULL;
                        //      $dataDH['hdGiakhuyenmai'] = NULL;
                        //     DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                        //     }
                        //     else if($countSlkm > 1)
                        //     {

                        //     $dataDH = array();
                        //      $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                        //      $dataDH['hdTongtien'] =$vocher->hdTongtien-$dongia->cthdGia;
                            
                        //  DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                        //     }
                        // }
                    //}
                }
            }
            else if($vocher->vcMa ==NULL)
            {
                 $dhOld = DB::table('donhang')->where('hdMa',$id)->first();
                 $ctdhGia = DB::table('chitietdonhang')->where('hdMa',$id)->where('serMa',$v)->first();
                 if($ctdhGia->cthdTrigiakm == 0)
                 {
                     $dataDH = array();
                     $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                     $dataDH['hdTongtien'] = $dhOld->hdTongtien-$dongia->cthdGia;
                   
                    DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                 }
                 else
                 {
                    $dataDH = array();
                     $dataDH['hdSoluongsp'] = $dhOld->hdSoluongsp - 1;
                     $dataDH['hdTongtien'] = $dhOld->hdTongtien-($dongia->cthdGia-($dongia->cthdGia*($ctdhGia->cthdTrigiakm/100)));
                     $dataDH['hdGiamgia'] = NULL;
                     $dataDH['hdGiakhuyenmai'] = NULL;
                    DB::table('donhang')->where('hdMa',$id)->update($dataDH);
                    
                 }
               
            }

            
            DB::table('chitietdonhang')->where('hdMa',$id)
                                ->where('spMa',$masp->spMa)
                                ->where('serMa',$v)
                                ->delete();

            return Redirect('xu-ly-tach-don/'.$id);

            /////??i???u ki???n t??ch ????n khi c?? vocher
            ///X??t vocher c???a ????n h??ng
            ///X??t ??i???u ki???n ??p d???ng 0(Theo gi??) - 1(Theo s??? l?????ng t???ng s???n ph???m trong ????n h??ng)
            ///
            
            }
        }
        }
      
    }

    //--H???y ????n --//
    public function huyToanDon($id)
    {

        $dh = DB::table('donhang')->where('hdMa',$id)->first();
        $ctdh = DB::table('chitietdonhang')->where('hdMa',$id)->get();

    
      foreach($ctdh as $k => $v)
      {
         $dataSer = array();
        $dataSer['serTinhtrang'] = 3;
        DB::table('serial')->where('spMa',$v->spMa)->where('serMa',$v->serMa)->update($dataSer);

        $masp = DB::table('serial')->where('serMa',$v->serMa)->first();
        $hongExist = DB::table('kho_sp_hong')->where('spMa',$masp->spMa)->first();
       if($hongExist != NULL)
       {
        $dataHong = array();
        $dataHong['khoSlsphong'] = $hongExist->khoSlsphong + 1;
        DB::table('kho_sp_hong')->where('spMa',$v->spMa)->update($dataHong);
       }
       else if($hongExist == null)
       {
         $dataHong = array();
         $dataHong['spMa'] = $v->spMa;
        $dataHong['khoSlsphong'] = 1;
        DB::table('kho_sp_hong')->insert($dataHong);
       }
     }
      $data = array();
      $data['hdTinhtrang'] = 10;
      DB::table('donhang')->where('hdMa',$id)->update($data);

       Session::flash('note_succ','H???y ????n th??nh c??ng!');
        return Redirect('don-hang'); 
    }
    
}
