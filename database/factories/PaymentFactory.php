<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Debt;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'debt_id' => Debt::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'payment_date' => $this->faker->date('Y-m-d'),
        ];
    }
}
