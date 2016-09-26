<?php

use App\Category;
use App\City;
use App\Event;
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
        $categories = Category::all();

        foreach ($cities as $city) {
            Category::create(['title' => 'Talks', 'city_id' => $city->id]);
            Category::create(['title' => 'Gigs', 'city_id' => $city->id]);
            Category::create(['title' => 'Exhibitions', 'city_id' => $city->id]);
            Category::create(['title' => 'Hackdays & Workshops', 'city_id' => $city->id]);
            Category::create(['title' => 'Films', 'city_id' => $city->id]);
            Category::create(['title' => 'Food & Drink', 'city_id' => $city->id]);

            $city_events = Event::all();

            foreach ($city_events as $event) {
                if ($event->city_id == $city->id) {
                    // get the current category_id.
                    // get the category by that id.
                    $old_category = Category::where('id', $event->category_id)->first();
                    // get the name of the category.
                    // find the new category for this city with that name.
                    $new_category = Category::where('slug', $old_category->slug)->where('city_id', $city->id)->first();
                    // set the event to new category.
                    $event->category_id = $new_category->id;
                    $event->save();
                }
            }
        }

        $categories = Category::all();

        foreach ($categories as $category) {
            if ($category->city_id == 0) {
                $category->delete();
            }
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
