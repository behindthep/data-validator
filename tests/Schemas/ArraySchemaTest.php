<?php

namespace Tests\Schemas;

use PHPUnit\Framework\TestCase;
use Validator\Validator;
use Validator\Schemas\ArraySchema;

class ArraySchemaTest extends TestCase
{
    private ArraySchema $schema;

    protected function setUp(): void
    {
        $this->schema = (new Validator())->array();
    }

    public function testRequired(): void
    {
        $this->assertTrue($this->schema->isValid(null));

        $this->schema->required();

        $this->assertFalse($this->schema->isValid(null));
        $this->assertFalse($this->schema->isValid(5));
        $this->assertFalse($this->schema->isValid('string'));
        $this->assertTrue($this->schema->isValid([]));
        $this->assertTrue($this->schema->isValid([1, 2, 3]));
    }

    public function testSizeof(): void
    {
        $this->schema->required()->sizeof(2);

        $this->assertFalse($this->schema->isValid([1, 2, 3]));
        $this->assertTrue($this->schema->isValid([true, []]));
    }

    public function testShape(): void
    {
        $v = new Validator();

        $this->schema->sizeof(2)->shape([
            'name' => $v->string()->required(),
            'age' => $v->number()->positive(),
        ]);

        $this->assertFalse($this->schema->isValid(['name' => '', 'age' => null]));
        $this->assertFalse($this->schema->isValid(['name' => 'ada', 'age' => -5]));
        $this->assertFalse($this->schema->isValid(['name' => 'kolya', 'age' => 100, 'city' => 'Brooklyn']));
        $this->assertTrue($this->schema->isValid(['name' => 'kolya', 'age' => 100]));
        $this->assertTrue($this->schema->isValid(['name' => 'maya', 'age' => null]));
    }
}
