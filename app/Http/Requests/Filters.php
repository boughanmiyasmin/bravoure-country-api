<?php

namespace App\Http\Requests;

class Filters
{
    public const OPERATOR_IN = 'in';
    public const OPERATOR_LIKE = 'like';
    public const OPERATOR_EQUALS = 'eq';
    public const OPERATOR_NOT_EQUALS = 'ne';
    public const OPERATOR_LESS_THAN = 'lt';
    public const OPERATOR_GREATER_THAN = 'gt';
    public const OPERATOR_LESS_THAN_OR_EQUAL = 'le';
    public const OPERATOR_GREATER_THAN_OR_EQUAL = 'ge';

    public const OPERATORS = [
        self::OPERATOR_IN => 'in',
        self::OPERATOR_EQUALS => '=',
        self::OPERATOR_NOT_EQUALS => '!=',
        self::OPERATOR_LESS_THAN => '<',
        self::OPERATOR_GREATER_THAN => '>',
        self::OPERATOR_LESS_THAN_OR_EQUAL => '<=',
        self::OPERATOR_GREATER_THAN_OR_EQUAL => '>=',
        self::OPERATOR_LIKE => 'like'
    ];
}
