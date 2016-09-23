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
        $this->middleware('hidden-city');
        $this->middleware('locale');

        $this->user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(City $city)
    {
        $events = Event::futureEventsByCityId($city->id)->get();
        $categories = Category::orderBy('title', 'asc')->lists('title', 'id');

        return view('events.index', compact('city', 'events', 'event', 'categories') + ['event' => null]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(City $city)
    {
        $colorSchemes = ColorScheme::listRaw();
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
        $event->setOwnerCurrentUser();

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
    public function show(City $city, Event $event)
    {
        $events = Event::futureEventsByCityId($city->id)->get();
        return view('events.index', compact('city', 'events', 'event'));
    }

    /**
     * Return JSON for the specified resource.
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function showJson(City $city, Event $event)
    {
        $event->user = $event->user; // Eh? Doesn't work without this ?
        $event->colorScheme;
        $event->category;
        $event->parsedContent = $event->parseMarkdown('content');
        $event->shortDates = $event->shortDates();
        $event->longDates = $event->longDates();
        $event->times = $event->times();
        $event->url = action('EventsController@show', ['city_code' => $city->iata, 'slug' => $event->slug]);


        return response()->json($event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city, Event $event)
    {
        $colorSchemes = ColorScheme::listRaw();
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
    public function update(Request $request, City $city, Event $event)
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
        ]);

        $event->fill(Input::all());
        $event->save();

        event(new SocialBroadcastEvent($event, $request));

        return Redirect::route('{city}.events.index', $city->iata)->with('message', 'Event updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city, Event $event)
    {
        $event->delete();
        return Redirect::route('{city}.events.index', $city->iata)->with('message', 'Event Removed');
    }
}
