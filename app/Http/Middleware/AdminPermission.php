<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            $appAccess = auth::user()->app_access;
            $app_permission = explode(",", $appAccess);
            if(in_array("Admin", $app_permission)){
                return $next($request);
            }else{
                return redirect()->back()->with('flash_message_error','Du har ingen kommende vagter');
            }
        }
        else
        {
            return redirect('/login')->with('flash_message_error','Du er ikke logget ind!');
        }
    }
}
