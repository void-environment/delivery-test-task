<?php

declare(strict_types=1);

namespace App\Http\Responses\Order;

use App\Http\Responses\AppResponseInterface;

readonly class OrderStoreResponse implements AppResponseInterface
{
    public function __construct(
        public array $order
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'order' => $this->order,
        ];
    }
}
