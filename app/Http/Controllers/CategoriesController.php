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
    public function index(City $city)
    {
        $categories = Category::where('city_id', $city->id)->orderBy('title', 'asc')->get();
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
    public function show(City $city, Category $category)
    {
        // overwrite the given category with one that has the same slug and the right cityID,
        // this wouldn't be a problem if we used unique slugs but its better to be consistent with
        // the category urls
        $category = Category::where([['city_id', '=', $city->id], ['slug', '=', $category->slug]])->first();
        $event = null;
        $events = $category->futureEvents($city)->get();
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
    public function edit(City $city, Category $category)
    {
        // overwrite the given category with one that has the same slug and the right cityID,
        // this wouldn't be a problem if we used unique slugs but its better to be consistent with
        // the category urls
        $category = Category::where([['city_id', '=', $city->id], ['slug', '=', $category->slug]])->first();

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category                 $category
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city, Category $category)
    {
        $this->validate($request, [
            'title'           => 'required|max:255'
        ]);
        // overwrite the given category with one that has the same slug and the right cityID,
        // this wouldn't be a problem if we used unique slugs but its better to be consistent with
        // the category urls
        $category = Category::where([['city_id', '=', $city->id], ['slug', '=', $category->slug]])->first();
        // Set slug to null to reset the slug on update.
        $category->slug = null;
        $category->fill(Input::all());
        $category->save();

        return Redirect::route('{city}.categories.index', $city->iata)->with('message', 'Category updated');
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
