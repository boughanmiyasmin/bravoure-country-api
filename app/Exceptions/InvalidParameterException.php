<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class InvalidParameterException extends APIException
{
    public function getErrorResponse(\Throwable $exception, string $errorCode): JsonResponse
    {
        return response()
            ->json(
                \array_merge(
                    [
                        'error' => $errorCode,
                        'message' => 'Invalid parameters provided, verify the invalid params below.',
                        'invalid-params' => \json_decode($exception->getMessage()),
                    ],
                    $this->parseExceptionError($exception)
                )
            )
            ->setStatusCode(Response::HTTP_BAD_REQUEST);
    }
}
