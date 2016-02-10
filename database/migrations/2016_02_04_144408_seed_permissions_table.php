<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;

class SeedPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $admin = Role::where('slug', '=', 'admin')->first();
        $contributor = Role::where('slug', '=', 'contributor')->first();

        // Users

        $createUsersPermission = Permission::create([
            'name' => 'Create users',
            'slug' => 'create.users',
            'description' => '', // optional
            'model' => 'App\Users'
        ]);

        $editUsersPermission = Permission::create([
            'name' => 'Edit users',
            'slug' => 'edit.users',
            'model' => 'App\Users'
        ]);

        $deleteUsersPermission = Permission::create([
            'name' => 'Delete users',
            'slug' => 'delete.users',
            'model' => 'App\Users'
        ]);

        $admin->attachPermission($createUsersPermission);
        $admin->attachPermission($editUsersPermission);
        $admin->attachPermission($deleteUsersPermission);

        // Events

        $createEventsPermission = Permission::create([
            'name' => 'Create events',
            'slug' => 'create.events',
            'description' => '', // optional
            'model' => 'App\Events'
        ]);

        $editEventsPermission = Permission::create([
            'name' => 'Edit events',
            'slug' => 'edit.events',
            'model' => 'App\Events'
        ]);

        $deleteEventsPermission = Permission::create([
            'name' => 'Delete events',
            'slug' => 'delete.events',
            'model' => 'App\Events'
        ]);

        $admin->attachPermission($createEventsPermission);
        $admin->attachPermission($editEventsPermission);
        $admin->attachPermission($deleteEventsPermission);

        $contributor->attachPermission($createEventsPermission);
        $contributor->attachPermission($editEventsPermission);
        $contributor->attachPermission($deleteEventsPermission);

        // Categories

        $createCategoryPermission = Permission::create([
            'name' => 'Create category',
            'slug' => 'create.category',
            'description' => '', // optional
            'model' => 'App\Category'
        ]);

        $editCategoryPermission = Permission::create([
            'name' => 'Edit category',
            'slug' => 'edit.category',
            'model' => 'App\Category'
        ]);

        $deleteCategoryPermission = Permission::create([
            'name' => 'Delete category',
            'slug' => 'delete.category',
            'model' => 'App\Category'
        ]);

        $admin->attachPermission($createCategoryPermission);
        $admin->attachPermission($editCategoryPermission);
        $admin->attachPermission($deleteCategoryPermission);

        // Color Schemes

        $createColorSchemePermission = Permission::create([
            'name' => 'Create ColorScheme',
            'slug' => 'create.colorScheme',
            'description' => '', // optional
            'model' => 'App\ColorScheme'
        ]);

        $editColorSchemePermission = Permission::create([
            'name' => 'Edit ColorScheme',
            'slug' => 'edit.colorScheme',
            'model' => 'App\ColorScheme'
        ]);

        $deleteColorSchemePermission = Permission::create([
            'name' => 'Delete ColorScheme',
            'slug' => 'delete.colorScheme',
            'model' => 'App\ColorScheme'
        ]);

        $admin->attachPermission($createColorSchemePermission);
        $admin->attachPermission($editColorSchemePermission);
        $admin->attachPermission($deleteColorSchemePermission);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $admin = Role::where('slug', '=', 'admin')->first();
        $contributor = Role::where('slug', '=', 'contributor')->first();

        $admin->detachAllPermissions();
        $contributor->detachAllPermissions();

        DB::table('permissions')->delete();
        DB::table('permission_user')->delete();
        DB::table('permission_role')->delete();
    }
}
