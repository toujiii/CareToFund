<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Charity_Request;
use App\Models\User;

class Charity_RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        if ($users->isEmpty()) {
            $users = User::factory()->count(30)->create();
        }

        // Create 40 charity requests and attach to existing users
        Charity_Request::factory()
            ->count(40)
            ->make()
            ->each(function ($request) use ($users) {
                $request->user_id = $users->random()->id;
                $request->save();
            });
    }
}
