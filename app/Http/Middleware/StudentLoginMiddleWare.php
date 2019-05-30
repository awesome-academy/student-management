<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\User;

class StudentLoginMiddleWare
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
                return $next($request);
        } else {
            $token = $request->cookie('remember_token');
            $user = User::where('remember_token', $token)->first();
            if (!empty($user)) {
                if (Auth::login($user)) {
                    return $next($request);
                } else {
                    return redirect(route('students.return_login'));
                }
            }
            
            return redirect(route('students.return_login'));
        }
    }
}
