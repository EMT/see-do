<?php

namespace App\Http\Middleware;

use Closure;
use App\Token;
use Notification;

class RedirectIfNoRegistrationToken
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
        $routeParam = $route->getParameter('token');
        $paramToken = Token::where('token','=',$routeParam)->first();

        if ($paramToken) {
            return $next($request);
        } else {
            Notification::error('Your registration token has expired, please contact hello@madebyfieldwork.com for a new one');
            return redirect('/');
        }

    }
}