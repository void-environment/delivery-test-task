<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NoContentResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(status: Response::HTTP_NO_CONTENT);
    }
}
