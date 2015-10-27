<?php

namespace App\Http\Controllers;

use App\ColorScheme;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Redirect;

class ColorSchemesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colorSchemes = ColorScheme::orderBy('created_at', 'desc')->get();
        return view('color-schemes.index', compact('colorSchemes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('color-schemes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $colorScheme = new ColorScheme(Input::all());
        $colorScheme->user_id = $request->user()->id;
        $colorScheme->save();
        return Redirect::route('color-schemes.index')->with('message', 'Colour scheme created');
    }

    /**
     * Display the specified resource.
     *
     * @param  ColorScheme $colorScheme
     * @return \Illuminate\Http\Response
     */
    public function show(ColorScheme $colorScheme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ColorScheme $colorScheme
     * @return \Illuminate\Http\Response
     */
    public function edit(ColorScheme $colorScheme)
    {
        return view('color-schemes.edit', compact('colorScheme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ColorScheme $colorScheme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ColorScheme $colorScheme)
    {
        $colorScheme->fill(Input::all());
        $colorScheme->save();
        return Redirect::route('color-schemes.index')->with('message', 'Colour scheme updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
