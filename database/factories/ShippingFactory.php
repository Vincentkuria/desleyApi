<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Equipment;
use App\Models\Spare;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipping>
 */
class ShippingFactory extends Factory
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
            'shipping_address'=>fake()->address(),
            //'equipment_id'=>Equipment::all()->random()->id,
            'spare_id'=>Spare::all()->random()->id,
            'shipped_by'=>Employee::where('role','driver')->get()->random()->id,
        ];
    }
}
