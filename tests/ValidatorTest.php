<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Validator\Validator;

class ValidatorTest extends TestCase
{
    public function testString(): void
    {
        $v = new Validator();
        $schema = $v->string();
        $schema2 = $v->string();

        $this->assertTrue($schema !== $schema2);
    }
}
