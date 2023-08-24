<?php

declare(strict_types=1);

namespace App\Validators;

use App\Enums\Countries;
use Illuminate\Validation\Rule;

class CountryValidator
{
    public static function getCountryRules(): array
    {
        return [
            'country' => [
                Rule::in(Countries::toArray())
            ]
        ];
    }
}
