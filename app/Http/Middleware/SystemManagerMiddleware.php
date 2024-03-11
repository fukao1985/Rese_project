<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SystemManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (Auth::check() && Auth::user()->role === 'system_manager') {
        //     return $next($request);
        // }
        if (Auth::user()->role === 'system_manager') {
            return $next($request);
        }

        $script = "<script>alert('アクセス権限がありません。');</script>";

        return redirect()->route('user.top')->with('script', $script);
        // return redirect()->route('user.top');
    }
}
