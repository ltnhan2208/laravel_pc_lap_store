<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Session;
session_start();

//Models

use App\Models\sanpham;
use App\Models\khachhang;
use App\Models\donhang;
use App\Models\chitietdonhang;
use App\Models\kho;
use App\Models\khuyenmai;
use App\Models\wishlist;
use App\Models\voucher;
use App\Models\payment;
use App\Models\tknganhang;



class cartController extends Controller
{
    public function savecart(Request $re, $id)
    {
        
        $productInfo=sanpham::join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spMa','=',$re->id)->join('kho','kho.spMa','sanpham.spMa')->first();
        $count = array();
        foreach(Cart::content() as $item)
        {
            if($item->id == $id && $item->qty >= $productInfo->khoSoluong)
            {
                return response()->json(['message'=>2]);
            }
        }
        if($productInfo->khoSoluong ==0 )
        {   
            return response()->json(['message'=>1]);
        }
        elseif(in_array($productInfo->spMa,$count)==null)
        {
            array_push($count,$productInfo->spMa);
            
            Cart::add( $productInfo->spMa , $productInfo->spTen , 1 ,$productInfo->spGia ,0, [ 'spHinh' => $productInfo->spHinh] );
        }
        return response()->json(['message'=>0]);
    }

    public function savecart2(Request $re)
    {
        $productInfo=sanpham::join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spMa','=',$re->id)->first();
        foreach(Cart::content() as $item)
        {
            if($item->id == $re->id && $item->qty >= $productInfo->khoSoluong)
            {
                Session::flash('err','Số lượng sản phẩm này trong giỏ hàng đã đạt giới hạn!');
         return Redirect()->back();
            }
        }
        
                
        Cart::add($productInfo->spMa,$productInfo->spTen,$re->quanty,$productInfo->spGia,0,[ 'spHinh' => $productInfo->spHinh] );

        Session::flash('comment','Đã thêm sản phẩm vào giỏ hàng !');
         return Redirect()->back();
    }

    public function destroy()
    {
        Cart::destroy();
        Session::forget('vcMa');
        return redirect()->back();
    }

    public function removeitem(Request $re)
    {
        $id=Cart::get($re->id);
        
        $checkvoucher= DB::table('voucher')->where('vcMa',Session::get('vcMa'))->where('spMa',$id->id)->first();
        if($checkvoucher)
        {
            Session::forget('vcMa');
        }
        Cart::remove($re->id);
        return redirect()->back();
    }

    public function changeQuantyIncrease(Request $re)
    {
        $check=Cart::get($re->id);
        $checkQty=kho::where('spMa',$check->id)->first();
        if($checkQty->khoSoluong>$check->qty)
        {
            $d=$check->qty;
            $d++;
            $checkExistVoucher=voucher::find(Session::get('vcMa'));
            if($checkExistVoucher)
            {
                if($checkExistVoucher->vcLoai == 0)
                {
                    Session::forget('vcMa');
                }
            }
            Cart::update($re->id,$d);
        }
        else
        {
            Session::flash('err','Số lượng sản phẩm: '.$check->name.' còn: '.$checkQty->khoSoluong);
            return response()->json(['message'=>1,'name'=>$check->name,'quanty'=>$checkQty->khoSoluong]);
        }
       
        //return Redirect::to('checkout');
        return response()->json(['message'=>0]);
    }

    public function changeQuantyDecrease(Request $re)
    {
        $check=Cart::get($re->id);
        $checkExistVoucher=voucher::find(Session::get('vcMa'));
        $cart=Cart::content();
        if($check->qty==1)
        {
            if($checkExistVoucher && $check->id == $checkExistVoucher->spMa)
            {
                Session::forget('vcMa');
            }
            if(Cart::get($re->id))
            {
                Cart::remove($re->id);
            }
            return Redirect::to('checkout');
        }
        $d=$check->qty;
        $d--;
        Cart::update($re->id,$d);
        $total=0;
        $a=array();
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
            array_push($a,$i->id);
        }   
        if($checkExistVoucher)
        {
            if($checkExistVoucher->vcLoai == 1  && $checkExistVoucher->vcDkapdung == 1)
            {
                if(Cart::count() <  $checkExistVoucher->vcGtcandat)
                {
                    Session::forget('vcMa');
                    Session::flash('err','Đã bỏ áp dụng voucher vì không đủ số lượng !');
                    return response()->json(['message'=>1]);

                }
            }
            if($checkExistVoucher->vcLoai == 1  && $checkExistVoucher->vcDkapdung == 0)
            {
                    //dd($checkExistVoucher->vcGtcandat,Session::get('total'));
                if( $total < $checkExistVoucher->vcGtcandat )
                {   
                    Session::forget('vcMa');
                    return response()->json(['message'=>2,'vcGtcandat'=>number_format($checkExistVoucher->vcGtcandat)]);

                }
            }
        }

        // return Redirect::to('checkout');
        return response()->json(['message'=>0]);
    }

    public function gocheckout(Request $re,$money)
    {
        $countvc=0;
        if(Cart::count()>0)
        {
            foreach (Cart::content() as $v) 
            {
                $checkQty=kho::where('spMa',$v->id)->first();
                if($v->qty>$checkQty->khoSoluong)
                {
                    session::flash('err','Sản phẩm '.$v->name.' còn: '.$checkQty->khoSoluong.', vui lòng liên hệ Hotline để biết thêm thông tin!');
                    return Redirect::to('checkout');    
                }
            }
            if(Auth::guard('khachhang')->check())
            {
                $customerInfo=khachhang::where('khMa',Auth::guard('khachhang')->user()->khMa)->first();
                if($customerInfo->khXtemail==1)
                {
                    //create order
                    $dh= new donhang();
                    $dh->khMa=$customerInfo->khMa;
                    $dh->hdSoluongsp=Cart::count();
                    $dh->hdTongtien=$money;
                    $dh->hdNgaytao=date_create();
                    
                    $dh->adMa=0;
                    if($re->kmMa!=null)
                    {
                        $dh->kmMa=$re->kmMa;
                    }
                    else
                    {
                        $dh->kmMa==null; 
                    }
                    
                    if($re->discount!=null && $re->price!=null)
                    {
                        $dh->hdGiamgia=$re->discount;
                        $dh->hdGiakhuyenmai=$re->price;
                    }
                    else
                    {
                        $dh->hdGiamgia=0;
                        $dh->hdGiakhuyenmai=0;
                    }
                    $date=getdate();

                    $name=$customerInfo->khTen;
                    $dh->hdMa=''.$date['seconds'].$date['minutes'].substr($dh->hdTongtien,0,1).$date['yday'].$date['mon'];
                    $hdMa=$dh->hdMa;
                    if($re->address !=null)
                    {
                        if(strlen($re->address)<15)
                        {
                            session::flash('errsdt','Địa chỉ không hợp lệ !');
                            return Redirect()->back()->withInput();
                        }
                        $dh->hdDiachi=$re->address;
                    }
                    else
                    {
                        $dh->hdDiachi=$customerInfo->khDiachi;
                    }
                    if($re->note==null)
                    {
                        $dh->hdGhichu=$re->note2;
                    }
                    else
                    {
                        $dh->hdGhichu=$re->note;
                    }
                    if($re->sdt==null)
                    {
                        if($customerInfo->khSdt<100000000|| $customerInfo->khSdt>10000000000)
                        {
                            session::flash('err','Số điện thoại trong thông tin cá nhân không hợp lệ !');
                            return redirect('infomation/'.Auth::guard('khachhang')->user()->khMa);
                        }
                        else
                        {
                            $dh->hdSdtnguoinhan=$customerInfo->khSdt;
                        }
                    }
                    elseif(strlen($re->sdt)>11||strlen($re->sdt)<10)
                    {
                        session::flash('errsdt','Số điện thoại không hợp lệ !');
                        return Redirect()->back()->withInput();
                    }
                    else
                    {
                        $dh->hdSdtnguoinhan=$re->sdt;
                    }

                    if(Session::has('vcMa'))
                    {
                        $vcInfo=DB::table('voucher')->where('vcMa',Session::get('vcMa'))->first();
                        //update quanty of  voucher
                        $sl['vcSoluot']=$vcInfo->vcSoluot-1;
                        DB::table('voucher')->where('vcMa',Session::get('vcMa'))->update($sl);
                        $dh->vcMa=$vcInfo->vcMa;
                    }

                    //check select payment method
                    // dd($re->payment);
                    if($re->payment ==1)
                    {
                        if($money > 50000000)
                        {
                            session::flash('errorder','Không thể dùng phương thức này vì đơn hàng của quý khách có giá trị cao hơn 50,000,000 VND vượt quá mức chuyển khoản cho phép của momo, vui lòng chọn phương thức khác.!');
                            return Redirect()->back()->withInput();
                        }
                        $momoaccInfo=payment::where('pmId',1)->first();
                        //dd($momoaccInfo->serectkey);
                        $endpoint = $momoaccInfo->endpoint;
                        $partnerCode =$momoaccInfo->partnerCode;
                        $accessKey =$momoaccInfo->accessKey;
                        $serectkey =$momoaccInfo->serectkey;
                        $orderInfo = "Thanh toán đơn hàng ". $hdMa ." - ".$momoaccInfo->extraData;
                        $amount = "1000";
                        $orderId ="".$hdMa."";
                        $returnUrl = route('resultpayment');
                        $notifyurl = 'adminapi';
                        // Lưu ý: link notifyUrl không phải là dạng localhost
                        $extraData = "merchantName=".$momoaccInfo->extraData;
                        $requestId = "".$hdMa."";
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
                        try
                        {
                            $result= Http::post($endpoint, $data);
                            if($result['errorCode']!=0)
                            {
                                Session::flash('errorder','Đã có lỗi trong quá trình tạo đơn vui lòng chọn phương thức thanh toán khác !');
                                return Redirect()->back()->withInput();
                            }

                            $dh->hdTinhtrang=0;
                            $dh->save();
                            //create order details
                            foreach (Cart::content() as $k => $i)
                            {
                                for($j =0 ; $j < $i->qty; $j ++)
                                {
                                    
                                    //update Quanty of Kho table
                                    $productInfo=kho::where('spMa',$i->id)->first();
                                    $updateKho['khoSoluong']=$productInfo->khoSoluong-1;
                                    DB::table('kho')->where('spMa',$productInfo->spMa)->update($updateKho);
                                    $ct=new chitietdonhang();
                                    $ct->hdMa=$hdMa;
                                   
                                    $ct->spMa= $i->id;
                                    $ct->cthdGia=$i->price;  
                                    $proinfo=sanpham::where('spMa',$re->spMa)->first();
                                    if($productInfo->spMa==$re->spMa )
                                    {
                                        if($proinfo->spSlkmtoida > 0)
                                        {
                                            $proinfo->spSlkmtoida-=1;
                                            $proinfo->update();
                                            $ct->cthdTrigiakm=$re->discount; 
                                        }
                                        if($proinfo->spSlkmtoida == null)
                                        {
                                            $ct->cthdTrigiakm=$re->discount;
                                        }
                                    }
                                    $ct->save();
                                }
                            }
                            // clear cart
                            Cart::destroy();
                            Session::forget('vcMa');
                            
                            return Redirect::to($result['payUrl']);
                        }
                        catch (Exception $e) 
                        {
                            Session::flash('errsdt','Đã có sự cố tạo đơn hàng do mạng vui lòng thử lại sau ít phút!');
                            DB::where('hdMa',$hdMa)->delete();
                            Return redirect()->back()->withInput();
                        }
                         
                    }


                    // elseif($re->payment==2)
                    // {
                    //     //Vnpay
                    //     //INFO get from db
                    //     if($re->tennganhang == null )
                    //     {
                    //         Session::flash('errsdt','Vui lòng chọn ngân hàng thanh toán!');
                    //         Return redirect()->back()->withInput();
                    //     }
                    //     $namebussiness= payment::where('pmId',1)->first();
                    //     $infoVNP=payment::where('pmId',2)->first();
                    //     $user=khachhang::where('khMa',Auth::guard('khachhang')->user()->khMa)->first();
                    //     // dd($infoVNP);

                    //     $vnp_TmnCode = $infoVNP->partnerCode; //Website ID in VNPAY System
                    //     $vnp_HashSecret =$infoVNP->serectkey; //Secret key
                    //     $vnp_Url = $infoVNP->endpoint;
                    //     //link redirect
                        
                    //     $vnp_Returnurl = "http://localhost/vnpay_php/vnpay_return.php";
                    //     $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
                    //     $startTime = date("YmdHis");
                    //     $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

                    //     // create_paymentrequest
                    //     $vnp_TxnRef = $hdMa; //Mã đơn hàng. 

                    //     $vnp_OrderInfo = "Thanh toan don hang: ".$hdMa." - ".$namebussiness->extraData; // mo ta don hang
                    //     $vnp_OrderType = 130000;// ma danh muc hang hoa = 130000
                    //     $vnp_Amount = $money * 100; // tien * 100 
                    //     $vnp_Locale = "vn"; //ngon ngu
                    //     $vnp_BankCode = $re->tennganhang; //ma ngan hang
                    //     $vnp_IpAddr = $re->ip(); // ip remote ket noi $_SERVER['REMOTE_ADDR']
                    //     //Add Params of 2.0.1 Version
                    //     $vnp_ExpireDate = $expire; // $expire

                    //     //Billing
                    //     $vnp_Bill_Mobile = $user->khSdt; //so dien thoại khách
                    //     $vnp_Bill_Email = $user->khEmail; //  email khách

                    //     //xu ly thong tin khach hang
                    //     $fullName = trim("Nguyễn Chí Nghĩa"); 
                    //     if (isset($fullName) && trim($fullName) != '') {
                    //         $name = explode(' ', $fullName);
                    //         $vnp_Bill_FirstName = array_shift($name);
                    //         $vnp_Bill_LastName = array_pop($name);
                    //     }
                    //     // $vnp_Bill_LastName=$vnp_Bill_FirstName;
                    //     $vnp_Bill_Address=$user->khDiachi;  //x
                    //     $vnp_Bill_City="HCM"; //x
                    //     $vnp_Bill_Country="VN"; //x
                    //     $vnp_Bill_State="CA"; //x
                    //     // Invoice
                    //     $vnp_Inv_Phone=$infoVNP->accessKey;
                    //     $vnp_Inv_Email=$infoVNP->extraData;
                    //     $vnp_Inv_Customer=$user->khTen;
                    //     $vnp_Inv_Address=$user->khDiachi;
                    //     $vnp_Inv_Company=$namebussiness->extraData;
                    //     $vnp_Inv_Taxcode="0102182292";
                    //     $vnp_Inv_Type="I";
                    //     $inputData = array(
                    //         "vnp_Version" => "2.1.0",
                    //         "vnp_TmnCode" => $vnp_TmnCode,
                    //         "vnp_Amount" => $vnp_Amount,
                    //         "vnp_Command" => "pay",
                    //         "vnp_CreateDate" => date('YmdHis'),
                    //         "vnp_CurrCode" => "VND",
                    //         "vnp_IpAddr" => $vnp_IpAddr,
                    //         "vnp_Locale" => $vnp_Locale,
                    //         "vnp_OrderInfo" => $vnp_OrderInfo,
                    //         "vnp_OrderType" => $vnp_OrderType,
                    //         "vnp_ReturnUrl" => $vnp_Returnurl,
                    //         "vnp_TxnRef" => $vnp_TxnRef,
                    //         "vnp_ExpireDate"=>$vnp_ExpireDate,
                    //         "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
                    //         "vnp_Bill_Email"=>$vnp_Bill_Email,
                    //         "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
                    //         "vnp_Bill_LastName"=>$vnp_Bill_LastName,
                    //         "vnp_Bill_Address"=>$vnp_Bill_Address,
                    //         "vnp_Bill_City"=>$vnp_Bill_City,
                    //         "vnp_Bill_Country"=>$vnp_Bill_Country,
                    //         "vnp_Inv_Phone"=>$vnp_Inv_Phone,
                    //         "vnp_Inv_Email"=>$vnp_Inv_Email,
                    //         "vnp_Inv_Customer"=>$vnp_Inv_Customer,
                    //         "vnp_Inv_Address"=>$vnp_Inv_Address,
                    //         "vnp_Inv_Company"=>$vnp_Inv_Company,
                    //         "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
                    //         "vnp_Inv_Type"=>$vnp_Inv_Type
                    //     );

                    //     if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    //         $inputData['vnp_BankCode'] = $vnp_BankCode;
                    //     }
                    //     if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                    //         $inputData['vnp_Bill_State'] = $vnp_Bill_State;
                    //     }

                    //     // dd($inputData);
                    //     ksort($inputData);
                    //     $query = "";
                    //     $i = 0;
                    //     $hashdata = "";
                    //     foreach ($inputData as $key => $value) {
                    //         if ($i == 1) {
                    //             $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    //         } else {
                    //             $hashdata .= urlencode($key) . "=" . urlencode($value);
                    //             $i = 1;
                    //         }
                    //         $query .= urlencode($key) . "=" . urlencode($value) . '&';
                    //     }

                    //     $vnp_Url = $vnp_Url . "?" . $query;
                    //     if (isset($vnp_HashSecret)) {
                    //         $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                    //         $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                    //     }

                    //     $returnData = array('code' => '00'
                    //         , 'message' => 'success'
                    //         , 'data' => $vnp_Url);
                    //     return redirect::to($vnp_Url);
                    //     return json_encode($returnData);

                    // }
                    // 
                    // 
                    else
                    {   
                        $dh->hdTinhtrang=0;
                        $dh->save();
                        //create order details
                        foreach (Cart::content() as $k => $i)
                        {
                            for($j =0 ; $j < $i->qty; $j ++)
                            {
                                
                                //update Quanty of Kho table
                                $productInfo=kho::where('spMa',$i->id)->first();
                                $updateKho['khoSoluong']=$productInfo->khoSoluong-1;
                               // DB::table('kho')->where('spMa',$productInfo->spMa)->update($updateKho);
                                $ct=new chitietdonhang();
                                $ct->hdMa=$hdMa;
                               
                                $ct->spMa= $i->id;
                                $ct->cthdGia=$i->price;  
                                $proinfo=sanpham::where('spMa',$re->spMa)->first();
                                if($productInfo->spMa==$re->spMa )
                                {
                                    if($proinfo->spSlkmtoida > 0 )
                                    {
                                        $proinfo->spSlkmtoida-=1;
                                        //dd($proinfo);
                                        $proinfo->update();
                                        $ct->cthdTrigiakm=$re->discount; 
                                    }
                                    if($proinfo->spSlkmtoida == null)
                                    {
                                        if(Session::has('vcMa'))
                                        {
                                            if($countvc==0)
                                            {
                                                $ct->cthdTrigiakm=$re->discount; 
                                                $countvc++;
                                            }
                                        }
                                        else
                                        {
                                            $ct->cthdTrigiakm=$re->discount;
                                        }
                                    }
                                }
                                $ct->save();
                            }
                        }
                        // clear cart
                        // Cart::destroy();
                        //$this->sendmail($hdMa);
                        Session::forget('vcMa');
                    }
                }
                else
                {
                    session::flash('err','Vui lòng xác thực email trước khi thực hiện thanh toán!');
                    return Redirect::to('infomation/'.$customerInfo->khMa);
                }
            }
            else
            {
                session::flash('loginmessage','Vui lòng đăng nhập để thực hiện đặt hàng!');
                return Redirect::to('login');
            }
        }
        return Redirect::to('product');
    }

    public function resultpayment(Request $re)
    {
        $data['errorCode']=$re->errorCode;
        if($re->errorCode == 0)
        {
            $dh=donhang::where('hdMa',$re->orderId)->first();
            $dh->hdTinhtrang=3;
            $dh->update();
        }
        $data['orderId']=$re->orderId;
        $data['transId']=$re->transId;
        $data['amount']=$re->amount;
        $this->sendmail($re->orderId);
        $bankInfo=tknganhang::all();
        return view('Userpage.resultpayment',compact('data','bankInfo'));
    }


    public function sendmail($hdMa)
    {
        $details=chitietdonhang::where('hdMa',$hdMa)->join('sanpham','chitietdonhang.spMa','sanpham.spMa')->get();
       
        $order=donhang::Where('donhang.hdMa',$hdMa)->first();
        Mail::to(Auth::guard('khachhang')->user()->khEmail)->send(new \App\Mail\mail($details,$order));
        Session::flash('addCart','Đặt hàng thành công! Vui lòng kiểm tra trong mục đơn hàng và hộp thư email của bạn ! Cảm ơn bạn đã tin tưởng và mua hàng tại STUCPT!');
    }

}