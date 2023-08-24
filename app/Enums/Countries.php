<?php

declare(strict_types=1);

namespace App\Enums;

use MyCLabs\Enum\Enum;

final class Countries extends Enum
{
    const GB = 'gb';
    const NL = 'nl';
    const DE = 'de';
    const FR = 'fr';
    const ES = 'es';
    const IT = 'it';
    const GR = 'gr';

    public static function all(): array
    {
        return [
            self::GB => 'United Kingdom',
            self::NL => 'Netherlands',
            self::DE => 'Germany',
            self::FR => 'France',
            self::ES => 'Spain',
            self::IT => 'Italy',
            self::GR => 'Greece',
        ];
    }

    public static function fullName(string $code): ?string
    {
        $countries = self::all();
        return $countries[$code] ?? null;
    }
}
