<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\CountryService;
use App\Validators\CountryValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * @OA\Info(
 *     title="Bravoure-country-api",
 *     version="1.0",
 *     description="countries data",
 *     @OA\Contact(
 *         name="Yasmin Boughanmi",
 *         email="yasminboghanmi@outlook.com"
 *     ),
 * )
 */
class CountryController extends Controller
{
    public function __construct(
        private CountryService $countryService)
    {
    }

    /**
     * @OA\Get(
     *      path="/countries/youtube/{country_id}",
     *      operationId="getYoutubeVideo",
     *      tags={"YourController"},
     *      summary="Get YouTube Video Data",
     *      description="Fetches YouTube video data based on country ID.",
     *      @OA\Parameter(
     *          name="country_id",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          ),
     *          description="Country ID"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful response",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *      ),
     * )
     */
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
