<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\City;
use App\User;

class AssociateCurrentUsersWithMcr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Get all the user records.
        $city = City::where('iata','=','mcr')->first();
        $users = User::get();

        // Get all the current users and associate them with manchester (MCR).
        foreach($users as $user)
        {
            $user->city_id = $city->id;
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $users = User::get();

        // Get all the current users and associate them with manchester (MCR).
        foreach($users as $user)
        {
            $user->city_id = null;
            $user->save();
        }
    }
}
