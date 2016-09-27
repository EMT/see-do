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

        echo 'Warning: Running this migration is not completely backwards compatible and will make changes to event \'category_id\' references and category \'id\' references. Cancel out of this migration within the next 10 seconds if you dont have a backup...';
        echo "\n";
        sleep(15);
        echo 'Continuing with migration...';
        echo "\n";

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
        $categories = Category::all();

        foreach ($categories as $category) {
            if ($category->city_id != 1) {
                $category->delete();
            }
        }

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('city_id');
        });
    }
}
