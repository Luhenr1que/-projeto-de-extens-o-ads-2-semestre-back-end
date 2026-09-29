<?php

namespace App\Modules\Agendamentos\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Agendamentos\Actions\CancelarAgendamentoAction;
use App\Modules\Agendamentos\Actions\ConcluirAgendamentoAction;
use App\Modules\Agendamentos\Actions\ConfirmarAgendamentoAction;
use App\Modules\Agendamentos\Actions\CreateAgendamentoAction;
use App\Modules\Agendamentos\Data\CreateAgendamentoData;
use App\Modules\Agendamentos\Http\Requests\StoreAgendamentoRequest;
use App\Modules\Agendamentos\Models\Agendamento;
use App\Modules\Agendamentos\Queries\ListAgendamentosQuery;
use App\Modules\Agendamentos\Shapes\AgendamentoShape;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    public function index(Request $request, ListAgendamentosQuery $query)
    {
        return AgendamentoShape::collection(
            $query->execute($request->only(['barbeiro_id', 'cliente_id', 'status', 'data']))
        );
    }

    public function store(StoreAgendamentoRequest $request, CreateAgendamentoAction $action)
    {
        $agendamento = $action->execute(CreateAgendamentoData::fromRequest($request));

        return AgendamentoShape::make($agendamento)->response()->setStatusCode(201);
    }

    public function show(Agendamento $agendamento)
    {
        return AgendamentoShape::make($agendamento->load(['cliente', 'barbeiro', 'servicos']));
    }

    public function confirmar(Agendamento $agendamento, ConfirmarAgendamentoAction $action)
    {
        return AgendamentoShape::make($action->execute($agendamento)->load(['cliente', 'barbeiro', 'servicos']));
    }

    public function concluir(Agendamento $agendamento, ConcluirAgendamentoAction $action)
    {
        return AgendamentoShape::make($action->execute($agendamento)->load(['cliente', 'barbeiro', 'servicos']));
    }

    public function cancelar(Agendamento $agendamento, CancelarAgendamentoAction $action)
    {
        return AgendamentoShape::make($action->execute($agendamento)->load(['cliente', 'barbeiro', 'servicos']));
    }
}
