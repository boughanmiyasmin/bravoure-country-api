<?php

namespace App\Services;

use Alaouy\Youtube\Facades\Youtube;
use App\Cache\WikiCache;
use App\Cache\YoutubeCache;
use App\Enums\Countries;

class CountryService
{
    public function __construct(
        private YoutubeCache $youtubeCache,
        private WikiCache $wikiCache,
        private WikipediaService $wikipediaService

    )
    {
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
}
