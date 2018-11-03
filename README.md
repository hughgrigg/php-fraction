# PHP Fraction

[![Build Status](https://travis-ci.org/hughgrigg/php-fraction.svg?branch=master)](https://travis-ci.org/hughgrigg/php-fraction)
[![Coverage Status](https://coveralls.io/repos/github/hughgrigg/php-fraction/badge.svg)](https://coveralls.io/github/hughgrigg/php-fraction)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/4fb0b395bf914b5a8abe589210b26bcb)](https://app.codacy.com/app/hugh_2/php-fraction?utm_source=github.com&utm_medium=referral&utm_content=hughgrigg/php-fraction&utm_campaign=badger)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/hughgrigg/php-fraction/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/hughgrigg/php-fraction/?branch=master)
[![StyleCI](https://styleci.io/repos/154997973/shield?branch=master)](https://styleci.io/repos/154997973)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

PHP fraction library with fraction simplification and float to fraction
conversion.

## Installation

Install via Composer:

```bash
composer require hughgrigg/php-fraction
```

## Usage

Import the fraction class:

```php
use Fraction\Fraction;
```

### Creating fractions

Create fractions with the numerator and denominator:

```php
$half = new Fraction(1, 2);
$third = new Fraction(1, 3);
$threeFifths = new Fraction(3, 5);
$oneAndAQuarter = new Fraction(5, 4);
```

### Simplifying fractions

Simplify fractions with the `simplified()` method:

```php
$fiveTenths = new Fraction(5, 10);
$simplified = $fiveTenths->simplified();
// = new Fraction(1, 2)
```

The fraction object is immutable, so the original instance is unchanged.

### Converting floats to fractions

Get a fraction from a float with the `FloatConversion` class:

```php
use Fraction\FloatConversion;

$half = (new FloatConversion(0.5))->fraction();
// = new Fraction(1, 2);
```

#### Float conversion precision

You might not want arbitrary precision when converting a float to a fraction.
For example, you might prefer that 0.249 is converted to 1/4, and not 249/1000.

You can do this by setting the precision on the float conversion. This sets the
tolerance to use when finding the closest fraction for the float:

```php
$almostAQuarter = (new FloatConversion(0.249))->withPrecision(0.1)->fraction();
// = new Fraction(1, 4);

$almostAQuarter->withPrecision(0.01)->fraction();
// = new Fraction(24, 100);

$almostAQuarter->withPrecision(0.001)->fraction();
// = new Fraction(249, 1000);
```

Again, the `FloatConversion` object is immutable, so the original instance is
unchanged when doing this.

The default precision is 0.001 (one thousandth).

### Converting fractions to floats

You can get the float equivalent of a fraction with the `asFloat()` method:

```php
$threeFifths = new Fraction(3, 5);
$threeFifths->asFloat();
// = 0.6

$oneThird = new Fraction(1, 3);
$oneThird->asFloat();
// = 0.33333333333333
```

### Converting fractions to percentages

You can get the percentage equivalent of a fraction with the `float()` method:

```php
$threeFifths = new Fraction(3, 5);
$threeFifths->asPercentage();
// = 60

$oneThird = new Fraction(1, 3);
$oneThird->asPercentage();
// = 33.333333333333
```

### Fraction operations

You can apply various arithmetic operations to fractions. Note that the results
are not simplified automatically, so you will need to use the `simplified()`
method at the end of your calculations to get the simplified form of the result.

#### Addition

```php
$half = new Fraction(1, 2);
$third = new Fraction(1, 3);
$sum = $half->add($third);
// = new Fraction(5, 6)

$tenth = new Fraction(1, 10);
$fifth = new Fraction(1, 5);
$sum = $tenth->add($fifth);
// = new Fraction(15,50)
$sum->simplified();
// = new Fraction(3, 10)
```

#### Subtraction

```php
$half = new Fraction(1, 2);
$third = new Fraction(1, 3);
$difference = $half->subtract($third);
// = new Fraction(1,6)

$fifth = new Fraction(1, 5);
$tenth = new Fraction(1, 10);
$difference = $fifth->subtract($tenth)
// = new Fraction(5, 50)
$difference->simplified();
// = new Fraction(1, 10)
```

#### Multiplication

```php
$half = new Fraction(1, 2);
$third = new Fraction(1, 3);
$product = $half->multiplyBy($third);
// = new Fraction(1,6)

$twoFifths = new Fraction(2, 5);
$tenth = new Fraction(1, 10);
$product = $twoFifths->multiplyBy($tenth)
// = new Fraction(2, 50)
$product->simplified();
// = new Fraction(1, 25)
```

#### Division

```php
$half = new Fraction(1, 2);
$third = new Fraction(1, 3);
$quotient = $half->divideBy($third);
// = new Fraction(3,2)

$twoFifths = new Fraction(2, 5);
$tenth = new Fraction(1, 10);
$product = $twoFifths->multiply($tenth)
// = new Fraction(2, 50)
$difference->simplified();
// = new Fraction(1, 25)
```

#### Comparison

You can check strict equality of fractions with the `equals()` method:

```php
$half = new Fraction(1, 2);
$threeSixths = new Fraction(3, 6);
$half->equals($threeSixths);
// = true

$twoSixths = new Fraction(2, 6);
$half->equals($twoSixths);
// = false
```

If you want to check with a loose precision, you can use the `equalsWithin()`
method, which takes the other fraction and the precision to compare in:

```php
$half = new Fraction(1, 2);
$threeEights = new Fraction(3, 8);
$half->equalsWithin($threeEights, 0.25);
// = true
```

### Fraction string conversion

The `__toString()` method on the `Fraction` class prints out the fraction using
a slash for the divider:

```php
$fraction = new Fraction(1, 3);
$useInString = "The fraction is {$fraction}";
// = 'The fraction is 1/3'

$fraction = new Fraction(8, 5);
$useInString = "The fraction is {$fraction}";
// = 'The fraction is 1 3/5'
```

#### String conversion with unicode fractions

Unicode provides some entities for representing fractions directly as a single
character. You can use these in string conversion with the `unicodeChars()` method:

```php
$fraction = new Fraction(1, 3);
$useInString = "The fraction is {$fraction->unicodeChars()}";
// = 'The fraction is ⅓'

$fraction = new Fraction(8, 5);
$useInString = "The fraction is {$fraction->unicodeChars()}";
// = 'The fraction is 1 ⅗'
```

There are not many of these fraction characters in Unicode. However, you can
go further and build any fraction you want using Unicode subscripts and
superscripts. These allow any arbitrary fraction, but are less likely to render
as expected in different situations.

To convert to a string with Unicode superscripts and subscripts, use the
`unicodeScripts()` method:

```php
$fraction = new Fraction(1, 6);
$useInString = "The fraction is {$fraction->unicodeScripts()}";
// = 'The fraction is ¹⁄₆'

$fraction = new Fraction(10, 6);
$useInString = "The fraction is {$fraction->unicodeChars()}";
// = 'The fraction is 1 ⁴⁄₆'
```
