<?php

namespace App\Modules\Servicos\Data;

use Illuminate\Foundation\Http\FormRequest;

final readonly class ServicoData
{
    public function __construct(
        public string $nome,
        public ?string $descricao,
        public float $preco,
        public int $duracaoMinutos,
        public bool $ativo,
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            nome: $request->validated('nome'),
            descricao: $request->validated('descricao'),
            preco: (float) $request->validated('preco'),
            duracaoMinutos: (int) $request->validated('duracao_minutos'),
            ativo: $request->boolean('ativo', true),
        );
    }
}
