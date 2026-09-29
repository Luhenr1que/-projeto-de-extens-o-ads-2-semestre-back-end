<?php

namespace App\Modules\Clientes\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Clientes\Actions\CreateClienteAction;
use App\Modules\Clientes\Actions\DeleteClienteAction;
use App\Modules\Clientes\Actions\UpdateClienteAction;
use App\Modules\Clientes\Data\ClienteData;
use App\Modules\Clientes\Http\Requests\StoreClienteRequest;
use App\Modules\Clientes\Http\Requests\UpdateClienteRequest;
use App\Modules\Clientes\Models\Cliente;
use App\Modules\Clientes\Queries\ListClientesQuery;
use App\Modules\Clientes\Shapes\ClienteShape;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request, ListClientesQuery $query)
    {
        return ClienteShape::collection($query->execute($request->string('busca')->value() ?: null));
    }

    public function store(StoreClienteRequest $request, CreateClienteAction $action)
    {
        $cliente = $action->execute(ClienteData::fromRequest($request));

        return ClienteShape::make($cliente)->response()->setStatusCode(201);
    }

    public function show(Cliente $cliente)
    {
        return ClienteShape::make($cliente);
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente, UpdateClienteAction $action)
    {
        return ClienteShape::make($action->execute($cliente, ClienteData::fromRequest($request)));
    }

    public function destroy(Cliente $cliente, DeleteClienteAction $action)
    {
        $action->execute($cliente);

        return response()->noContent();
    }
}
