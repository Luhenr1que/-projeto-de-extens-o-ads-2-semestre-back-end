<?php

namespace App\Modules\Clientes\Models;

use App\Modules\Agendamentos\Models\Agendamento;
use Database\Factories\ClienteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    /** @use HasFactory<ClienteFactory> */
    use HasFactory;

    protected $table = 'clientes';

    const UPDATED_AT = null;

    const CREATED_AT = 'criado_em';

    protected $fillable = [
        'nome',
        'telefone',
        'email',
    ];

    protected static function newFactory(): ClienteFactory
    {
        return ClienteFactory::new();
    }

    /**
     * @return HasMany<Agendamento, $this>
     */
    public function agendamentos(): HasMany
    {
        return $this->hasMany(Agendamento::class);
    }
}
