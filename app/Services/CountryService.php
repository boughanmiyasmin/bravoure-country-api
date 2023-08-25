<?php

namespace App\Services;

use Alaouy\Youtube\Facades\Youtube;
use App\Cache\CountryCache;
use App\Cache\WikiCache;
use App\Cache\YoutubeCache;
use App\DTO\CountryDTO;
use App\Enums\Countries;
use App\Repositories\CountryRepository;
use Carbon\Carbon;

class CountryService
{
    public function __construct(
        private CountryRepository $countryRepository,
        private YoutubeCache $youtubeCache,
        private WikiCache $wikiCache,
        private CountryCache $countryCache,
        private WikipediaService $wikipediaService
    ) {
    }

    public function getYoutubeData(string $id): array
    {
        if (!$youtubeResponse = $this->youtubeCache->getCache($id)) {
            $youtubeResponse = $this->findYoutubeVideo($id);
        }

        return $youtubeResponse;
    }

    private function findYoutubeVideo(string $id): array
    {
        $response = Youtube::getPopularVideos($id);
        $this->youtubeCache->addCache($response, $id);

        return $response;
    }

    public function getWikiData(string $id): string
    {
        if (!$wikiResponse = $this->wikiCache->getCache($id)) {
            $wikiResponse = $this->findWikiText($id);
        }

        return $wikiResponse;
    }

    private function findWikiText(string $id): string
    {
        $response = $this->wikipediaService->getArticleIntro(Countries::all()[$id]);
        $this->wikiCache->addCache(json_encode($response), $id);

        return $response;
    }

    public function getCountries(array $filters, int $limit, int $page): array
    {
        $lastUpdate = $this->countryCache->getCache();
        if (!isset($lastUpdate)) {
            $lastUpdate = $this->createCountries();
        }

        if ($lastUpdate->gt(Carbon::now()->subMinutes(10))) {
            return $this->countryRepository->findCountries($filters, $limit, $page);
        }

        $this->updateCountries();
        return $this->countryRepository->findCountries($filters, $limit, $page);
    }


    private function updateCountries(): void
    {
        foreach (Countries::toArray() as $id) {
            $data = $this->getData($id);
            $this->countryRepository->updateCountry($data->all());
        }
        $this->countryCache->addCache(Carbon::now());
    }

    private function createCountries(): Carbon
    {
        foreach (Countries::toArray() as $id) {
            $data = $this->getData($id);
            $this->countryRepository->createCountry($data->all());
        }
        $this->countryCache->addCache(Carbon::now());

        return Carbon::now();
    }

    private function getData(string $id): CountryDTO
    {
        return new CountryDTO(
            $id,
            $this->getYoutubeData($id),
            $this->getWikiData($id)
        );
    }
}
