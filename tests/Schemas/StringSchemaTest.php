<?php

namespace Tests\Schemas;

use PHPUnit\Framework\TestCase;
use Validator\Validator;
use Validator\Schemas\StringSchema;

class StringSchemaTest extends TestCase
{
    private StringSchema $schema;

    protected function setUp(): void
    {
        $this->schema = (new Validator())->string();
    }

    public function testRequired(): void
    {
        $this->assertTrue($this->schema->isValid(null));

        $this->schema->required();

        $this->assertFalse($this->schema->isValid(null));
        $this->assertFalse($this->schema->isValid(''));
        $this->assertFalse($this->schema->isValid(5));
        $this->assertTrue($this->schema->isValid('Tree'));
    }

    public function testContains(): void
    {
        $this->schema->required()->contains('White');

        $this->assertFalse($this->schema->isValid('Tea'));
        $this->assertTrue($this->schema->isValid('White tree'));
    }

    public function testMinLength(): void
    {
        $this->schema->required()->minLength(10);

        $this->assertFalse($this->schema->isValid('Tree'));
        $this->assertTrue($this->schema->isValid('Green peach tree'));

        $this->schema->minLength(4);

        $this->assertTrue($this->schema->isValid('Tree'));
    }
}
