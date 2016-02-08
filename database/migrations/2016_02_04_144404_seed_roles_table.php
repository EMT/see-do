<?php

use App\User;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Bican\Roles\Models\Role;

class SeedRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Admin role for the fieldwork user account, has all the power',
            'level' => 2,
        ]);

        Role::create([
            'name' => 'Events Contributor',
            'slug' => 'contributor',
            'description' => 'Grants access to creating/deleting/editing events to contributors and collaborators',
            'level' => 1,
        ]);

        /*

        |
        |  Temp Migration Code!
        |  No other way to seed the first admin user, will add a
        |  method for an admin to make more admins though.
        |

        */

        // change this to grant admin to anyone with a fieldwork email.

        $fieldworkUsers = User::where('email','like','%@madebyfieldwork.com')->get();
        $adminRole = Role::where('slug', '=', 'admin')->first();

        foreach($fieldworkUsers as $user) {
            $user->attachRole($adminRole);
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

        $fieldworkUsers = User::where('email','like','%@madebyfieldwork.com')->get();
        $adminRole = Role::where('slug', '=', 'admin')->first();

        foreach($fieldworkUsers as $user) {
            $user->detachRole($adminRole);
            $user->save();
        }

        DB::table('roles')->delete();
        DB::table('role_user')->delete();
    }
}
