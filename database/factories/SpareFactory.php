<?php

namespace Database\Factories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spare>
 */
class SpareFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'price'=>fake()->numberBetween(700,9000),
            'item_description'=>fake()->paragraph(),
            'img_url'=>fake()->imageUrl(),
            'inventory_id'=>Inventory::all()->random()->id,
        ];
    }
}
