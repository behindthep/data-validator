<?php

namespace Tests\Schemas;

use Validator\Validator;
use Validator\Schemas\StringSchema;
use PHPUnit\Framework\TestCase;

class StringSchemaTest extends TestCase
{
    private StringSchema $strSchema;

    protected function setUp(): void
    {
        $validator = new Validator();
        $this->strSchema = $validator->string();
    }

    public function testStringSchema(): void
    {
        $this->assertTrue($this->strSchema->isValid(''));

        $this->strSchema->required();
        $this->assertTrue($this->strSchema->isValid('what does the fox say'));
        $this->assertTrue($this->strSchema->isValid('hex'));
        $this->assertFalse($this->strSchema->isValid(null));
        $this->assertFalse($this->strSchema->isValid(''));

        $this->strSchema->minLength(8);

        $this->assertTrue($this->strSchema->isValid('what does the fox say'));
        $this->assertFalse($this->strSchema->isValid('google'));

        $this->assertTrue($this->strSchema->contains('what')->isValid('what does the fox say'));
        $this->assertFalse($this->strSchema->contains('whatthe')->isValid('what does the fox say'));
    }
}
