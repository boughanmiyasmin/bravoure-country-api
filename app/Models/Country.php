<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

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
