<?php

namespace Validator\Schemas;

use Validator\Schema;

class ArraySchema extends Schema
{
    public function required(): self
    {
        $this->validators['required'] = fn($value) => is_array($value);

        return $this;
    }

    public function sizeof(int $size): self
    {
        $this->validators['sizeof'] = fn($value) => count($value) === $size;

        return $this;
    }

    public function shape(array $schemas): self
    {
        $this->validators['shape'] = function ($value) use ($schemas): bool {
            foreach ($schemas as $key => $schema) {
                if (!$schema->isValid($value[$key])) {
                    return false;
                }
            }

            return true;
        };

        return $this;
    }
}
