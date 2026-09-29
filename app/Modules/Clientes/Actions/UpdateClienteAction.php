<?php

namespace App\Modules\Clientes\Actions;

use App\Modules\Clientes\Data\ClienteData;
use App\Modules\Clientes\Models\Cliente;

class UpdateClienteAction
{
    public function execute(Cliente $cliente, ClienteData $data): Cliente
    {
        $cliente->update([
            'nome' => $data->nome,
            'telefone' => $data->telefone,
            'email' => $data->email,
        ]);

        return $cliente;
    }
}
