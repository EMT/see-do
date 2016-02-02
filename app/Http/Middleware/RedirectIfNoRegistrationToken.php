<?php

namespace App\Http\Middleware;

use Closure;
use App\Token;

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
        $paramToken = Token::where('token','=',$routeParam)->firstOrFail();

        if ($paramToken) {
            return $next($request);
        } else {
            return redirect('/');
        }

    }
}