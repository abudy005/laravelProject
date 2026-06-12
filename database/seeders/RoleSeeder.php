<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed the default roles.
     *
     * updateOrCreate() matches on 'name' so running this seeder more than once
     * won't create duplicate rows — it just keeps the descriptions in sync.
     */
    public function run(): void
    {
        Role::updateOrCreate(
            ['name' => 'admin'],
            ['description' => 'Administrator role']
        );

        Role::updateOrCreate(
            ['name' => 'user'],
            ['description' => 'Regular user role']
        );
    }
}
