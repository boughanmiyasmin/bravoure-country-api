<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\CountryService;
use App\Validators\CountryValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     *      path="api/1.0/countries/youtube/{country_id}",
     *      operationId="getYoutubeVideo",
     *      tags={"CountryController"},
     *      summary="Get YouTube Video Data",
     *      description="Fetches YouTube video data based on country ID.",
     *      @OA\Parameter(
     *          name="country_id",
     *          in="path",
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

    /**
     * @OA\Get(
     *      path="/api/1.0/countries/wikipedia/{country_id}",
     *      operationId="getWikiText",
     *      tags={"CountryController"},
     *      summary="Get Wiki Text Data",
     *      description="Fetches Wikipedia text data based on country name.",
     *      @OA\Parameter(
     *          name="country_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          ),
     *          description="Country name"
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
    public function getWikiText(string $country): JsonResponse
    {
        $this->validateRequest($country, CountryValidator::getCountryRules());
        $response = $this->countryService->getWikiData($country);

        return new JsonResponse(
            $response,
            Response::HTTP_OK,
            [],
            0,
            true
        );
    }

    public function getCountries(Request $request)
    {
        $filters = $request->get('filter') ?? [];
        $limit = (int)($request->query->get('limit') ?? 100);
        $page = (int)($request->page ?? 1);

        $response = $this->countryService->getCountries($filters, $limit, $page);

        return new JsonResponse(
            $response,
            Response::HTTP_OK,
            [],
            0
        );
    }
}
