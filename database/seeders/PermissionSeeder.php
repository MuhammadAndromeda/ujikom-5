<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::query()->delete();

        $permissions = [
            'view dashboard',
            'view sales',
            'view sales data',
            'view sales report',
            'view materials',
            'view users',
            'view customers',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $kasirRole = Role::firstOrCreate(['name' => 'kasir']);
        $kasirRole->givePermissionTo(['view dashboard', 'view sales']);
    }
}