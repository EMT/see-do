<?php

namespace App\Console\Commands;

use App\Category;
use App\City;
use App\Event;
use App\Mailer;
use App\Subscriber;
use Illuminate\Console\Command;
use Mail;

class SendMailer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailer:send {--email= : Send a test email to this email address only}';

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
        $cities = City::all();
        // Grab all the cities and then do a for each.
        // run this for each of them.
        foreach ($cities as $city) {
            $events = Event::where('city_id', '=', $city->id)
                            ->where('time_end', '>=', date('Y-m-d H:i:s'))
                            ->where('time_end', '<=', date('Y-m-d H:i:s', strtotime('+2 weeks')))
                            ->orderBy('time_start', 'asc')
                            ->get();

            if (!count($events)) {
                $this->comment('No events found for '.$city->name.'. Mailer not sent.');
                continue;
            }

            $categories = Category::orderBy('title', 'asc')->get();

            if ($this->option('email')) {
                $subscriber = new Subscriber();
                $subscriber->name = 'Test User';
                $subscriber->email = $this->option('email');
                $subscribers = [$subscriber];

                $this->comment('Sent test email to '.$this->option('email'));
            } else {
                $subscribers = Subscriber::where('city_id', '=', $city->id)->get();
            }

            $count = 0;

            foreach ($subscribers as $subscriber) {
                Mail::send('emails.subscribers.mailer', ['subscriber' => $subscriber, 'events' => $events, 'categories' => $categories, 'city' => $city], function ($m) use ($subscriber, $city) {
                    $m->from('messages@madebyfieldwork.com', 'See+Do')
                        ->to($subscriber->email, $subscriber->name)
                        ->subject('Weekly Round-Up of Things to See+Do in ' . $city->name)
                        ->getHeaders()
                        ->addTextHeader('X-MC-Subaccount', 'see-do');
                });

                $count++;
            }

            $this->comment('Sent to '.$count.' email addresses in '.$city->name.'.');
            $count = 0;
        }

    }
}
