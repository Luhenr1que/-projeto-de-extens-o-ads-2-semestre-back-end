<?php

namespace App\Modules\Barbeiros\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Barbeiros\Actions\CreateBarbeiroAction;
use App\Modules\Barbeiros\Actions\DeleteBarbeiroAction;
use App\Modules\Barbeiros\Actions\UpdateBarbeiroAction;
use App\Modules\Barbeiros\Data\BarbeiroData;
use App\Modules\Barbeiros\Http\Requests\StoreBarbeiroRequest;
use App\Modules\Barbeiros\Http\Requests\UpdateBarbeiroRequest;
use App\Modules\Barbeiros\Models\Barbeiro;
use App\Modules\Barbeiros\Queries\ListBarbeirosQuery;
use App\Modules\Barbeiros\Shapes\BarbeiroShape;
use Illuminate\Http\Request;

class BarbeiroController extends Controller
{
    public function index(Request $request, ListBarbeirosQuery $query)
    {
        return BarbeiroShape::collection($query->execute($request->boolean('ativos')));
    }

    public function store(StoreBarbeiroRequest $request, CreateBarbeiroAction $action)
    {
        $barbeiro = $action->execute(BarbeiroData::fromRequest($request));

        return BarbeiroShape::make($barbeiro)->response()->setStatusCode(201);
    }

    public function show(Barbeiro $barbeiro)
    {
        return BarbeiroShape::make($barbeiro);
    }

    public function update(UpdateBarbeiroRequest $request, Barbeiro $barbeiro, UpdateBarbeiroAction $action)
    {
        return BarbeiroShape::make($action->execute($barbeiro, BarbeiroData::fromRequest($request)));
    }

    public function destroy(Barbeiro $barbeiro, DeleteBarbeiroAction $action)
    {
        $action->execute($barbeiro);

        return response()->noContent();
    }
}
