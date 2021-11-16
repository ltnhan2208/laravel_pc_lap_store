<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class checkAuthentication
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
        if(Auth::guard('khachhang')->check()==false)
        {
            Session::flash('loginmessage','Vui lòng đăng nhập trước khi sử dụng chức năng này !');
            return Redirect()->route('loginpage');
        }
        else
        {   
            return $next($request);    
        }
        
    }
}
