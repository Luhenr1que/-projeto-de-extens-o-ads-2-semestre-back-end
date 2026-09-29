<?php

namespace Database\Factories;

use App\Modules\Agendamentos\Enums\AgendamentoStatus;
use App\Modules\Agendamentos\Models\Agendamento;
use App\Modules\Barbeiros\Models\Barbeiro;
use App\Modules\Clientes\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Agendamento>
 */
class AgendamentoFactory extends Factory
{
    protected $model = Agendamento::class;

    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::factory(),
            'barbeiro_id' => Barbeiro::factory(),
            'data_hora' => $this->faker->dateTimeBetween('now', '+30 days'),
            'status' => AgendamentoStatus::Agendado,
            'observacao' => $this->faker->optional()->sentence(),
        ];
    }
}
