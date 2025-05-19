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

    public function testNumber(): void
    {
        $v = new Validator();
        $schema = $v->number();
        $schema2 = $v->number();

        $this->assertTrue($schema !== $schema2);
    }

    public function testArray(): void
    {
        $v = new Validator();
        $schema = $v->array();
        $schema2 = $v->array();

        $this->assertTrue($schema !== $schema2);
    }
}
