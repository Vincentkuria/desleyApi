<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name'=>fake()->company(),
            'email'=>fake()->unique()->safeEmail(),
            'password'=>static::$password ??= Hash::make('Supplierpassword'),
        ];
    }
}
