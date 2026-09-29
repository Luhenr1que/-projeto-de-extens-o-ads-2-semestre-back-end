<?php

namespace App\Modules\Clientes\Queries;

use App\Modules\Clientes\Models\Cliente;
use Illuminate\Database\Eloquent\Collection;

class ListClientesQuery
{
    public function execute(?string $busca = null): Collection
    {
        return Cliente::query()
            ->when($busca, fn ($query) => $query->where('nome', 'ilike', "%{$busca}%"))
            ->orderBy('nome')
            ->get();
    }
}
