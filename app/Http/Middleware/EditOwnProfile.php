<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class EditOwnProfile
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
        $routeParam = $route->getParameter('users');
        $paramUser = User::findBySlugOrId($routeParam);
        $sessionUser = Auth::user();

        if ($paramUser->id == $sessionUser->id) {
            return $next($request);
        } else {
            return redirect('users');
        }

    }
}
