<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    private $id;
    private $name;
    private $youtube_video_title;
    private $youtube_video_description;
    private $thumbnail_default_url;
    private $thumbnail_default_width;
    private $thumbnail_default_height;
    private $thumbnail_high_url;
    private $thumbnail_high_width;
    private $thumbnail_high_height;
    private $country_description;


    protected $table = 'countries';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'youtube_video_title',
        'youtube_video_description',
        'thumbnail_default_url',
        'thumbnail_default_width',
        'thumbnail_default_height',
        'thumbnail_high_url',
        'thumbnail_high_width',
        'thumbnail_high_height',
        'country_description',
    ];

}
