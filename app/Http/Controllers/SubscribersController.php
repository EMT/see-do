<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;
use Input;
use Mail;
use Redirect;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth', ['only' => ['index']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subscribers.create');
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
        $subscriber = new Subscriber(Input::all());
        // $subscriber->save();
        Mail::send('emails.subscribers.hello', ['subscriber' => $subscriber], function ($m) use ($subscriber) {
            $m->from('messages@madebyfieldwork.com', 'See&Do')
                ->to($subscriber->email, $subscriber->name)
                ->subject('Thanks for subscribing to See&Do')
                ->getHeaders()
                ->addTextHeader('X-MC-Subaccount', 'see-do');
        });

        return Redirect::to('/subscribers/hello');
    }

    /**
     * Display the specified resource.
     *
     * @param Subscriber $subscriber
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subscriber $subscriber
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Subscriber               $subscriber
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subscriber $subscriber
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        //
    }
}
