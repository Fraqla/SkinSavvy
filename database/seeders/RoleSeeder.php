<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'system_admin']);
        Role::create(['name' => 'admin_consultant']);
        Role::create(['name' => 'user']);
        
    }
}
