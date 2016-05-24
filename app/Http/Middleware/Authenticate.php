<?php

namespace App\Http\Middleware;

use Closure;
use App\City;
use Notification;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param Guard $auth
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If the user isn't logged in or they are part of a different city
        // deny access, otherwise go for it. Might be worth adding a message to
        // explain what happened on redirect.
        $city = City::findByIATA($request->route()->getParameter('city'))->first();


        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                Notification::error('You need to be logged in to view that.');

                return redirect()->guest('auth/login');
            }
        } else if ($city && $this->auth->user()->city_id !== $city->id) {

            Notification::error('You don\'t have permissions for that city.');

            if ($request->ajax()){
                return response('Unauthorized.', 401);
            } else {
                return redirect('/'.$city->iata);
            }
        }

        return $next($request);
    }
}
