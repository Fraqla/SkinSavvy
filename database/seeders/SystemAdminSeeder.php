<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SystemAdminSeeder extends Seeder
{
    public function run()
    {
        // Ensure the role exists
        Role::firstOrCreate(['name' => 'system_admin']);

        // Create or update the user
        $user = User::updateOrCreate([
            'email' => 'systemadmin@gmail.com',
        ], [
            'name' => 'System Admin',
            'password' => bcrypt('admin123'),
            'status' => 'active',
        ]);

        // Assign the role
        $user->assignRole('system_admin');
    }
}
