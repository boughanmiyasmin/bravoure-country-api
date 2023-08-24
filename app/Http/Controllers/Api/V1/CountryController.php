<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\CountryService;
use App\Validators\CountryValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CountryController extends Controller
{
    public function __construct(
        private CountryService $countryService)
    {
    }

    public function getYoutubeVideo(string $country_id): JsonResponse
    {
        $this->validateRequest($country_id, CountryValidator::getCountryRules());
        $response = $this->countryService->getYoutubeData($country_id);

        return new JsonResponse(
            $response,
            Response::HTTP_OK,
            [],
            0,
            false
        );
    }
}
