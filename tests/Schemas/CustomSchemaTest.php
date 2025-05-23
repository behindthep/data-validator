<?php

namespace Tests\Schemas;

use PHPUnit\Framework\TestCase;
use Validator\Validator;

class CustomSchemaTest extends TestCase
{
    private Validator $v;

    protected function setUp(): void
    {
        $this->v = new Validator();
    }

    public function testAddValidatorWithStringType(): void
    {
        $fn = fn($value, $start) => str_starts_with($value, $start);
        $this->v->addValidator('string', 'startWith', $fn);

        $schema = $this->v->string()->test('startWith', 'H');
        $this->assertFalse($schema->isValid('exet'));
        $this->assertTrue($schema->isValid('Hekko'));
    }

    public function testAddValidatorWithNumberType(): void
    {
        $fn = fn($value, $min) => $value >= $min;
        $this->v->addValidator('number', 'min', $fn);

        $schema = $this->v->number()->test('min', 5);
        $this->assertFalse($schema->isValid(4));
        $this->assertTrue($schema->isValid(6));
    }

    public function testAddValidatorWithArrayType(): void
    {
        $fn = fn($array, $inArray) => in_array($inArray, $array);
        $this->v->addValidator('array', 'inArray', $fn);

        $schema = $this->v->array()->test('inArray', 5);
        $this->assertFalse($schema->isValid([3, 4, 6]));
        $this->assertTrue($schema->isValid([4, 5, 6]));
    }
}
