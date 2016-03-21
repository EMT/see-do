<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;


use App\City;
use App\Event;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    /**
     * The currently authorised user.
     */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @param  Auth  $user
     * @return void
     */
    public function __construct(Auth $user)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::get();

        return view('home.index', compact('cities'));
    }

	/**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'iata' => 'required',
        ]);

        $city = new City(Input::all());
        $city->user_id = $request->user()->id;
        $city->save();
    }
}
