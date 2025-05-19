<?php

namespace Validator\Validators;

class NumberValidator
{
    private bool $required = false;
    private bool $positive = false;
    private ?int $rangeStart = null;
    private ?int $rangeFinish = null;

    public function isValid(?int $number): bool
    {
        if ($this->required) {
            if (is_null($number)) {
                return false;
            }

            if ($this->positive && $number < 0) {
                return false;
            }

            if ($this->rangeStart !== null && $this->rangeFinish !== null) {
                if ($number < $this->rangeStart || $number > $this->rangeFinish) {
                    return false;
                }
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
        $this->rangeFinish = $finish;
        return $this;
    }
}
