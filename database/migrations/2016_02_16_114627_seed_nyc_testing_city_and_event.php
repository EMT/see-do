<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\City;
use App\Event;
use App\User;

class SeedNycTestingCityAndEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $city = City::create([
            'name' => 'New York',
            'iata' => 'nyc',
        ]);

        $event = Event::create([
            'title'           => 'A very NYC style event.',
            'time_start'      => '2016-10-30-19-00-00',
            'time_end'        => '2016-10-30-22-30-00',
            'content'         => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
            'venue'           => '70 Oxford Street, M1 5NH',
            'user_id'         => User::orderByRaw("RAND()")->first()->id,
            'category_id'     => rand(1, 5),
            'color_scheme_id' => rand(1, 18),
            'city_id'         => $city->id,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $city = City::findByIATA('nyc')->first();
        $event = Event::where('city_id','=',$city->id);


        $city->delete();
        $event->delete();
    }
}
