<?php

namespace Validator\Validators;

class ArrayValidator
{
    private bool $required = false;
    private ?int $sizeof = null;

    public function isValid(?array $array): bool
    {
        if ($this->required) {
            if (!is_array($array)) {
                return false;
            }

            if ($this->sizeof !== null && count($array) !== $this->sizeof) {
                return false;
            }
        }

        return true;
    }

    public function required(): self
    {
        $this->required = true;
        return $this;
    }

    public function sizeof(int $length): self
    {
        $this->sizeof = $length;
        return $this;
    }
}
