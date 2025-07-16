<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Validator\Validator;

class ValidatorTest extends TestCase
{
    private Validator $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    public function testAddStringValidator(): void
    {
        $fn = fn($value, $start) => str_starts_with($value, $start);
        $this->validator->addValidator('string', 'startWith', $fn);

        $schema = $this->validator->string()->test('startWith', 'H');
        $this->assertFalse($schema->isValid('exlet'));
        $this->assertTrue($schema->isValid('Hex'));
    }

    public function testAddNumberValidator(): void
    {
        $fn = fn($value, $min) => $value >= $min;
        $this->validator->addValidator('number', 'min', $fn);

        $schema = $this->validator->number()->test('min', 5);
        $this->assertFalse($schema->isValid(4));
        $this->assertTrue($schema->isValid(6));
    }
}
