<?php

namespace App\Http\Middleware;

use Closure;
use App\City;
use Notification;

class SetNotificationForHiddenCity
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

        if($city) {
            if ($city->hidden) {
                Notification::warningInstant('This city is currently hidden (it will not be visible unless you are logged in), when you have populated it with a few events you can request it be made public <a href="mailto:harry@madebyfieldwork.com?subject=Unhide%20'.$city->name.'">here</a>');
            }
        }

        return $next($request);
    }
}