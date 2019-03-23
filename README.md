# eclipxe13/enum

[![Source Code][badge-source]][source]
[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![Build Status][badge-build]][build]
[![Scrutinizer][badge-quality]][quality]
[![Coverage Status][badge-coverage]][coverage]
[![Total Downloads][badge-downloads]][downloads]
[![SensioLabsInsight][badge-sensiolabs]][sensiolabs]

> Enum based on the Brent Roose enum idea https://stitcher.io/blog/php-enums

After reading the article [PHP Enums from Brent Roose](https://stitcher.io/blog/php-enums) and review
the implementation made on [spatie/enum](https://github.com/spatie/enum) I think that it was overloaded
of my expectations. Maybe spatie/enum version 1.0 was more close to what I needed.

So, I created this implementation of the same concept.

## Installation

Use [composer](https://getcomposer.org/), so please run
```shell
composer require eclipxe/enum
```


## Basic usage

Enums in other languages are `TEXT` for code, `INTEGER` for values. Even SPL Enum does it in this way.
On the other hand, in this library we have the basic `StringEnum`, the value is the name of the method as
it was declared on docblock. Also we have `IntEnum` that behaves more like common enums.

The enums only show one valiable `value` to the outside scope.
You can access its content using `$status->value()`.

The value's type depends on the base class `StringEnum` and `IntEnum`.

### StringEnum example

```php
<?php
/**
 * This is a common use case enum sample
 *
 * @method static self draft()
 * @method static self review()
 * @method static self archive()
 *
 * @method bool isDraft()
 * @method bool isReview()
 * @method bool isArchive()
 */
final class DocumentStatus extends Eclipxe\Enum\StringEnum
{
}
```

#### Case insensivity for names and values

*names* and *values* (when) are strings are used as case-insensitive.
*names* because in PHP methods are base-insensitive (for *names*).
*values* come from databases or user inputs and is better to have case-insensivity.

So, when you declare a `StringEnum` member as `* @method static self Pending()` you are declaring an entry
that will always have the value `Pending` but you can create it as case-insensitive.

#### Creation of instances

You can create new instances from values using constructors:

```php
<?php
use Eclipxe\Enum\Tests\Enums\DocumentStatus;
use Eclipxe\Enum\Tests\Enums\WeekDays;

$status = new DocumentStatus('DRAFT');
echo $status; // 'draft' as defined in method name 

$day = new WeekDays(7);
echo $day; // '7' as value overriden and cast to string by __toString()
```

You can create new instances from names using defined static methods:

```php
<?php
use Eclipxe\Enum\Tests\Enums\WeekDays;
$day = WeekDays::monday();
echo $day; // '1'  as value overriden and cast to string by __toString()
```

You can create new instances from names using specfic creational method:

```php
<?php
use Eclipxe\Enum\Tests\Enums\BasicColors;
$color = BasicColors::createFromName('RED');
echo $color->value(); // '1'  as value overriden and cast to string by __toString()
```

### Check if instance is of certain type

Use the methods `is<name>()` to compare to specific value.

```php
<?php
use Eclipxe\Enum\Tests\Enums\DocumentStatus;
$status = DocumentStatus::draft();
$status->isDraft();  // true
$status->isReview();  // false
```

Or use weak comparison `$statusOne == $statusTwo`.

### Overriding values

The only pattern for override values is overriding the method `overrideValueForName(string $name)`.

The parameter `$name` is the found name of the method in upper case.

If `overrideValueForName`returns `null` will use the *default value*,
if set will use exactly that value.

You cannot override values in your extended clases, only the entries defined on you latest class.

If you mess up with values, like giving the same value to two different entries, is your fault.
I have no plans to introduce checks for this, but I'm open to contributions.

In the following example, the value of `monday` is overriden, so the following found methods will
be the maximum value plus one, resulting on `monday => 1, tuesday => 2, ... sunday => 7`

```php
<?php

/**
 * @method static self monday()
 * @method static self tuesday()
 * @method static self wednesday()
 * @method static self thursday()
 * @method static self friday()
 * @method static self saturday()
 * @method static self sunday()
 */
final class WeekDays extends \Eclipxe\Enum\IntEnum
{
    protected static function overrideValueForName(string $name): ?int
    {
        $map = [
            'MONDAY' => 1,
        ];
        return $map[$name] ?? null;
    }
}
```

### Extending

### Notes

- I recommend you to declare your classes final.
- If extending, you cannot override values of previous classes.
- You can compare equality on object instance.
- Never compare identity on object instance, compare identity on value.


### Differences from spatie/enum

Well, both are based on the same idea, but they are completely different.

Differences         | spatie/enum                       | eclipxe/enum
---                 | ---                               | ---
Creational pattern  | construct by value or name        | construct only by value, create by name on specific method 
Comparisons         | case-insensitive for method calls | strict but case-insensitive
Exposed information | many                              | only value
Internals           | extending Enum                    | using trait
Declarations        | declare in docblock and methods   | only docblocks allowed

... and many others

## PHP Support

This library is compatible with at least the oldest [PHP Supported Version](http://php.net/supported-versions.php)
with active support. Please, try to use the full potential of the language.


## Contributing

Contributions are welcome! Please read [CONTRIBUTING][] for details
and don't forget to take a look in the [TODO][] and [CHANGELOG][] files.


## Copyright and License

The eclipxe13/enum library is copyright © [Carlos C Soto](http://eclipxe.com.mx/)
and licensed for use under the MIT License (MIT). Please see [LICENSE][] for more information.


[contributing]: https://github.com/eclipxe13/enum/blob/master/CONTRIBUTING.md
[changelog]: https://github.com/eclipxe13/enum/blob/master/docs/CHANGELOG.md
[todo]: https://github.com/eclipxe13/enum/blob/master/docs/TODO.md

[source]: https://github.com/eclipxe13/enum
[release]: https://github.com/eclipxe13/enum/releases
[license]: https://github.com/eclipxe13/enum/blob/master/LICENSE
[build]: https://travis-ci.org/eclipxe13/enum?branch=master
[quality]: https://scrutinizer-ci.com/g/eclipxe13/enum/
[sensiolabs]: https://insight.sensiolabs.com/projects/:INSIGHT_UUID
[coverage]: https://scrutinizer-ci.com/g/eclipxe13/enum/code-structure/master/code-coverage
[downloads]: https://packagist.org/packages/eclipxe/enum

[badge-source]: http://img.shields.io/badge/source-eclipxe13/enum-blue.svg?style=flat-square
[badge-release]: https://img.shields.io/github/release/eclipxe13/enum.svg?style=flat-square
[badge-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[badge-build]: https://img.shields.io/travis/eclipxe13/enum/master.svg?style=flat-square
[badge-quality]: https://img.shields.io/scrutinizer/g/eclipxe13/enum/master.svg?style=flat-square
[badge-sensiolabs]: https://insight.sensiolabs.com/projects/:INSIGHT_UUID/mini.png
[badge-coverage]: https://img.shields.io/scrutinizer/coverage/g/eclipxe13/enum/master.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/eclipxe/enum.svg?style=flat-square
