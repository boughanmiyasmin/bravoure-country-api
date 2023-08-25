<?php

namespace App\Repositories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;

class CountryRepository extends AbstractRepository
{
    public function findCountries(array $filterColumns = [], int $limit = null, int $page = null): array
    {
        // disallow using page 0 or negative page numbers
        if (isset($page) && $page < 1) {
            $page = 1;
        }

        // create a new query on devices
        $query = Country::query();

        if (count($filterColumns) !== 0) {
            // add filters to the query
            $query = $this->applyFilters($filterColumns, $query);
        }

        $paginatedCountries = $query->simplePaginate(perPage: $limit, page: $page);
        $response['data'] = $paginatedCountries->items();
        // Verify if the next page has results
        if ($paginatedCountries->hasMorePages()) {
            $response['nextPage'] = $page + 1;
        }

        return $response;
    }

    private function getCountryById(string $id): ?Model
    {
        return Country::query()
            ->where('id', $id)
            ->first();
    }

    public function updateCountry(array $data): void
    {
        $country = $this->getCountryById($data['id']);
        $country->fill($data);
        $country->save();
    }

    public function createCountry(array $data): void
    {
        $country = new Country();
        $country->fill($data);
        $country->save();
    }
}
