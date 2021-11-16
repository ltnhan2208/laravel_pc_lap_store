<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Socialite;
use DB;
use Session;
use Mail;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
session_start();
//Models
use App\Models\khachhang;
use App\Models\password_log;
class loginController extends Controller
{
     public function userlogin(Request $re)
    {
        
    	$username=$re->username;
    	$password=md5($re->password);
    	$result=khachhang::where('khTaikhoan',$username)->orwhere('khSdt',$username)->orwhere('khEmail',$username)->first();
        $result2=null;
        if($result)
        {
            $result2=khachhang::where('khTaikhoan',$result->khTaikhoan)->where('khMatkhau',$password)->first();    
        }
    	if($result2)
    	{
            Auth::guard('khachhang')->login($result2);
            Session::flash('loginmess','Đăng nhập thành công !');
            Session::flash('name','Chào '.$result->khTen.' !!!');
    		return Redirect::to('product');
    	}
    	else
    	{
	    	session::flash("loginmessage","Sai tên đăng nhập hoặc mật khẩu!");
    		return redirect()->back()->withInput();
    	}
    }
    public function loginGoogle()
    {
        try
        {   
            Auth::guard('khachhang')->logout();
            return Socialite::driver('google')->redirect();
        }
        catch(Exception $e)
        {
            return Redirect::to('login');
        }
    }
    public function googleredirect()
    {
            $userInfo=Socialite::driver('google')->user();
            $checkEmail=khachhang::where('khEmail',$userInfo->email)->first();
            if($checkEmail!=null)
            {   
                Auth::guard('khachhang')->login($checkEmail);
                Session::flash('loginmess','Đăng nhập thành công !');
                Session::flash('name','Chào '.$checkEmail->khTen.' !!!');
                return Redirect()->route('productpage');
            }
            else
            {
                //if Account is not exist go to auto register
                if(Auth::guard('khachhang')->check() == false)
                {
                    $kh=new khachhang();
                    $kh->khTen=substr($userInfo->name,0,stripos($userInfo->name," "));
                    $kh->khMatkhau=md5("12345678");
                    $kh->khEmail=$userInfo->email;
                    if($kh->khEmail==null)
                    {
                        return Redirect()->route('loginpage');
                    }         
                    $kh->khNgaysinh=date_create();
                    $kh->khDiachi='';
                    $kh->khQuyen=0;
                    $kh->khGioitinh=0;
                    $kh->khSdt=substr($userInfo->id,12);
                    $kh->khTaikhoan=$userInfo->id;
                    $kh->khNgaythamgia=date_create();
                    $kh->khXtemail=1;
                    $date=getdate();
                    $kh->khMa=$date['seconds'].strlen( $kh->khTen).strlen($kh->khDiachi).strlen($kh->khTaikhoan).$date['yday'];
                    //login
                    Session::put('ok','Vui lòng điền thông tin của bạn để hoàn tất việc đăng ký !');
                    Auth::guard('khachhang')->login($kh);
                    $kh->save();
                }
                return view('Userpage.addInfomation');
            }
    }

    // public function loginFacebook()
    //     {
    //         try
    //         {
    //             return Socialite::driver('facebook')->redirect();
    //         }
    //         catch(Exception $e)
    //         {
    //             return Redirect::to('login');
    //         }
    //     }
    //     public function facebookredirect()
    //     {
    //             $userInfo=Socialite::driver('facebook')->user();
    //             //dd($userInfo);
    //            $checkEmail=khachhang::where('khEmail',$userInfo->email)->first();
    //        if($checkEmail!=null)
    //        {
    //             session::put("khMa",$checkEmail->khMa);
    //             session::put("khTen",$checkEmail->khTen);
    //             session::put('khTaikhoan',$checkEmail->khTaikhoan);
    //             session::put('khMa',$checkEmail->khMa);
    //             session::put('khEmail',$checkEmail->khEmail);
    //             session::put('khHinh',$checkEmail->khHinh);
    //             session::put('khDiachi',$checkEmail->khDiachi);
    //             session::put('khSdt',$checkEmail->khSdt);
    //             Session::flash('loginmess','Đăng nhập thành công !');
    //             Session::flash('name','Chào '.$checkEmail->khTen.' !!!');

    //             return Redirect::to('product');
    //        }
    //        else
    //        {
    //             //if Account is not exist go to auto register
    //             $kh=new khachhang();
    //             $kh->khTen=substr($userInfo->name,0,stripos($userInfo->name," "));
    //             $kh->khMatkhau=md5("123456789");
    //             $kh->khEmail=$userInfo->email;            
    //             $kh->khNgaysinh=date_create();
    //             $kh->khDiachi='';
    //             $kh->khQuyen=0;
    //             $kh->khGioitinh=0;
    //             $kh->khSdt="";
    //             $kh->khTaikhoan=$userInfo->id;
    //             $kh->khNgaythamgia=date_create();
    //             $kh->khXtemail=1;
    //             $date=getdate();
    //             //dd($data);
    //             $kh->khMa=strlen( $kh->khTen).strlen($kh->khDiachi).strlen($kh->khTaikhoan).$date['yday'];
                
                
    //             //login
    //             session::put("khMa",$kh->khMa);
    //             session::put("khTen",$kh->khTen);
    //             session::put('khTaikhoan',$kh->khTaikhoan);
    //             session::put('khEmail',$kh->khEmail);
    //             $kh->save();
    //             return Redirect::to('product');
          
    //            }
    //     }

    public function sendCodeGetAcc(Request $re)
    {
        $checkAccount=DB::table('khachhang')->where('khEmail',$re->email)->first();
          $date=getdate();
        if($checkAccount)
        {
            $details=strlen($checkAccount->khMa).$checkAccount->khMa.$date['seconds'].$date['minutes'].$date['hours'].$date['yday'];
            
            DB::table('khachhang')->where('khEmail',$re->email)->update(['khResetpassword'=> $details]);
           Mail::to($re->email)->send(new \App\Mail\mailToGetAcc($details));
           session::flash('mail','Một email đã được gửi vui lòng kiểm trang hòm thư của bạn !!');
           return redirect()->back();
        }
        elseif($re->email==null)
        {
            session::flash('err','Vui lòng nhập email của tài khoản cần khôi phục !');
            return Redirect()->back()->withInput();
        }
        else
        {
           session::flash('err','Email Chưa được đăng ký !');
           return Redirect()->back()->withInput();
        }
    }
    
    public function changepassword(Request $re)
    {
        //dd($re->id);
        if($re->id == null)
        {
            session::flash('loginmessage','Đường link không hợp lệ!!');
            return Redirect::to('login');
        }
        else
        {
            $checkExistAcc=DB::table('khachhang')->where('khResetpassword',$re->id)->first();
            if(!$checkExistAcc)
            {
                session::flash('loginmessage','Đường link không hợp lệ!!');
                return Redirect::to('login');
            }
            else
            {
                return view('Userpage.changePassword')->with('id',$checkExistAcc->khMa)->with('name',$checkExistAcc->khTen);
            }
        }
    }

    public function newpass(Request $re)
    {
        if($re->password ==null|| $re->repassword ==null)
        {
            session::flash('err','Vui lòng nhập đầy đủ mật khẩu và xác nhận mật khẩu!');
                return Redirect()->back();
        }
        elseif($re->password != $re->repassword)
        {
            session::flash('err','Mật khẩu xác nhận không trung khớp ! ');
            return Redirect()->back();
        }
        else
        {   
            $checkOldPass=DB::table('khachhang')->where('khMa',$re->id)->where('khMatkhau',md5($re->password))->select('khTen')->first();
            //dd($checkOldPass);
            if($checkOldPass!=null)
            {
                Session::flash('err',' Mật khẩu đã được dùng vui lòng chọn mật khẩu an toàn hơn!');
                return Redirect()->back();
            }
            if(strlen($re->password)<=8)
            {
                Session::flash('err',' Mật khẩu quá ngắn vui lòng chọn mật khẩu an toàn hơn!');
                return Redirect()->back();
            }
            khachhang::where('khMa',$re->id)->update(['khMatkhau'=>md5($re->password)]);

            session::flash('changepassword',' Vui lòng đăng nhập lại ! ');
            return Redirect::to('login');
        }
    }

    //create new account from socialaccount
    public function addInfomation(Request $re)
    {
        Session::forget('ok');
        $userInfo=khachhang::find(Auth::guard('khachhang')->user()->khMa);
        if($userInfo)
        {
            if($re->password != $re->repassword)
            {
                Session::flash('err','Mật khẩu xác thực chưa trùng khớp ');
                return redirect()->back()->withInput();
            }
            $userInfo->khMatkhau=md5($re->password);
            if(strlen($re->address)<10)
            {
                Session::flash('err','Địa chỉ không hợp lệ ');
                return redirect()->back()->withInput();
            }
            $userInfo->khDiachi=$re->address;
            if(strlen($re->sdt)<10 || strlen($re->sdt) >11)
            {
                Session::flash('err','Số điện thoại không hợp lệ ');
                return redirect()->back()->withInput();
            }
            $checkExistPhonenumber=khachhang::where('khSdt',$re->sdt)->first();
            if($checkExistPhonenumber!=null && $checkExistPhonenumber->khMa != Auth::guard('khachhang')->user()->khMa)
            {
                Session::flash('err','Số điện thoại này đã dùng cho tài khoản khác ');
                return redirect()->back()->withInput();
            }
            $userInfo->khSdt=$re->sdt;
            $userInfo->update();
            Session::flash('success','Đăng ký thành công ! ');
            return Redirect()->route('productpage');
        }
        else
        {
            Session::flash('Một sự cố đã xảy ra vui lòng đăng ký lại !');
            return Redirect()->route('loginpage');
        }
    }
}
