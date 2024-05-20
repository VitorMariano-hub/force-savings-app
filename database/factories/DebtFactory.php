<?php

namespace Database\Factories;

use App\Models\Debt;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DebtFactory extends Factory
{
    protected $model = Debt::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'type' => $this->faker->word,
            'total_amount' => $this->faker->randomFloat(2, 100, 10000),
            'term_months' => $this->faker->numberBetween(1, 24),
        ];
    }
}
