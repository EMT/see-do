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

        $harry = User::where('email', '=', 'harry@madebyfieldwork.com')->first();

        $adminRole = Role::where('slug', '=', 'admin')->first();

        if($harry) {
            $harry->attachRole($contribRole);
            $harry->save();
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('roles')->delete();
        DB::table('role_user')->delete();
    }
}
