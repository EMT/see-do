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

        // Get all the old users first and last name and smush them together into a username
        foreach($users as $user)
        {
            $first_name = $user->name_first;
            $last_name = $user->name_last;

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
