<?php

namespace App\Modules\Clientes\Actions;

use App\Modules\Clientes\Data\ClienteData;
use App\Modules\Clientes\Models\Cliente;

class CreateClienteAction
{
    public function execute(ClienteData $data): Cliente
    {
        return Cliente::query()->create([
            'nome' => $data->nome,
            'telefone' => $data->telefone,
            'email' => $data->email,
        ]);
    }
}
