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
    public function index($city_code) {
        $city = City::findByIATA($city_code)->first();
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
    public function show($city_code, $id) {
        $user = User::findBySlugOrId($id);
        $city = City::findByIATA($city_code)->first();

        $events = Event::futureEvents()->where('user_id', '=', $user->id)->where('city_id','=',$city->id)->get();
        return view('users.show', compact('user', 'events', 'event') + ['event' => null]);
    }

    public function create() {
    	return view('users.create');
    }

    public function registerEmail(Request $request) {
        $token = new Token();
        $token->save();
        $token->createNewToken();

		Mail::send('emails.registration.token', ['token' => $token, 'request' => $request], function ($m) use ($token, $request) {
            $m->from('messages@madebyfieldwork.com', 'See+Do')
                ->to($request->email,$request->name)
                ->subject('Here is your registration link to start contributing to See+Do')
                ->getHeaders()
                ->addTextHeader('X-MC-Subaccount', 'see-do');
        });

		Notification::success('Registration email sent to '. $request->name . ' at ' . $request->email);

        return redirect('/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::findBySlugOrId($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	   $user = User::findBySlugOrId($id);

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

        return Redirect::route('users.index')->with('message', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	   $user = User::findBySlugOrId($id);
       $user->delete();

       return redirect('/users');
    }
}