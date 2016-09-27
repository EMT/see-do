<?php

namespace App\Http\Middleware;

use Closure;
use App;

class SetLocaleForCity
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
        $city = $route->getParameter('city');

        if ($city) {
            App::setLocale($city->lang);
        } else {
            App::setLocale('en');
        }

        return $next($request);
    }
}
