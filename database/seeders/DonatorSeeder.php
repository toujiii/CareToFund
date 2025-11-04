<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donator;
use App\Models\User;
use App\Models\Charity;

class DonatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $charities = Charity::all();

        if ($users->isEmpty()) {
            $users = User::factory()->count(30)->create();
        }
        if ($charities->isEmpty()) {
            $charities = Charity::factory()->count(25)->create([
                'user_id' => $users->random()->id,
            ]);
        }

        // create 100 donations
        foreach (range(1, 100) as $i) {
            Donator::factory()->create([
                'user_id' => $users->random()->id,
                'charity_id' => $charities->random()->id,
            ]);
        }
    }
}
