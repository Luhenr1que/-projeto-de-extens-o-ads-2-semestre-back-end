<?php

namespace App\Modules\Agendamentos\Enums;

enum AgendamentoStatus: string
{
    case Agendado = 'AGENDADO';
    case Confirmado = 'CONFIRMADO';
    case Concluido = 'CONCLUIDO';
    case Cancelado = 'CANCELADO';
}
