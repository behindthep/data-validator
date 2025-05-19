<?php

namespace Tests\Validators;

use PHPUnit\Framework\TestCase;
use Validator\Validator;
use Validator\Schemas\ArraySchema;

class ArraySchemaTest extends TestCase
{
    private ArraySchema $schema;

    protected function setUp(): void
    {
        $v = new Validator();
        $this->schema = $v->array();
    }

    public function testIsValidWithoutRequired(): void
    {
        $this->assertTrue($this->schema->isValid(null));
        $this->assertTrue($this->schema->isValid([]));
        $this->assertTrue($this->schema->isValid(['Tree']));
        $this->assertTrue($this->schema->isValid([1, 2, 3]));
    }

    public function testRequired(): void
    {
        $this->schema->required();

        $this->assertFalse($this->schema->isValid(null));
        $this->assertTrue($this->schema->isValid([]));
        $this->assertTrue($this->schema->isValid(['Tree']));
        $this->assertTrue($this->schema->isValid([1, 2, 3]));
    }

    public function testSizeof(): void
    {
        $this->schema->required()->sizeof(2);

        $this->assertFalse($this->schema->isValid(['Tree']));
        $this->assertFalse($this->schema->isValid([1, 2, 3]));
        $this->assertTrue($this->schema->isValid([true, []]));
    }
}
