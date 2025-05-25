<?php

namespace Validator;

abstract class Schema
{
    protected array $validators = [];
    protected array $customValidators = [];

    public function __construct(array $customValidators)
    {
        $this->customValidators = $customValidators;
    }

    /*
    соответствует ли значение всем валидаторам. Если хотя бы
    один валидатор не проходит, возвращает false.

    $validators = [
        "required" = function ($value): bool {
            return is_string($value) && $value !== '';
        },
        "contains" = function ($value) use ($substring): bool {
            return mb_strpos($value, $substring) !== false;
        };
    ]
    */
    public function isValid(mixed $value): bool
    {
        foreach ($this->validators as $validator) {
            if (!$validator($value)) {
                return false;
            }
        }

        return true;
    }

    /*
    добавлять пользовательские валидаторы в массив validators

    имя валидатора соответствовать ключу в массиве $customValidators, где хранится логика валидации.

    $customValidators = [
        'startWith' => fn($value, $start) => str_starts_with($value, $start),
    ];
    */
    public function test(string $name, mixed ...$args): self
    {
        $this->validators[$name] = function ($value) use ($name, $args) {
            $validator = $this->customValidators[$name];

            return $validator($value, ...$args);
        };

        return $this;
    }
}
