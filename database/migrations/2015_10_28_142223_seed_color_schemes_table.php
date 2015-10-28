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
            'color_1' => 'rgb(9,64,163)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(242,112,111)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(105,35,88)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(242,112,111)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(9,64,163)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(240,93,31)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(67,51,91)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(243,167,197)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(45,230,139)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(25,77,25)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(158,238,224)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(13,97,79)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(81,56,81)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(158,238,224)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(252,86,64)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(66,34,241)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(253,145,138)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(51,110,251)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(51,110,251)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(164,231,254)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(238,174,77)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(34,62,139)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(6,67,65)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(253,145,138)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(240,93,31)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(247,226,68)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(138,199,235)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(190,179,173)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(59,183,106)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(68,74,160)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(82,110,117)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(253,237,189)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(241,110,173)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(102,102,102)',
        ]);

        ColorScheme::create([
            'color_1' => 'rgb(243,227,98)',
            'color_2' => 'rgb(255,255,255)',
            'color_3' => 'rgb(68,74,160)',
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
