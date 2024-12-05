<?php

namespace Database\Seeders;

use App\Models\Flight;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       User::factory()->create([
           'name' => 'Test Admin',
           'email' => 'testadmin@example.com',
           'is_admin' => 1,
       ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'is_admin' => 0,
        ]);

        $this->call([
           FlightSeeder::class
        ]);
    }
}
