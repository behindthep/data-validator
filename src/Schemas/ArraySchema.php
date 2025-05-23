<?php

namespace Validator\Schemas;

class ArraySchema extends Schema
{
    public function required(): self
    {
        $this->validators['required'] = fn($value) => is_array($value);
        return $this;
    }

    public function sizeof(int $length): self
    {
        $this->validators['sizeof'] = fn($value) => count($value) === $length;
        return $this;
    }

    /*
    $key = 'name'
    значения — объекты схем, для валидации соответствующих элементов
    $schema = $v->string()->required()

    $value = ['name' => '', 'age' => null];

    проверка isValid() для соответствующей схемы
    $v->string()->required()->isValid('')
    */
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
