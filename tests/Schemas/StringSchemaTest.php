<?php

namespace Tests\Validators;

use PHPUnit\Framework\TestCase;
use Validator\Validator;
use Validator\Schemas\StringSchema;

class StringSchemaTest extends TestCase
{
    private StringSchema $schema;

    protected function setUp(): void
    {
        $v = new Validator();
        $this->schema = $v->string();
    }

    public function testIsValidWithoutRequired(): void
    {
        $this->assertTrue($this->schema->isValid(null));
        $this->assertTrue($this->schema->isValid(''));
        $this->assertTrue($this->schema->isValid('Tree'));
    }

    public function testRequired(): void
    {
        $this->schema->required();

        $this->assertFalse($this->schema->isValid(null));
        $this->assertFalse($this->schema->isValid(''));
        $this->assertTrue($this->schema->isValid('Tree'));
    }

    public function testContains(): void
    {
        $this->schema->required()->contains('re');

        $this->assertFalse($this->schema->isValid('Tea'));
        $this->assertTrue($this->schema->isValid('Tree'));
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
