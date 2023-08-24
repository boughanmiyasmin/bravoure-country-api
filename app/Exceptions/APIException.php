<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class APIException extends \Exception
{
    protected bool $showStackTrace = false;

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        $debugOnEnv = env('API_DEBUG_ON');
        if (null !== $debugOnEnv) {
            $this->showStackTrace = App::environment(explode(',', $debugOnEnv));
        }
        parent::__construct($message, $code, $previous);
    }

    public function getErrorResponse(\Throwable $exception, string $errorCode): JsonResponse
    {
        return response()
            ->json(
                \array_merge(
                    [
                        'message' => $exception->getMessage(),
                        'error' => $errorCode,
                    ],
                    $this->parseExceptionError($exception)
                )
            )
            ->setStatusCode($this->code == 0 ? Response::HTTP_INTERNAL_SERVER_ERROR : $this->code);
    }

    protected function parseExceptionError(\Throwable $exception): array
    {
        $stack = [];
        if ($this->showStackTrace) {
            $stack['errorMessage'] = $exception->getMessage();
            $stack['currentError'] = $exception->getTrace();
            $stack['previousError'] = $exception->getPrevious();
        }

        return $stack;
    }
}
