<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Equipment;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Spare;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerTransaction>
 */
class CustomerTransactionFactory extends Factory
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
            'payment_id'=>Payment::all()->random()->id,
            //'equipment_id'=>Equipment::all()->random()->id,
            //'spare_id'=>Spare::all()->random()->id,
            'service_id'=>Service::all()->random()->id,
        ];
    }
}
