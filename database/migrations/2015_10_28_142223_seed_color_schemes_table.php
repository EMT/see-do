<?php

use App\ColorScheme;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedColorSchemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ColorScheme::create([
            'color_1' => 'rgb(23,0,3)',
            'color_2' => 'rgb(247,146,30)',
            'color_3' => 'rgb(255,240,201)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(110,212,221)',
            'color_2' => 'rgb(229,19,120)',
            'color_3' => 'rgb(58,58,60)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(250,209,55)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(224,187,49)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(248,232,165)',
            'color_2' => 'rgb(152,149,137)',
            'color_3' => 'rgb(49,58,66)',
        ]);
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
