<?php

namespace Database\Factories;

use App\Models\Conta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conta>
 */
class ContaFactory extends Factory
{
    protected $model = Conta::class;

    public function definition()
    {
        return [
            'numero_conta' => $this->faker->bankAccountNumber(),
            'saldo' => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}
