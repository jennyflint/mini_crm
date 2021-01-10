<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->times(100)
            ->create()
            ->each(function ($user) {
                Company::factory()->count(100)->state([
                    'user_id' => $user->id,
                ])->has(Client::factory()->state([
                    'user_id' => $user->id,
                ])->count(20))->create();
            });
    }
}
