<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        // 执行判断（判断用户是否登录）
        $user=session('admin');
        if(!$user){
            return redirect('/login');
        }
        return $next($request);
    }
}
