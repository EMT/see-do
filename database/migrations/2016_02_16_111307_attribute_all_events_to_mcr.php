<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\City;
use App\Event;

class AttributeAllEventsToMcr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Get all the event records.
        $city = City::where('iata','=','mcr')->first();
        $events = Event::get();

        // Get all the current events and attribute them to manchester (MCR).
        foreach($events as $event)
        {
            $event->city_id = $city->id;
            $event->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $events = Event::get();

        // Get all the current events and attribute them to manchester (MCR).
        foreach($events as $event)
        {
            $event->city_id = null;
            $event->save();
        }
    }
}
