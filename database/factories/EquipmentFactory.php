<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    protected $model=Equipment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'price'=>fake()->numberBetween(5000,50000),
            'item_description'=>fake()->paragraph(),
            'img_url'=>fake()->imageUrl(),
            'video_url'=>'https://www.youtube.com/watch?v=UPVKMtQ9rlI',
            'inventory_id'=>Inventory::all()->random()->id,
        ];
    }
}
