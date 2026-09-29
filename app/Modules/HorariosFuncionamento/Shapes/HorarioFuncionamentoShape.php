<?php

namespace App\Modules\HorariosFuncionamento\Shapes;

use App\Modules\HorariosFuncionamento\Models\HorarioFuncionamento;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin HorarioFuncionamento */
class HorarioFuncionamentoShape extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'dia_semana' => $this->dia_semana,
            'horario_inicio' => $this->horario_inicio,
            'horario_fim' => $this->horario_fim,
        ];
    }
}
