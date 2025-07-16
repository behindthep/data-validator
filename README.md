# data-validator

[![PHP CI](https://github.com/behindthep/data-validator/actions/workflows/phpci.yml/badge.svg)](https://github.com/behindthep/data-validator/actions)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=behindthep_data-validator&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=behindthep_data-validator)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=behindthep_data-validator&metric=bugs)](https://sonarcloud.io/summary/new_code?id=behindthep_data-validator)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=behindthep_data-validator&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=behindthep_data-validator)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=behindthep_data-validator&metric=coverage)](https://sonarcloud.io/summary/new_code?id=behindthep_data-validator)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=behindthep_data-validator&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=behindthep_data-validator)


Data validator is a library for checking the correctness of data.

## Prerequisites

* Linux
* PHP >=8.2
* Xdebug
* Make
* Git

## Setup

```bash
make install
```

## Run linter and Tests

```bash
make lint
make test
```

---

### String Validation

```php
use Validator\Validator;

$v = new Validator();

$strSchema = $v->string()->required()->contains('White');
$strSchema->isValid('Car'); // false
$strSchema->isValid('White car'); // true
```

### Number Validation

```php
$numSchema = $v->number()->required()->positive();
$numSchema->isValid(-10); // false
$numSchema->isValid(5); // true
```

### Array Validation

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

### Custom Validation

```php
$fn = fn($value, $start) => str_starts_with($value, $start);
$v->addValidator('string', 'startWith', $fn);

$customSchema = $v->string()->test('startWith', 'H');
$customSchema->isValid('ello'); // false
$customSchema->isValid('Hello'); // true
```
