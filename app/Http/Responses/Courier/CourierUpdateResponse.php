<?php

declare(strict_types=1);

namespace App\Http\Responses\Courier;

use App\Models\Courier;
use App\Http\Responses\AppResponseInterface;

readonly class CourierUpdateResponse implements AppResponseInterface
{
    public function __construct(
        public Courier $courier
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'courier' => $this->courier->toArray(),
        ];
    }
}
