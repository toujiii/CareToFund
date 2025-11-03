<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Charity;
use App\Models\User;

class CharitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        if ($users->isEmpty()) {
            // Ensure users exist (falls back to factory)
            $users = User::factory()->count(30)->create();
        }

        // create 25 charities assigned to random existing users
        Charity::factory()
            ->count(25)
            ->make()
            ->each(function ($charity) use ($users) {
                $charity->user_id = $users->random()->id;
                $charity->save();
            });
    }
}
