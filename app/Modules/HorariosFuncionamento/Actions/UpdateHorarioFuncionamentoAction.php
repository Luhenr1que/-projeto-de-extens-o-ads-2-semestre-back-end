<?php

namespace App\Modules\HorariosFuncionamento\Actions;

use App\Modules\HorariosFuncionamento\Data\HorarioFuncionamentoData;
use App\Modules\HorariosFuncionamento\Models\HorarioFuncionamento;

class UpdateHorarioFuncionamentoAction
{
    public function execute(HorarioFuncionamento $horario, HorarioFuncionamentoData $data): HorarioFuncionamento
    {
        $horario->update([
            'horario_inicio' => $data->horarioInicio,
            'horario_fim' => $data->horarioFim,
        ]);

        return $horario;
    }
}
