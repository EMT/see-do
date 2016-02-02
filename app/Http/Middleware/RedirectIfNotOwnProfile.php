<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class RedirectIfNotOwnProfile
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

        // Restrict the logged in user to only editing their information unless they are an admin.
        if ($paramUser->id == $sessionUser->id || $sessionUser->is('admin')) {
            return $next($request);
        } else {
            return redirect('users');
        }

    }
}
