<?php

namespace Database\Factories;

use App\Modules\Servicos\Models\Servico;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Servico>
 */
class ServicoFactory extends Factory
{
    protected $model = Servico::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->unique()->words(2, true),
            'descricao' => $this->faker->sentence(),
            'preco' => $this->faker->randomFloat(2, 20, 150),
            'duracao_minutos' => $this->faker->numberBetween(20, 90),
            'ativo' => true,
        ];
    }
}
