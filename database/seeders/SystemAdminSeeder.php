<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SystemAdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate([
            'email' => 'systemadmin@gmail.com',
        ], [
            'name' => 'System Admin',
            'password' => bcrypt('admin123'),
            'status' => 'active',
        ]);
    }
}

