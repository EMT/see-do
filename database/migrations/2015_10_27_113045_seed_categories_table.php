<?php

use App\Category;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Category::create(['title' => 'Talks']);
        Category::create(['title' => 'Gigs']);
        Category::create(['title' => 'Exibitions']);
        Category::create(['title' => 'Hackdays & Workshops']);
        Category::create(['title' => 'Films']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
