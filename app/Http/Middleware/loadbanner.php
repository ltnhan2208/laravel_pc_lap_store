<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Route;
use App\Models\sanpham;
class loadbanner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName =Route::currentRouteName();
        $today=date_create(); //
        $promoted_product=sanpham::leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')
            ->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')
            ->where('sanpham.kmMa','!=',null)
            ->join('hinh','hinh.spMa','sanpham.spMa')
            ->where('hinh.thutu',1)->where('khuyenmai.kmNgaybd','<=',$today)
            ->where('khuyenmai.kmNgaykt','>=',$today)
            ->where('khuyenmai.kmTinhtrang',1)
            ->take(20)
            ->get();
            $ordered_product=sanpham::join('kho','kho.spMa','sanpham.spMa')
            ->join('hinh','hinh.spMa','sanpham.spMa')
            ->where('hinh.thutu',1)
            ->orderBy('khoSoluongdaban','desc')
            ->take(20)
            ->get();
        if($routeName=="homepage")
        {
            // Home page
                $vtHead = DB::table('slide')->where('bnVitri',1)->where('bnTrang',1)->where('bnTrangthai','0')->limit(1)->get();
            $vtHeadCheck =DB::table('slide')->where('bnVitri',1)->where('bnTrang',1)->where('bnTrangthai','0')->count();
             $vtLogo = DB::table('slide')->where('bnVitri',2)->where('bnTrang',1)->where('bnTrangthai','0')->limit(1)->get();
            $vtLogoCheck =DB::table('slide')->where('bnVitri',2)->where('bnTrang',1)->where('bnTrangthai','0')->count();
            $vt1 = DB::table('slide')->where('bnVitri',1)->where('bnTrang',1)->where('bnTrangthai','0')->limit(1)->get();
            $vt1Check =DB::table('slide')->where('bnVitri',1)->where('bnTrang',1)->where('bnTrangthai','0')->count();
            $vt2 = DB::table('slide')->where('bnVitri',2)->where('bnTrang',1)->where('bnTrangthai','0')->limit(1)->get();
            $vt2Check =DB::table('slide')->where('bnVitri',2)->where('bnTrang',1)->where('bnTrangthai','0')->count();
            $vt3 = DB::table('slide')->where('bnVitri',3)->where('bnTrang',1)->where('bnTrangthai','0')->limit(1)->get();
            $vt3Check =DB::table('slide')->where('bnVitri',3)->where('bnTrang',1)->where('bnTrangthai','0')->count();
            $vt4 = DB::table('slide')->where('bnVitri',4)->where('bnTrang',1)->where('bnTrangthai','0')->orderBy('bnNgay','desc')->limit(1)->get();
            $vt4Check =DB::table('slide')->where('bnVitri',4)->where('bnTrang',1)->where('bnTrangthai','0')->count();
            $vt5 = DB::table('slide')->where('bnVitri',5)->where('bnTrang',1)->where('bnTrangthai','0')->limit(1)->get();
            $vt5Check =DB::table('slide')->where('bnVitri',5)->where('bnTrang',1)->where('bnTrangthai','0')->count();
            $vt6 = DB::table('slide')->where('bnVitri',6)->where('bnTrang',1)->where('bnTrangthai','0')->limit(1)->get();
            $vt6Check =DB::table('slide')->where('bnVitri',6)->where('bnTrang',1)->where('bnTrangthai','0')->count();
            $vt7 = DB::table('slide')->where('bnVitri',7)->where('bnTrang',1)->where('bnTrangthai','0')->limit(1)->get();
            $vt7Check =DB::table('slide')->where('bnVitri',7)->where('bnTrang',1)->where('bnTrangthai','0')->count();
            $vt8 = DB::table('slide')->where('bnVitri',8)->where('bnTrang',1)->where('bnTrangthai','0')->limit(1)->get();
            $vt8Check =DB::table('slide')->where('bnVitri',8)->where('bnTrang',1)->where('bnTrangthai','0')->count();
        } 
        else
        {
             $vtHead = DB::table('slide')->where('bnVitri',1)->where('bnTrang',1)->where('bnTrangthai','0')->limit(1)->get();
            $vtHeadCheck =DB::table('slide')->where('bnVitri',1)->where('bnTrang',1)->where('bnTrangthai','0')->count();
              $vtLogo = DB::table('slide')->where('bnVitri',2)->where('bnTrang',1)->where('bnTrangthai','0')->limit(1)->get();
            $vtLogoCheck =DB::table('slide')->where('bnVitri',2)->where('bnTrang',1)->where('bnTrangthai','0')->count();
            //Product Page
            $vt1 = DB::table('slide')->where('bnVitri',1)->where('bnTrang',2)->where('bnTrangthai','0')->limit(1)->get();
            $vt1Check =DB::table('slide')->where('bnVitri',1)->where('bnTrang',2)->where('bnTrangthai','0')->count();
            $vt2 = DB::table('slide')->where('bnVitri',2)->where('bnTrang',2)->where('bnTrangthai','0')->orderBy('bnNgay','desc')->get();
            $vt2Check =DB::table('slide')->where('bnVitri',2)->where('bnTrang',2)->where('bnTrangthai','0')->count();
            $vt2Current = DB::table('slide')->where('bnVitri',2)->where('bnTrang',2)->where('bnTrangthai','0')->get();
            $vt3 = DB::table('slide')->where('bnVitri',3)->where('bnTrang',2)->where('bnTrangthai','0')->limit(1)->get();
            $vt3Check =DB::table('slide')->where('bnVitri',3)->where('bnTrang',2)->where('bnTrangthai','0')->count();

            $vt4 = DB::table('slide')->where('bnVitri',4)->where('bnTrang',2)->where('bnTrangthai','0')->limit(1)->get();
            $vt4Check =DB::table('slide')->where('bnVitri',4)->where('bnTrang',2)->where('bnTrangthai','0')->count();
            $vt5 = DB::table('slide')->where('bnVitri',5)->where('bnTrang',2)->where('bnTrangthai','0')->limit(1)->get();
            $vt5Check =DB::table('slide')->where('bnVitri',5)->where('bnTrang',2)->where('bnTrangthai','0')->count();
            $vt6 = DB::table('slide')->where('bnVitri',6)->where('bnTrang',2)->where('bnTrangthai','0')->limit(1)->get();
            $vt6Check =DB::table('slide')->where('bnVitri',6)->where('bnTrang',2)->where('bnTrangthai','0')->count();
            $vt7 = DB::table('slide')->where('bnVitri',7)->where('bnTrang',2)->where('bnTrangthai','0')->limit(1)->get();
            $vt7Check =DB::table('slide')->where('bnVitri',7)->where('bnTrang',2)->where('bnTrangthai','0')->count();
            $vt8 = DB::table('slide')->where('bnVitri',8)->where('bnTrang',2)->where('bnTrangthai','0')->limit(1)->get();
            $vt8Check =DB::table('slide')->where('bnVitri',8)->where('bnTrang',2)->where('bnTrangthai','0')->count();
        }

        View()->share('prkm',$promoted_product);
        View()->share('pror',$ordered_product);

        View()->share('vtHead',$vtHead);
        View()->share('vtHeadCheck',$vtHeadCheck);
         View()->share('vtLogo',$vtLogo);
        View()->share('vtLogoCheck',$vtLogoCheck);

        View()->share('vt1',$vt1);
        View()->share('vt1Check',$vt1Check);
        View()->share('vt2',$vt2);
        View()->share('vt2Check',$vt2Check);
        View()->share('vt3',$vt3);
        View()->share('vt3Check',$vt3Check);
        View()->share('vt4',$vt4);
        View()->share('vt4Check',$vt4Check);
        View()->share('vt5',$vt5);
        View()->share('vt5Check',$vt5Check);
        View()->share('vt6',$vt6);
        View()->share('vt6Check',$vt6Check);
        View()->share('vt7',$vt7);
        View()->share('vt7Check',$vt7Check);
        View()->share('vt8',$vt8);
        View()->share('vt8Check',$vt8Check);

        return $next($request);
    }
}
