<?php

namespace App\DTO;

use App\Enums\Countries;
use Spatie\DataTransferObject\DataTransferObject;

final class CountryDTO extends DataTransferObject
{
    public string $id;
    public ?string $name;
    public ?string $youtube_video_title;
    public ?string $youtube_video_description;
    public ?string $thumbnail_default_url;
    public ?int $thumbnail_default_width;
    public ?int $thumbnail_default_height;
    public ?string $thumbnail_high_url;
    public ?int $thumbnail_high_width;
    public ?int $thumbnail_high_height;
    public ?string $country_description;

    public function __construct(
        string $country,
        array $youtubeData,
        string $wikiData
    )
    {
        $youtubeData = json_decode(json_encode($youtubeData), true)[0];
        $args = [
            'id' => $country,
            'name' => Countries::all()[$country],
            'youtube_video_title' => $youtubeData['snippet']['title'],
            'youtube_video_description' => $youtubeData['snippet']['description'],
            'thumbnail_default_url'=> $youtubeData['snippet']['thumbnails']['default']['url'],
            'thumbnail_default_width'=> $youtubeData['snippet']['thumbnails']['default']['width'],
            'thumbnail_default_height'=> $youtubeData['snippet']['thumbnails']['default']['height'],
            'thumbnail_high_url'=> $youtubeData['snippet']['thumbnails']['high']['url'],
            'thumbnail_high_width'=> $youtubeData['snippet']['thumbnails']['high']['width'],
            'thumbnail_high_height'=> $youtubeData['snippet']['thumbnails']['high']['height'],
            'country_description' => $wikiData,
        ];

        parent::__construct($args);
    }

}
