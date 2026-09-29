<?php

namespace App\Modules\Barbeiros\Models;

use App\Modules\Agendamentos\Models\Agendamento;
use Database\Factories\BarbeiroFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barbeiro extends Model
{
    /** @use HasFactory<BarbeiroFactory> */
    use HasFactory;

    protected $table = 'barbeiros';

    const UPDATED_AT = null;

    const CREATED_AT = 'criado_em';

    protected $fillable = [
        'nome',
        'especialidade',
        'ativo',
    ];

    protected function casts(): array
    {
        return [
            'ativo' => 'boolean',
        ];
    }

    protected static function newFactory(): BarbeiroFactory
    {
        return BarbeiroFactory::new();
    }

    /**
     * @return HasMany<Agendamento, $this>
     */
    public function agendamentos(): HasMany
    {
        return $this->hasMany(Agendamento::class);
    }
}
