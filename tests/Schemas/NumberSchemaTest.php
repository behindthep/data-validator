<?php

namespace Tests\Schemas;

use Validator\Validator;
use Validator\Schemas\NumberSchema;
use PHPUnit\Framework\TestCase;

class NumberSchemaTest extends TestCase
{
    private NumberSchema $numSchema;

    protected function setUp(): void
    {
        $validator = new Validator();
        $this->numSchema = $validator->number();
    }

    public function testNumberSchema(): void
    {
        $this->assertTrue($this->numSchema->isValid(null));

        $this->numSchema->required();

        $this->assertFalse($this->numSchema->isValid(null));
        $this->assertTrue($this->numSchema->isValid(7));

        $this->numSchema->positive()->isValid(10);

        $this->numSchema->range(-5, 5);

        $this->assertFalse($this->numSchema->isValid(-3));
        $this->assertTrue($this->numSchema->isValid(5));
    }
}
