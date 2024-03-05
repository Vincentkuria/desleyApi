<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_code'=>fake()->uuid(),
            'customer_id'=>Customer::all()->random()->id,
            'supplier_id'=>Supplier::all()->random()->id,
            'amount'=>fake()->numberBetween(1,50000),
        ];
    }
}
