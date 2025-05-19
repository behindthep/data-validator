<?php

namespace Validator;

use Validator\Validators\{StringValidator, NumberValidator};

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
}
