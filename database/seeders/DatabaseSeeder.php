<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create()->each(function ($user) {
            \App\Models\Debt::factory(5)->create(['user_id' => $user->id])->each(function ($debt) {
                \App\Models\Payment::factory(3)->create(['debt_id' => $debt->id]);
            });

            \App\Models\Notification::factory(5)->create(['user_id' => $user->id]);
        });
    }
}
