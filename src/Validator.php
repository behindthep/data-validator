<?php

namespace Validator;

use Validator\Schemas\{
    StringSchema,
    NumberSchema,
    ArraySchema
};

class Validator
{
    private array $customValidators = [];

    public function string(): StringSchema
    {
        return new StringSchema($this->getCustomValidators('string'));
    }

    public function number(): NumberSchema
    {
        return new NumberSchema($this->getCustomValidators('number'));
    }

    public function array(): ArraySchema
    {
        return new ArraySchema($this->getCustomValidators('array'));
    }

    /*
    $customValidators = [
        "string" = [
            "startWith" = fn($value, $start) => str_starts_with($value, $start),
            ...
        ],
        "number" = [
            "min" = fn($value, $min) => $value >= $min,
            ...
        ],
        "array" = [
            "inArray" = fn($array, $inArray) => in_array($inArray, $array),
            ...
        ],
    ]
    */
    public function addValidator(string $type, string $name, callable $fn): self
    {
        $this->customValidators[$type][$name] = $fn;
        return $this;
    }

    private function getCustomValidators(string $type): array
    {
        return $this->customValidators[$type] ?? [];
    }
}
