<?php

namespace App\Http\Controllers;


use App\City;
use Route;
use Auth;
use Illuminate\Http\Request;
use Input;
use Redirect;

class CitiesController extends Controller
{
    /**
     * The currently authorised user.
     */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @param Auth $user
     * @return void
     */
    public function __construct(Auth $user)
    {
        $this->user = Auth::user();

        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('hidden-city');
        $this->middleware('locale');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->user) {
            $cities = City::all();
        } else {
            $cities = City::where('hidden', '!=', 1)->get();
        }

        return view('home.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        // Don't let users see this page unless they are logged in and have the same city id.
        return view('cities.settings', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Event                    $event
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $iata)
    {

        // dont let the request go through unless the user matches the city id.
        // This ^ should be a middleware.
        $city = City::findByIATA($iata)->first();
        $this->validate($request, [
            'name' => 'required',
            'iata' => 'unique:cities,iata,'.$city->iata.',iata',
            'twitter_consumer_key' => 'required',
            'twitter_consumer_secret' => 'required',
            'twitter_access_token' => 'required',
            'twitter_access_token_secret' => 'required'
        ]);

        $city->fill(Input::all());
        $city->save();

        return redirect('/'.$city->iata)->with('message', 'City details updated');
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
            'twitter_consumer_key' => 'required',
            'twitter_consumer_secret' => 'required',
            'twitter_access_token' => 'required',
            'twitter_access_token_secret' => 'required'
        ]);


        $city = new City(Input::all());
        $city->iata = substr(strtolower($city->iata), 0, 3);
        $city->user_id = $request->user()->id;
        $city->hidden = 1;
        $city->save();

        return redirect('/')->with('message', $city->name.' successfully created!');

    }
}
