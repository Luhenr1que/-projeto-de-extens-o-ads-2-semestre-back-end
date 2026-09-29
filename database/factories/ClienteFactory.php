<?php

namespace Database\Factories;

use App\Modules\Clientes\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cliente>
 */
class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'telefone' => $this->faker->numerify('(##) #####-####'),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
