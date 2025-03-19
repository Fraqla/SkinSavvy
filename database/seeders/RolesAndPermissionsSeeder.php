<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions based on sidebar routes
        $permissions = [
            'manage content',
            'manage product',
            'manage promotion news',
            'waiting approval',
            'admin consultant',
            'manage roles',
            'admin approval',
            'manage product',
            'manage category',
        ];

        // Create permissions (avoid duplicates)
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define roles and their permissions
        $roles = [
            'user' => [
                'waiting approval',
            ],
            'admin_consultant' => [
                'manage content',
                'manage product',
                'manage promotion news',
                'manage category',
            ],
            'system_admin' => [
                'manage content',
                'manage product',
                'manage promotion news',
                'waiting approval',
                'admin consultant',
                'manage roles',
                'admin approval',
                'manage category',
            ],
        ];

        // Create roles and assign permissions
        foreach ($roles as $role => $perms) {
            $roleInstance = Role::firstOrCreate(['name' => $role]);
            $roleInstance->syncPermissions($perms);
        }
    }
}
