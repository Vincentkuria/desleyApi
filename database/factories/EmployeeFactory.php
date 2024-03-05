<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
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
            'first_name'=>fake()->name(),
            'last_name'=>fake()->name(),
            'email'=>fake()->unique()->safeEmail(),
            'password'=>static::$password ??= Hash::make('Employeepassword'),
            'role'=>fake()->randomElement(['driver','HR','manager','inventory manager','supplier','supervisor']),
            'phone_no'=>fake()->phoneNumber(),
        ];
    }
}
