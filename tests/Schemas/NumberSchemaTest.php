<?php

namespace Tests\Schemas;

use PHPUnit\Framework\TestCase;
use Validator\Validator;
use Validator\Schemas\NumberSchema;

class NumberSchemaTest extends TestCase
{
    private NumberSchema $schema;

    protected function setUp(): void
    {
        $this->schema = (new Validator())->number();
    }

    public function testRequired(): void
    {
        $this->assertTrue($this->schema->isValid(null));

        $this->schema->required();

        $this->assertFalse($this->schema->isValid(null));
        $this->assertFalse($this->schema->isValid('string'));
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
