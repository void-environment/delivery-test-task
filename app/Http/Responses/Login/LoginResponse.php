<?php

declare(strict_types=1);

namespace App\Http\Responses\Login;

use App\Http\Responses\AppResponseInterface;

readonly class LoginResponse implements AppResponseInterface
{
    public function __construct(
        public string $token
    ) 
    {

    }

    public function jsonSerialize(): array
    {
        return [
            'token' => $this->token
        ];
    }
}
