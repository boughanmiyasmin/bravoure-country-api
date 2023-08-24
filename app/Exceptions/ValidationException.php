<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ValidationException extends APIException
{
    public function getErrorResponse(\Throwable $exception, string $errorCode): JsonResponse
    {
        /** @var \Illuminate\Validation\ValidationException $exception */
        return response()
            ->json(
                \array_merge(
                    [
                        'error' => $errorCode,
                        'message' => 'Invalid parameters provided, verify the invalid params below.',
                        'invalid-params' => $exception->errors(),
                    ],
                    $this->parseExceptionError($exception)
                )
            )
            ->setStatusCode(Response::HTTP_BAD_REQUEST);
    }
}
