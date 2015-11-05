<?php

namespace App\Http\Controllers;

use App\Icon;
use Illuminate\Http\Request;
use Input;
use Redirect;

class IconsController extends Controller
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
        $icons = Icon::orderBy('created_at', 'desc')->get();

        return view('icons.index', compact('icons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('icons.create');
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
            'title'  => 'required|unique:icons,title',
            'svg'    => 'required',
        ]);

        $icon = new Icon(Input::all());
        $icon->user_id = $request->user()->id;
        $icon->save();

        return Redirect::route('icons.index')->with('message', 'Icon created');
    }

    /**
     * Display the specified resource.
     *
     * @param Icon $icon
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Icon $icon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Icon $icon
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Icon $icon)
    {
        return view('icons.edit', compact('icon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Icon                     $icon
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Icon $icon)
    {
        $this->validate($request, [
            'title'  => 'required|unique:icons,title,'.$icon->title,
            'svg'    => 'required',
        ]);

        $icon->fill(Input::all());
        $icon->save();

        return Redirect::route('icons.index')->with('message', 'Icon updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
