<?php

namespace App\Modules\Agendamentos\Actions;

use App\Modules\Agendamentos\Enums\AgendamentoStatus;
use App\Modules\Agendamentos\Models\Agendamento;
use Illuminate\Validation\ValidationException;

class CancelarAgendamentoAction
{
    public function execute(Agendamento $agendamento): Agendamento
    {
        if (! in_array($agendamento->status, [AgendamentoStatus::Agendado, AgendamentoStatus::Confirmado], true)) {
            throw ValidationException::withMessages([
                'status' => 'Só é possível cancelar um agendamento que ainda não foi concluído ou já cancelado.',
            ]);
        }

        $agendamento->update(['status' => AgendamentoStatus::Cancelado]);

        return $agendamento;
    }
}
