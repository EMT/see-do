<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mailer;
use App\Event;
use App\Subscriber;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

class MailersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mailers = Mailer::orderBy('send_date', 'desc')->get();
        return view('mailers.index', compact('mailers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate()
    {
        $mailer = new Mailer();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display a dynamically generated mailer based on data available now.
     *
     * @return \Illuminate\Http\Response
     */
    public function now()
    {
        $events = Event::futureEvents()->get();
        $categories = Category::orderBy('title', 'asc')->get();

        $subscriber = new Subscriber();
        $subscriber->name = 'Andy Gott';
        $subscriber->email = 'andy@madebyfieldwork.com';

        Mail::send('emails.subscribers.mailer', ['subscriber' => $subscriber, 'events' => $events, 'categories' => $categories], function ($m) use ($subscriber) {
            $m->from('messages@madebyfieldwork.com', 'See+Do')
                ->to($subscriber->email, $subscriber->name)
                ->subject('Weekly Round-Up of Things to See+Do in Manchester')
                ->getHeaders()
                ->addTextHeader('X-MC-Subaccount', 'see-do');
        });

        return view('mailers.now', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
