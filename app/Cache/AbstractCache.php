<?php

declare(strict_types=1);

namespace App\Cache;

use Illuminate\Support\Facades\Cache;

class AbstractCache
{
    public const CACHE_NAME = null;

    public function addCache(mixed $body, ?string $country = 'all'): void
    {
        if ($country === 'all') {
            Cache::forever($country . '-' . static::CACHE_NAME, $body);
            return;
        }

        Cache::put($country . '-' . static::CACHE_NAME, $body, now()->addMinutes(5));
    }

    public function getCache(?string $country = 'all'): mixed
    {
        return Cache::get($country . '-' . static::CACHE_NAME);
    }
}
