<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Equipment;
use App\Models\Service;
use App\Models\Spare;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id'=>Customer::all()->random()->id,
            'equipment_id'=>Spare::all()->random()->id,//cheza nayo
            'count'=>fake()->numberBetween(1,7),
        ];
    }
}
