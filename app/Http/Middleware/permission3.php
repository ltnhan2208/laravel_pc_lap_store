<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Session;

class permission3
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
        if(Auth::user()->adQuyen != 4)
            {
                 return $next($request);
            }
        if(Auth::user()->adQuyen == 4)
            {
                Session::flash("note_err","Bạn không có quyền hạn với chức năng này!");
                 return Redirect()->route('loginAdmin');
            }
    }
}
