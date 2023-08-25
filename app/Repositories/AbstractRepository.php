<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\Filters;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractRepository
{
    protected function applyFilters(array $filterColumns, Builder $query): Builder
    {
        foreach ($filterColumns as $column => $value) {
            $query = $this->applyFilter($query, $column, $value);
        }

        return $query;
    }

    public function applyFilter(Builder $query, string $column, $filterValue): Builder
    {
        if (is_array($filterValue)) {
            foreach ($filterValue as $operator => $value) {
                [$operator, $value] = $this->extractOperator([$operator => $value]);
                $query = $this->buildQuery($query, $column, $operator, $value);
            }
        } else {
            $operator = '=';
            $query = $this->buildQuery($query, $column, $operator, $filterValue);
        }

        return $query;
    }

    private function buildQuery(Builder $query, string $column, string $operator, $value): Builder
    {
        if ($operator == Filters::OPERATOR_IN) {
            $query->whereIn($column, (array)$value);
        } else {
            $query->where($column, $operator, $value);
        }

        return $query;
    }

    private function extractOperator(array $value): array
    {
        $operator = Filters::OPERATORS[key($value)];

        $value = reset($value);
        if ($operator == Filters::OPERATOR_LIKE) {
            $value = "%" . $value . "%";
        }

        return [$operator, $value];
    }
}
