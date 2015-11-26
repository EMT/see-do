<?php

namespace App\Console\Commands;

use App\Mailer;
use App\Event;
use App\Subscriber;
use App\Category;
use Illuminate\Console\Command;
use Mail;

class SendMailer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailer:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send out an auto-generated mailer of upcoming events to all subscribers.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $events = Event::where('time_end', '>=', date('Y-m-d H:i:s'))
                        ->where('time_end', '<=', date('Y-m-d H:i:s', strtotime('+2 weeks')))
                        ->orderBy('time_start', 'asc')
                        ->get();
        $categories = Category::orderBy('title', 'asc')->get();

        // $subscriber = new Subscriber();
        // $subscriber->name = 'Andy Gott';
        // $subscriber->email = 'andy@madebyfieldwork.com';
        
        $subscribers = Subscriber::all();

        foreach ($subscribers as $subscriber) {
            Mail::send('emails.subscribers.mailer', ['subscriber' => $subscriber, 'events' => $events, 'categories' => $categories], function ($m) use ($subscriber) {
                $m->from('messages@madebyfieldwork.com', 'See+Do')
                    ->to($subscriber->email, $subscriber->name)
                    ->subject('Weekly Round-Up of Things to See+Do in Manchester')
                    ->getHeaders()
                    ->addTextHeader('X-MC-Subaccount', 'see-do');
            });
        }
    }
}
