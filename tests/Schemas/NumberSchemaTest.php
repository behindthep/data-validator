<?php

namespace Tests\Validators;

use PHPUnit\Framework\TestCase;
use Validator\Validator;
use Validator\Schemas\NumberSchema;

class NumberSchemaTest extends TestCase
{
    private NumberSchema $schema;

    protected function setUp(): void
    {
        $v = new Validator();
        $this->schema = $v->number();
    }

    public function testIsValidWithoutRequired(): void
    {
        $this->assertTrue($this->schema->isValid(null));
        $this->assertTrue($this->schema->isValid(0));
        $this->assertTrue($this->schema->isValid(-5));
        $this->assertTrue($this->schema->isValid(10));
    }

    public function testRequired(): void
    {
        $this->schema->required();

        $this->assertFalse($this->schema->isValid(null));
        $this->assertTrue($this->schema->isValid(0));
        $this->assertTrue($this->schema->isValid(-5));
        $this->assertTrue($this->schema->isValid(10));
    }

    public function testPositive(): void
    {
        $this->schema->required()->positive();

        $this->assertFalse($this->schema->isValid(-10));
        $this->assertTrue($this->schema->isValid(10));
    }

    public function testRange(): void
    {
        $this->schema->required()->range(-5, 5);

        $this->assertFalse($this->schema->isValid(10));
        $this->assertTrue($this->schema->isValid(-5));
        $this->assertTrue($this->schema->isValid(3));
    }
}
