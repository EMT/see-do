<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\ColorScheme;
use App\Event;
use App\Events\SocialBroadcastEvent;
use App\Icon;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Input;
use Redirect;

class EventsController extends Controller
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
        $this->middleware('auth', ['except' => ['index', 'show', 'showJson']]);
        $this->user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($city_code)
    {
        $city = City::findByIATA($city_code)->first();
        $events = Event::futureEventsByCityId($city->id)->get();
        $categories = Category::orderBy('title', 'asc')->lists('title', 'id');

        return view('events.index', compact('city', 'events', 'event', 'categories') + ['event' => null]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($city_code)
    {
        $colorSchemes = ColorScheme::selectRaw('id, CONCAT(color_1, "/", color_2, "/", color_3) AS colors')
            ->orderBy('created_at', 'desc')
            ->lists('colors', 'id');
        $icons = Icon::orderBy('created_at', 'desc')->get();
        $categories = Category::orderBy('title', 'asc')->lists('title', 'id');

        return view('events.create', compact('categories', 'colorSchemes', 'icons') + ['event' => null]);
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
        $request->merge(['icons' => implode(',', $request->icons)]);

        $this->validate($request, [
            'title'           => 'required|max:255',
            'content'         => 'required',
            'time_start'      => 'required|date',
            'time_end'        => 'required|date',
            'venue'           => 'required',
            'color_scheme_id' => 'required|numeric|min:1',
            'category_id'     => 'required|numeric|min:1',
            'icons'           => 'required',
        ]);

        $event = new Event(Input::except(['tweet, city_id']));
        $event->user_id = Auth::user()->id;

        $city_code = Input::get('city_code');
        $event->city_id = City::getIdfromIATA($city_code);

        $event->save();

        event(new SocialBroadcastEvent($event, $request));

        return redirect('/'.$city_code)->with('message', 'Event created');
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     *
     * @return \Illuminate\Http\Response
     */
    public function show($city_code, $slug)
    {
        $city = City::findByIATA($city_code)->first();

        $events = Event::futureEventsByCityId($city->id)->get();
        $event = Event::findBySlug($slug);

        $event_owner = User::find($event->user_id);
        $event->user = $event_owner;

        return view('events.index', compact('city', 'events', 'event'));
    }

    /**
     * Return JSON for the specified resource.
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function showJson($city_code, $slug)
    {
        $event = Event::findBySlug($slug);
        $event_owner = User::find($event->user_id);
        $event->user = $event_owner;
        $event->colorScheme;
        $event->category;
        $event->parsedContent = $event->parseMarkdown('content');
        $event->shortDates = $event->shortDates();
        $event->longDates = $event->longDates();
        $event->times = $event->times();
        $event->url = action('EventsController@show', ['city_code' => $city_code, 'slug' => $event->slug]);


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
        $icons = Icon::orderBy('created_at', 'desc')->get();
        $categories = Category::orderBy('title', 'asc')->lists('title', 'id');

        return view('events.edit', compact('event', 'categories', 'colorSchemes', 'icons'));
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
        if (!$request->color_scheme_id && $request->category_id) {
            $category = Category::find($request->category_id);

            if ($category && $category->color_scheme_id) {
                $request->merge(['color_scheme_id' => $category->color_scheme_id]);
            }
        }

        $request->merge(['icons' => implode(',', $request->icons)]);

        $this->validate($request, [
            'title'           => 'required|max:255',
            'content'         => 'required',
            'time_start'      => 'required|date',
            'time_end'        => 'required|date',
            'venue'           => 'required',
            'color_scheme_id' => 'required|numeric|min:1',
            'category_id'     => 'required|numeric|min:1',
        ]);

        $event->fill(Input::all());
        $event->save();

        event(new SocialBroadcastEvent($event, $request));

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
        $event->delete();
        return redirect('events');
    }
}
