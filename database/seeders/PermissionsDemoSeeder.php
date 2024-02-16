<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['guard_name' => 'web','name' => 'edit category']);
        Permission::create(['guard_name' => 'web','name' => 'delete category']);
        Permission::create(['guard_name' => 'web','name' => 'view category']);
        Permission::create(['guard_name' => 'web','name' => 'list category']);
        Permission::create(['guard_name' => 'web','name' => 'nav category']);

        Permission::create(['guard_name' => 'web','name' => 'import category']);
        Permission::create(['guard_name' => 'web','name' => 'export category']);

        // create roles and assign existing permissions
        $role1 = Role::create(['guard_name' => 'web','name' => 'user']);
        $role1->givePermissionTo('view category');
        $role1->givePermissionTo('list category');
        $role1->givePermissionTo('view category');
        $role1->givePermissionTo('nav category');

        // $role2 = Role::create(['name' => 'admin']);
        // $role2->givePermissionTo('publish articles');
        // $role2->givePermissionTo('unpublish articles');

        $role3 = Role::create(['guard_name' => 'web','name' => 'Super-Admin']);
        $role3->givePermissionTo(Permission::all());
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Cesar Cuadra',
            'email' => 'cesar.cuadra@hospitalmilitar.com.ni',
            'password' => Hash::make('&ecurity23')
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@yopmail.com',
            'password' => Hash::make('12345678')
        ]);
        $user->assignRole($role1);

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Example Super-Admin User',
        //     'email' => 'superadmin@example.com',
        // ]);
        // $user->assignRole($role3);
    }
}
