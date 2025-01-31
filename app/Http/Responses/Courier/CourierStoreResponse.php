<?php

declare(strict_types=1);

namespace App\Http\Responses\Courier;

use App\Http\Responses\AppResponseInterface;

readonly class CourierStoreResponse implements AppResponseInterface
{
    public function __construct(
        public array $couriers
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'couriers' => $this->couriers,
        ];
    }
}
