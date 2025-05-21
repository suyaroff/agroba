<?php

namespace Database\Seeders;

use App\Models\Enterprise;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

/**
 * Database seeder class for initial data population.
 *
 * Creates default admin and company user accounts along with their associated enterprises.
 * - Admin user with credentials: admin@mail.com/admin
 * - Company user with credentials: bob@mail.com/password
 * Each user gets an associated enterprise record.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Adminoff',
            'email' => 'admin@mail.com',
            'password' => 'admin',
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Bob',
            'email' => 'bob@mail.com',
            'password' => 'password',
            'role' => 'company'
        ]);

        Enterprise::factory()->create(['owner_id' => 1]);
        Enterprise::factory()->create(['owner_id' => 2]);

    }
}
