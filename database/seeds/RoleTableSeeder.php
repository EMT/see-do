<?php

use App\User;
use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Admin role for the fieldwork user account, has all the power', // optional
            'level' => 2, // optional, set to 1 by default
        ]);

        Role::create([
            'name' => 'Events Contributor',
            'slug' => 'events.contributor',
            'description' => 'Grants access to creating/deleting/editing events to contributors and collaborators',
            'level' => 1,
        ]);

        $user = User::first();
        $adminRole = Role::where('slug', '=', 'admin')->first();
        $user->attachRole($adminRole);
        $user->save();
    }
}

