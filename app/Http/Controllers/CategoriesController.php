<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\ColorScheme;
use Illuminate\Http\Request;
use Input;
use Redirect;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('role:admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('title', 'asc')->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create', ['category' => null]);
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
            'title'           => 'required|max:255',
        ]);

        $category = new Category(Input::all());
        $category->user_id = $request->user()->id;
        $category->save();

        return Redirect::route('categories.index')->with('message', 'Category created');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function show($city_code, $slug)
    {
        $event = null;
        $category = Category::findBySlug($slug);
        $city = City::findByIATA($city_code)->first();
        $events = $category->futureEvents($city_code)->get();
        $categories = Category::orderBy('title', 'asc')->get();

        return view('events.index', compact('city', 'events', 'event', 'category', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $colorSchemes = ColorScheme::selectRaw('id, CONCAT(color_1, "/", color_2, "/", color_3) AS colors')
            ->orderBy('created_at', 'desc')
            ->lists('colors', 'id');

        return redirect('/events');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category                 $category
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'title'           => 'required|max:255',
            'color_scheme_id' => 'required|numeric|min:1',
        ]);

        $category->fill(Input::all());
        $category->save();

        return Redirect::route('categories.index')->with('message', 'Category updated');
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
