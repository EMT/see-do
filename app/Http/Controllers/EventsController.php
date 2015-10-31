<?php

namespace App\Http\Controllers;

use App\Category;
use App\ColorScheme;
use App\Event;
use Illuminate\Http\Request;
use Input;
use Redirect;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'showJson']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('time_end', '>=', date('Y-m-d H:i:s'))->orderBy('time_start', 'asc')->get();
        $categories = Category::orderBy('title', 'asc')->lists('title', 'id');

        return view('events.index', compact('events', 'event', 'categories') + ['event' => null]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colorSchemes = ColorScheme::selectRaw('id, CONCAT(color_1, "/", color_2, "/", color_3) AS colors')
            ->orderBy('created_at', 'desc')
            ->lists('colors', 'id');
        $categories = Category::orderBy('title', 'asc')->lists('title', 'id');

        return view('events.create', compact('categories', 'colorSchemes') + ['event' => null]);
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
        $event = new Event(Input::all());
        $event->user_id = $request->user()->id;

        if (!$event->color_scheme_id && $event->category_id) {
            $event->color_scheme_id = $event->category->color_scheme_id;
        }

        $event->save();

        return Redirect::route('events.index')->with('message', 'Event created');
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $events = Event::all();

        return view('events.index', compact('events', 'event'));
    }

    /**
     * Return JSON for the specified resource.
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function showJson($slug)
    {
        $event = Event::findBySlug($slug);
        $event->colorScheme;
        $event->category;
        $event->url = action('EventsController@show', ['slug' => $event->slug]);

        return response()->json($event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $colorSchemes = ColorScheme::selectRaw('id, CONCAT(color_1, "/", color_2, "/", color_3) AS colors')
            ->orderBy('created_at', 'desc')
            ->lists('colors', 'id');
        $categories = Category::orderBy('title', 'asc')->lists('title', 'id');

        return view('events.edit', compact('event', 'categories', 'colorSchemes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Event                    $event
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $event->fill(Input::all());
        $event->save();

        return Redirect::route('events.index')->with('message', 'Event updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
