<?php

namespace Validator\Schemas;

class StringSchema extends Schema
{
    protected array $rules = [];

    public function required(): self
    {
        $this->validators['required'] = function ($value): bool {
            return is_string($value) && $value !== '';
        };

        return $this;
    }

    public function contains(string $substring): self
    {
        $this->validators['contains'] = function ($value) use ($substring): bool {
            return mb_strpos($value, $substring) !== false;
        };

        return $this;
    }

    public function minLength(int $length): self
    {
        $this->validators['minLength'] = function ($value) use ($length): bool {
            return mb_strlen($value) >= $length;
        };

        return $this;
    }
}
