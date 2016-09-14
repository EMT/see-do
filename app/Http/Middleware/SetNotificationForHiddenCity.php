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
        $response = $next($request);
        $city = $request->route()->getParameter('city');
        if($city) {
            if ($city->hidden) {
                Notification::warning('This city is currently hidden (it will not be visible unless you are logged in), when you have populated it with a few events you can request it be made public <a href="mailto:harry@madebyfieldwork.com&subject=Unhide '.$city->name.'">here</a>');
            }
        }
        return $response;
    }
}