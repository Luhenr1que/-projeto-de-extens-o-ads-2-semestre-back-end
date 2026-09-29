<?php

namespace App\Modules\Servicos\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Servicos\Actions\CreateServicoAction;
use App\Modules\Servicos\Actions\DeleteServicoAction;
use App\Modules\Servicos\Actions\UpdateServicoAction;
use App\Modules\Servicos\Data\ServicoData;
use App\Modules\Servicos\Http\Requests\StoreServicoRequest;
use App\Modules\Servicos\Http\Requests\UpdateServicoRequest;
use App\Modules\Servicos\Models\Servico;
use App\Modules\Servicos\Queries\ListServicosQuery;
use App\Modules\Servicos\Shapes\ServicoShape;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index(Request $request, ListServicosQuery $query)
    {
        return ServicoShape::collection($query->execute($request->boolean('ativos')));
    }

    public function store(StoreServicoRequest $request, CreateServicoAction $action)
    {
        $servico = $action->execute(ServicoData::fromRequest($request));

        return ServicoShape::make($servico)->response()->setStatusCode(201);
    }

    public function show(Servico $servico)
    {
        return ServicoShape::make($servico);
    }

    public function update(UpdateServicoRequest $request, Servico $servico, UpdateServicoAction $action)
    {
        return ServicoShape::make($action->execute($servico, ServicoData::fromRequest($request)));
    }

    public function destroy(Servico $servico, DeleteServicoAction $action)
    {
        $action->execute($servico);

        return response()->noContent();
    }
}
