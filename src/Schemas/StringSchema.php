<?php

namespace Validator\Schemas;

use Validator\Schema;

class StringSchema extends Schema
{
    public function required(): self
    {
        $this->validators['required'] = function ($value): bool {
            return is_string($value) && !empty($value);
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

    public function minLength(int $minLength): self
    {
        $this->validators['minLength'] = function ($value) use ($minLength): bool {
            return mb_strlen($value) >= $minLength;
        };

        return $this;
    }
}
