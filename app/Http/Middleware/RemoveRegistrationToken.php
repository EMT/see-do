<?php

namespace App\Http\Middleware;

use Closure;
use App\Token;
use Notification;

class RemoveRegistrationToken
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
        $route = app()->router->getCurrentRoute();
        $registrationToken = $request->get('registration_token');
        $storedToken = Token::where('token','=',$registrationToken)->first();

        if ($storedToken) {
        	$storedToken->delete();
            Notification::success('Registration successful, welcome to See+Do');
            return $next($request);
        } else {
            Notification::error('Registration failed');
            return redirect('/');
        }

    }
}