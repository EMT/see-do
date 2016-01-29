<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use App\User;

class AddSlugToUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        // Get records from old column.
        $users = User::get();

        // Loop through the results of the old column, split the values.
        // For example, let's say you have to explode a |.
        foreach($users as $user)
        {
            $first_name = $user->name_first;
            $last_name = $user->name_last;

            // Insert the split values into new columns.
            $user->username = $first_name.' '. $last_name;
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }

}
