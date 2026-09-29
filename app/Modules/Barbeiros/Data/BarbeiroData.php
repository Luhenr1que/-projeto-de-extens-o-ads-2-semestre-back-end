<?php

namespace App\Modules\Barbeiros\Data;

use Illuminate\Foundation\Http\FormRequest;

final readonly class BarbeiroData
{
    public function __construct(
        public string $nome,
        public ?string $especialidade,
        public bool $ativo,
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            nome: $request->validated('nome'),
            especialidade: $request->validated('especialidade'),
            ativo: $request->boolean('ativo', true),
        );
    }
}
