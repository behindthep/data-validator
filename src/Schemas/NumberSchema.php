<?php

namespace Validator\Schemas;

use Validator\Schema;

class NumberSchema extends Schema
{
    public function required(): self
    {
        $this->validators['required'] = fn($value) => is_numeric($value);

        return $this;
    }

    public function positive(): self
    {
        $this->validators['positive'] = fn($value) => $value === null || $value > 0;

        return $this;
    }

    public function range(int $min, int $max): self
    {
        $this->validators['range'] = fn($value) => ($min <= $value) && ($value <= $max);

        return $this;
    }
}
