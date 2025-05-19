<?php

namespace Tests\Validators;

use PHPUnit\Framework\TestCase;
use Validator\Validator;

class StringValidatorTest extends TestCase
{
    public function testIsValid(): void
    {
        $v = new Validator();
        $schema = $v->string();

        $this->assertTrue($schema->isValid(''));
        $this->assertTrue($schema->isValid(null));
        $this->assertTrue($schema->isValid('what does the fox say'));
    }

    public function testRequired(): void
    {
        $v = new Validator();
        $schema = $v->string();

        $schema->required();

        $this->assertFalse($schema->isValid(''));
        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid('what does the fox say'));
    }

    public function testContains(): void
    {
        $v = new Validator();
        $schema = $v->string();

        $schema->contains('what');

        $this->assertFalse($schema->isValid('does the fox say'));
        $this->assertTrue($schema->isValid('what does the fox say'));
    }

    public function testMinLength(): void
    {
        $v = new Validator();
        $schema = $v->string();

        $schema->minLength(10);

        $this->assertFalse($schema->isValid('Tree'));
        $this->assertTrue($schema->isValid('what does the fox say'));

        $schema->minLength(4);

        $this->assertTrue($schema->isValid('Tree'));
    }
}
