<?php

namespace App\Modules\HorariosFuncionamento\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\HorariosFuncionamento\Actions\UpdateHorarioFuncionamentoAction;
use App\Modules\HorariosFuncionamento\Data\HorarioFuncionamentoData;
use App\Modules\HorariosFuncionamento\Http\Requests\UpdateHorarioFuncionamentoRequest;
use App\Modules\HorariosFuncionamento\Models\HorarioFuncionamento;
use App\Modules\HorariosFuncionamento\Queries\ListHorariosFuncionamentoQuery;
use App\Modules\HorariosFuncionamento\Shapes\HorarioFuncionamentoShape;

class HorarioFuncionamentoController extends Controller
{
    public function index(ListHorariosFuncionamentoQuery $query)
    {
        return HorarioFuncionamentoShape::collection($query->execute());
    }

    public function update(
        UpdateHorarioFuncionamentoRequest $request,
        HorarioFuncionamento $horario,
        UpdateHorarioFuncionamentoAction $action
    ) {
        return HorarioFuncionamentoShape::make($action->execute($horario, HorarioFuncionamentoData::fromRequest($request)));
    }
}
