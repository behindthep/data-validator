<?php

namespace Tests\Schemas;

use Validator\Validator;
use Validator\Schemas\{
    ArraySchema,
    StringSchema,
    NumberSchema
};
use PHPUnit\Framework\TestCase;

class ArraySchemaTest extends TestCase
{
    private ArraySchema $arrSchema;
    private StringSchema $strSchema;
    private NumberSchema $numSchema;

    protected function setUp(): void
    {
        $validator = new Validator();
        $this->arrSchema = $validator->array();
        $this->strSchema = $validator->string();
        $this->numSchema = $validator->number();
    }

    public function testArraySchema(): void
    {
        $this->assertTrue($this->arrSchema->isValid(null)); // false @todo @fixme

        $this->arrSchema = $this->arrSchema->required();

        $this->assertTrue($this->arrSchema->isValid([]));
        $this->assertTrue($this->arrSchema->isValid(['hex']));

        $this->arrSchema->sizeof(2);

        $this->assertFalse($this->arrSchema->isValid(['hex']));
        $this->assertTrue($this->arrSchema->isValid(['hex', 'code-basics']));
    }

    public function testArrayShape(): void
    {
        $this->arrSchema->shape([
            'name' => $this->strSchema->required(),
            'age' => $this->numSchema->positive(),
        ]);

        $this->assertTrue($this->arrSchema->isValid(['name' => 'kolya', 'age' => 100]));
        $this->assertTrue($this->arrSchema->isValid(['name' => 'maya', 'age' => null]));
        $this->assertFalse($this->arrSchema->isValid(['name' => '', 'age' => null]));
        $this->assertFalse($this->arrSchema->isValid(['name' => 'ada', 'age' => -5]));
    }
}
