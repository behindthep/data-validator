### Hexlet tests and linter status:
[![Actions Status](https://github.com/behindthep/php-oop-project-60/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/behindthep/php-oop-project-60/actions)

Валидатор данных – библиотека, проверять корректность любых данных. программы работают с внешними данными, которые нужно проверять на корректность. данные форм заполняемых пользователями.

```php
// строки
$schema = $v->required()->string();

$schema->isValid('what does the fox say'); // true
$schema->isValid(''); // false

// числа
$schema = $v->required()->number()->positive();

$schema->isValid(-10); // false
$schema->isValid(10); // true

// массив с поддержкой проверки структуры
$schema = $v->array()->sizeof(2)->shape([
    'name' => $v->string()->required(),
    'age' => $v->number()->positive(),
]);

$schema->isValid(['name' => 'kolya', 'age' => 100]); // true
$schema->isValid(['name' => '', 'age' => null]); // false

// Добавление нового валидатора
$fn = fn($value, $start) => str_starts_with($value, $start);
$v->addValidator('string', 'startWith', $fn);

$schema = $v->string()->test('startWith', 'H');

$schema->isValid('exlet'); // false
$schema->isValid('Hexlet'); // true
```
