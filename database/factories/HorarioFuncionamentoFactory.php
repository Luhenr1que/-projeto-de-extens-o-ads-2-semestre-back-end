<?php

namespace Database\Factories;

use App\Modules\HorariosFuncionamento\Models\HorarioFuncionamento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HorarioFuncionamento>
 */
class HorarioFuncionamentoFactory extends Factory
{
    protected $model = HorarioFuncionamento::class;

    public function definition(): array
    {
        return [
            'dia_semana' => $this->faker->unique()->randomElement([
                'Segunda', 'Terca', 'Quarta', 'Quinta', 'Sexta', 'Sabado',
            ]),
            'horario_inicio' => '09:00',
            'horario_fim' => '20:00',
        ];
    }
}
