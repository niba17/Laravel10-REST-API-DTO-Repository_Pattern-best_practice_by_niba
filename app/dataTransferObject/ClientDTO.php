<?php

namespace App\DataTransferObject;

use App\Http\Requests\ClientRequest;

class ClientDTO
{
    public function __construct(
        public readonly string $identifier,
        public readonly string $password,
    ) {
    }

    public static function apiRequest(ClientRequest $request): ClientDTO
    {
        return new self(
            identifier: $request->identifier,
            password: $request->password,
        );
    }
}
