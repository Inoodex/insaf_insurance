<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (!User::where('email', 'hello@inoodex.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'hello@inoodex.com',
                'password' => Hash::make('hello@inoodex.com'),
            ]);
        }

        $this->call([
            TestDataSeeder::class,
        ]);
    }
}
