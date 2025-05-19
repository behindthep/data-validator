<?php

namespace Tests\Validators;

use PHPUnit\Framework\TestCase;
use Validator\Validator;

class NumberValidatorTest extends TestCase
{
    public function testIsValid(): void
    {
        $v = new Validator();
        $schema = $v->number();

        $this->assertTrue($schema->isValid(null));
        $this->assertTrue($schema->isValid(0));
        $this->assertTrue($schema->isValid(10));
    }

    public function testRequired(): void
    {
        $v = new Validator();
        $schema = $v->number();

        $schema->required();

        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid(0));
        $this->assertTrue($schema->isValid(10));
    }

    public function testPositive(): void
    {
        $v = new Validator();
        $schema = $v->number();

        $schema->positive();

        $this->assertFalse($schema->isValid(-10));
        $this->assertTrue($schema->isValid(10));
    }

    public function testRange(): void
    {
        $v = new Validator();
        $schema = $v->number();

        $schema->range(-5, 5);

        $this->assertFalse($schema->isValid(10));
        $this->assertTrue($schema->isValid(-5));
        $this->assertTrue($schema->isValid(3));
    }
}
