<?php

namespace App\Modules\Barbeiros\Queries;

use App\Modules\Barbeiros\Models\Barbeiro;
use Illuminate\Database\Eloquent\Collection;

class ListBarbeirosQuery
{
    public function execute(?bool $apenasAtivos = null): Collection
    {
        return Barbeiro::query()
            ->when($apenasAtivos, fn ($query) => $query->where('ativo', true))
            ->orderBy('nome')
            ->get();
    }
}
