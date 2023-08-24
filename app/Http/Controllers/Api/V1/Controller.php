<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\InvalidParameterException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Nette\Schema\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;


    protected function validateRequest(string $id, array $rules): void
    {
        try {
            $validator = Validator::make(["country" => $id], $rules);

            if ($validator->fails()) {
                throw new InvalidParameterException(json_encode($validator->errors()->getMessages()));
            }
        } catch (ValidationException) {
            throw new InvalidParameterException(sprintf('Invalid Country: ' . $id));
        }
    }
}
