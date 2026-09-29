<?php

namespace App\Modules\Servicos\Queries;

use App\Modules\Servicos\Models\Servico;
use Illuminate\Database\Eloquent\Collection;

class ListServicosQuery
{
    public function execute(?bool $apenasAtivos = null): Collection
    {
        return Servico::query()
            ->when($apenasAtivos, fn ($query) => $query->where('ativo', true))
            ->orderBy('nome')
            ->get();
    }
}
