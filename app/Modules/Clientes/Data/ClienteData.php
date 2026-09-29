<?php

namespace App\Modules\Clientes\Data;

use Illuminate\Foundation\Http\FormRequest;

final readonly class ClienteData
{
    public function __construct(
        public string $nome,
        public string $telefone,
        public ?string $email,
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            nome: $request->validated('nome'),
            telefone: $request->validated('telefone'),
            email: $request->validated('email'),
        );
    }
}
