<?php

namespace App\Services;

use GuzzleHttp\Client;

class WikipediaService
{
    protected $baseUrl = 'https://en.wikipedia.org/w/api.php';

    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getArticleIntro($title)
    {
        $response = $this->client->get($this->baseUrl, [
            'query' => [
                'action' => 'query',
                'format' => 'json',
                'prop' => 'extracts',
                'exintro' => true,
                'titles' => $title,
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        $page = current($data['query']['pages']);

        return $page['extract'];
    }
}
