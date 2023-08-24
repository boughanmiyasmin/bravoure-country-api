<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class APIExceptionFactory
{
    public function buildExceptionErrorResponse(\Throwable $exception, string $errorCode): JsonResponse
    {
        switch (get_class($exception)) {
            case InvalidParameterException::class:
                $exceptionToBeResponded = new InvalidParameterException();
                break;
            case ValidationException::class:
                $exceptionToBeResponded = new \App\Exceptions\ValidationException();
                break;
            default:
                $exceptionToBeResponded = new APIException();
                break;
        }

        return $exceptionToBeResponded->getErrorResponse($exception, $errorCode);
    }
}
