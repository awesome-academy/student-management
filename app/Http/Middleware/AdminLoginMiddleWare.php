<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminLoginMiddleWare
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
        if (Auth::check()) {
            if (Auth::user()->role == config('social.role_admin')) {
                return $next($request);
            }
            
            return redirect(route('admins.return_login'));
        } else {
            $token = $request->cookie('remember_token');
            $user = User::where('remember_token', $token)->first();
            if (!empty($user)) {
                if ($user->role == config('social.role_admin')) {
                    if (Auth::login($user)) {
                        return $next($request);
                    } else {
                        return redirect(route('admins.return_login'));
                    }
                } else {
                    return redirect(route('admins.return_login'));
                }
            }
            
            return redirect(route('admins.return_login'));
        }
    }
}
