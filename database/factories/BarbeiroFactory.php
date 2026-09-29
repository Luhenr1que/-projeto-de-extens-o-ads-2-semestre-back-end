<?php

namespace Database\Factories;

use App\Modules\Barbeiros\Models\Barbeiro;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Barbeiro>
 */
class BarbeiroFactory extends Factory
{
    protected $model = Barbeiro::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'especialidade' => $this->faker->randomElement(['Barbeiro', 'Terapeuta / Naturopatia']),
            'ativo' => true,
        ];
    }
}
