<?php

namespace Validator\Validators;

class StringValidator
{
    private bool $required = false;
    private ?int $minLength = null;
    private ?string $contains = null;

    public function isValid(?string $string): bool
    {
        if ($this->required) {
            if (is_null($string) || $string === '') {
                return false;
            }
        }

        if ($this->contains !== null) {
            if (str_contains($string, $this->contains) === false) {
                return false;
            }
        }

        if ($this->minLength !== null) {
            if (strlen($string) < $this->minLength) {
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

    public function contains(string $substring): self
    {
        $this->contains = $substring;
        return $this;
    }

    public function minLength(int $length): self
    {
        $this->minLength = $length;
        return $this;
    }
}
