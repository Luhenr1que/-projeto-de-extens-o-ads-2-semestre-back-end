<?php

namespace App\Modules\Agendamentos\Actions;

use App\Modules\Agendamentos\Enums\AgendamentoStatus;
use App\Modules\Agendamentos\Models\Agendamento;
use Illuminate\Validation\ValidationException;

class ConfirmarAgendamentoAction
{
    public function execute(Agendamento $agendamento): Agendamento
    {
        if ($agendamento->status !== AgendamentoStatus::Agendado) {
            throw ValidationException::withMessages([
                'status' => 'Só é possível confirmar um agendamento com status AGENDADO.',
            ]);
        }

        $agendamento->update(['status' => AgendamentoStatus::Confirmado]);

        return $agendamento;
    }
}
