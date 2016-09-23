<?php

use App\Category;
use App\City;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCityIdToCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('city_id');
        });

        $cities = City::all();

        foreach ($cities as $city) {
            Category::create(['title' => 'Talks', 'city_id' => $city->id]);
            Category::create(['title' => 'Gigs', 'city_id' => $city->id]);
            Category::create(['title' => 'Exhibitions', 'city_id' => $city->id]);
            Category::create(['title' => 'Hackdays & Workshops', 'city_id' => $city->id]);
            Category::create(['title' => 'Films', 'city_id' => $city->id]);
            Category::create(['title' => 'Food & Drink', 'city_id' => $city->id]);
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('city_id');
        });
    }
}
