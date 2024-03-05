<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Inventory;
use App\Models\Payment;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SupplierTransaction>
 */
class SupplierTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'request_from'=>Employee::where('role','inventory manager')->get()->random()->id,
            'inventory_id'=>Inventory::all()->random()->id,
            'supplier_id'=>Supplier::all()->random()->id,
            'count'=>fake()->numberBetween(1,999),
            'count'=>fake()->numberBetween(500,1000000),
            'payment_id'=>Payment::all()->random()->id,
        ];
    }
}
