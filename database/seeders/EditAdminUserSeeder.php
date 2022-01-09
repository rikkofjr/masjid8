<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EditAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'Admin', 
            'name' => 'Admin', 
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
     
        $user->assignRole('Admin');
    }
}
