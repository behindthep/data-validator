<?php

namespace Validator;

class ArraySchema extends Schema
{
    /**
     * Требуется тип данных array
     * @return $this
     */
    public function required(): self
    {
        $this->validators['required'] = fn($value) => is_array($value);

        return $this;
    }

    /**
     * Длина массива равна указанной
     * @param int $size
     * @return self
     */
    public function sizeof(int $size): self
    {
        $this->validators['sizeof'] = fn($value) => count($value) === $size;

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
    /**
     * Позволяет описывать валидацию для ключей массива
     * @param Schema[] $schemas
     * @return $this
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
