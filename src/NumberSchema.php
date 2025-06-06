<?php

namespace Validator;

class NumberSchema extends Schema
{
    /**
     * Любое число включая ноль
     * @return $this
     */
    public function required(): self
    {
        $this->validators['required'] = fn($value) => is_numeric($value);

        return $this;
    }

    /**
     * Положительное число
     * @return $this
     */
    public function positive(): self
    {
        $this->validators['positive'] = fn($value) => $value === null || $value > 0;

        return $this;
    }

    /**
     * Диапазон в который должны попадать числа включая границы
     * @param int $min
     * @param int $max
     * @return $this
     */
    public function range(int $min, int $max): self
    {
        $this->validators['range'] = fn($value) => ($min <= $value) && ($value <= $max);

        return $this;
    }
}
