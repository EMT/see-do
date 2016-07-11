<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwitterApiKeysToCities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->string('twitter_consumer_key');
            $table->string('twitter_consumer_secret');
            $table->string('twitter_access_token');
            $table->string('twitter_access_token_secret');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('twitter_consumer_key');
            $table->dropColumn('twitter_consumer_secret');
            $table->dropColumn('twitter_access_token');
            $table->dropColumn('twitter_access_token_secret');
        });
    }
}
