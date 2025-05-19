<?php

namespace Validator;

use Validator\Validators\{
    StringValidator,
    NumberValidator,
    ArrayValidator
};

class Validator
{
    public function string(): StringValidator
    {
        return new StringValidator();
    }

    public function number(): NumberValidator
    {
        return new NumberValidator();
    }

    public function array(): ArrayValidator
    {
        return new ArrayValidator();
    }
}
