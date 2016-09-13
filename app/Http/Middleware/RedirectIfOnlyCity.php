<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use App\City;

class RedirectIfOnlyCity
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
        $route = $request->path();
        $cities = City::where('hidden', '!=', 1)->get();

        if (count($cities) < 2 && $route == '/' ) {
            return redirect('/mcr');
        } else {
            return $next($request);
        }

    }
}
