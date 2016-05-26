<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Token;
use App\Event;
use App\City;

use Bican\Roles\Models\Role;
use Notification;


use Input;
use Redirect;
use Mail;


class UsersController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('owner', ['only' => ['edit', 'destroy']]);
        $this->middleware('role:admin', ['only' => ['create']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(City $city) {
        $users = User::orderBy('name_first', 'asc')->where('city_id', '=', $city->id)->get();

        foreach($users as $user) {
            $user->user_events_count = Event::futureEvents()->where('user_id', '=', $user->id)->count();
        }

        $users->sortBy('user_events_count');

        return view('users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(City $city, User $user) {

        $events = Event::futureEventsByCityId($city->id)->where('user_id', '=', $user->id)->get();
        return view('users.show', compact('city', 'user', 'events', 'event') + ['event' => null]);
    }

    public function create(City $city) {
    	return view('users.create', compact('city'));
    }

    public function registerEmail(Request $request, City $city) {
        $token = new Token();
        $token->save();
        $token->createNewToken($city);

		Mail::send('emails.registration.token', ['token' => $token, 'request' => $request, 'city' => $city], function ($m) use ($token, $request, $city) {
            $m->from('messages@madebyfieldwork.com', 'See+Do')
                ->to($request->email,$request->name)
                ->subject('Here is your registration link to start contributing to See+Do in '.$city->name.'.')
                ->getHeaders()
                ->addTextHeader('X-MC-Subaccount', 'see-do');
        });

		Notification::success('Registration email sent to '. $request->name . ' at ' . $request->email);

        return redirect('/'.$city->iata.'/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($city_code, User $user) {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city, User $user)
    {
       $this->validate($request, [
            'name_first' => 'required',
            'name_last' => 'required',
            'username' => 'required',
            'bio' => 'required',
            'email' => 'required|unique:users,id,'.$request->get('id')
        ]);

        $user->fill(Input::all());
        $user->resluggify();
        $user->save();

        return Redirect::route('{city}.users.index', $city->iata)->with('message', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, City $city, User $user)
    {
       // If we decide to remove events associated with a user on deletion.
       // $user_events = Event::where('user_id','=',$user->id)->delete();
       $user->delete();
       return Redirect::route('{city}.users.index', $city->iata)->with('message', 'User removed');
    }
}