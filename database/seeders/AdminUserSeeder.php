<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Create the first admin user and give them the admin + user roles.
     *
     * Runs after RoleSeeder, so the admin/user roles already exist.
     */
    public function run(): void
    {
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@mysite.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('12345'), // use a stronger password in production
            ]
        );

        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        // syncWithoutDetaching attaches these roles without removing any existing ones,
        // and won't create duplicate pivot rows.
        $adminUser->roles()->syncWithoutDetaching([
            $adminRole->id,
            $userRole->id,
        ]);
    }
}
