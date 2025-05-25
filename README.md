# data-validator

[![Actions Status](https://github.com/behindthep/php-oop-project-60/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/behindthep/php-oop-project-60/actions)
[![PHP CI](https://github.com/behindthep/php-oop-project-60/actions/workflows/workflow.yml/badge.svg)](https://github.com/behindthep/php-oop-project-60/actions/workflows/workflow.yml)

Валидатор данных – библиотека для проверяки корректность данных.

### Setup

```bash
make setup
```

### Usage

#### String Validation

```php
use Validator\Validator;

$v = new Validator();

$strSchema = $v->string()->required()->contains('White');
$strSchema->isValid('Car'); // false
$strSchema->isValid('White car'); // true
```

#### Number Validation

```php
$numSchema = $v->number()->required()->positive();
$numSchema->isValid(-10); // false
$numSchema->isValid(5); // true
```

#### Array Validation

```php
$arrSchema = $v->array()->required()->sizeof(2);
$arrSchema->isValid([1, 2, 3]); // false
$arrSchema->isValid([true, []]); // true

$arrShapeSchema = $v->array()->sizeof(2)->shape([
    'name' => $v->string()->required(),
    'age' => $v->number()->positive(),
]);

$arrShapeSchema->isValid(['name' => 'ada', 'age' => -5]); // false
$arrShapeSchema->isValid(['name' => 'maya', 'age' => null]); // true
```

#### Custom Validation

```php
$fn = fn($value, $start) => str_starts_with($value, $start);
$v->addValidator('string', 'startWith', $fn);

$customSchema = $v->string()->test('startWith', 'H');
$customSchema->isValid('ello'); // false
$customSchema->isValid('Hello'); // true
```
