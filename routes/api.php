<?php

use App\Modules\Agendamentos\Http\Controllers\AgendamentoController;
use App\Modules\Barbeiros\Http\Controllers\BarbeiroController;
use App\Modules\Clientes\Http\Controllers\ClienteController;
use App\Modules\HorariosFuncionamento\Http\Controllers\HorarioFuncionamentoController;
use App\Modules\Servicos\Http\Controllers\ServicoController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('clientes', ClienteController::class);
    Route::apiResource('barbeiros', BarbeiroController::class);
    Route::apiResource('servicos', ServicoController::class);

    Route::get('horarios-funcionamento', [HorarioFuncionamentoController::class, 'index']);
    Route::put('horarios-funcionamento/{horario:dia_semana}', [HorarioFuncionamentoController::class, 'update']);

    Route::apiResource('agendamentos', AgendamentoController::class)->only(['index', 'store', 'show']);
    Route::patch('agendamentos/{agendamento}/confirmar', [AgendamentoController::class, 'confirmar']);
    Route::patch('agendamentos/{agendamento}/concluir', [AgendamentoController::class, 'concluir']);
    Route::patch('agendamentos/{agendamento}/cancelar', [AgendamentoController::class, 'cancelar']);
});
