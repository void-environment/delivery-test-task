<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NotFoundResponse extends JsonResponse
{
    public function __construct(?string $message = null, ?string $field = null)
    {
        $data = null;

        if ($message) {
            $data = ['message' => $message];

            if ($field) {
                $data['errors'][$field] = [$message];
            }
        }

        parent::__construct(
            $data,
            status: Response::HTTP_NOT_FOUND
        );
    }
}
