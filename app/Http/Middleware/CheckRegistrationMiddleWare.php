<?php

namespace App\Http\Middleware;

use Closure;
use App\RegistrationInformation;

class CheckRegistrationMiddleWare
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
        $registration = RegistrationInformation::findOrFail($request['id']);
        $result = checkDateRegistration($registration);
        if ($result == config('social.out-of-time')) {

            abort(404);
        }

        return $next($request);
    }
}
