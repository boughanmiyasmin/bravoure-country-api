<?php

namespace App\Services;

use Alaouy\Youtube\Facades\Youtube;
use App\Cache\YoutubeCache;

class CountryService
{
    public function __construct(
        private YoutubeCache $youtubeCache,
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

    public function findYoutubeVideo(string $id): array
    {
        $response = Youtube::getPopularVideos($id);
        $this->youtubeCache->addCache($response, $id);

        return $response;
    }
}
