<?php

namespace App\Http\Controllers;


use App\City;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities.create');
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
        $city->iata = substr(strtolower($city->iata), 0, 3);
        $city->user_id = $request->user()->id;
        $city->save();

        return redirect('/')->with('message', 'City created');

    }
}
