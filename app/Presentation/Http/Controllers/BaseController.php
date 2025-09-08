<?php

declare(strict_types=1);

namespace App\Presentation\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as Status;

abstract class BaseController
{
    protected function handleExceptionResponse(Exception $e): JsonResponse
    {
        return response()->json([
            'error' => $e->getMessage(),
        ], Status::HTTP_BAD_REQUEST);
    }
}
