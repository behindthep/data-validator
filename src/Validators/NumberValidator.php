<?php

namespace Validator\Validators;

class NumberValidator
{
    private bool $required = false;
    private bool $positive = false;
    private ?int $rangeStart = null;
    private ?int $rangeEnd = null;

    public function isValid(?int $number): bool
    {
        if ($this->required && is_null($number)) {
            return false;
        }

        if ($this->positive && $number < 0) {
            return false;
        }

        if ($this->rangeStart !== null && $this->rangeEnd !== null) {
            if ($number < $this->rangeStart || $number > $this->rangeEnd) {
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

    public function positive(): self
    {
        $this->positive = true;
        return $this;
    }

    public function range(int $start, int $finish): self
    {
        $this->rangeStart = $start;
        $this->rangeEnd = $finish;
        return $this;
    }
}
