<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DefaultRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permdissions
        Permission::firstOrCreate(['name' => 'web.*']);

        Permission::firstOrCreate(['name' => 'web.messages.*']);
        Permission::firstOrCreate(['name' => 'web.messages.create']);
        Permission::firstOrCreate(['name' => 'web.messages.edit']);
        Permission::firstOrCreate(['name' => 'web.messages.delete']);

        // create roles and assign created permissions
        $role = Role::firstOrCreate(['name' => 'super-admin']);

        $role = Role::firstOrCreate(['name' => 'admin'])
            ->givePermissionTo(['web.*']);

        $role = Role::firstOrCreate(['name' => 'user'])
            ->givePermissionTo(['web.messages.create', 'web.messages.edit']);
    }
}
