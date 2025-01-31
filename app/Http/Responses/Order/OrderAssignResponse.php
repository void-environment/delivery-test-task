<?php

declare(strict_types=1);

namespace App\Http\Responses\Order;

use App\Models\Order;
use App\Http\Responses\AppResponseInterface;

readonly class OrderAssignResponse implements AppResponseInterface
{
    public function __construct(
        public Order $order
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'order' => $this->order,
        ];
    }
}
