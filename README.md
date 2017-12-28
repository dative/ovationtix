# OvationTix API

Provides easy-to-use interface to work with OvationTix API

## Requirements

PHP 7.0 and later.

## Composer

You can install the bindings via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require dative/ovationtix
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Getting Started

Create a instance by passing the OvationTix client id.

```php
$otix = new OvationTix(284);
```

## Usage

### Get Series

Will return array of [Productions](src/Production.php).

```php
$series = $otix->getSeries();
```

### Get Production

Will return a **Productions** object

```php
$production = $otix->getSeriesProduction( 1111 );
```

## Development

Install dependencies:

``` bash
composer install
```

## Tests

Install dependencies as mentioned above (which will resolve [PHPUnit](http://packagist.org/packages/phpunit/phpunit)), then you can run the test suite:

```bash
./vendor/bin/phpunit
```

Or to run an individual test file:

```bash
./vendor/bin/phpunit tests/UtilTest.php
```

## Resources

- [OvationTix REST API](https://api.ovationtix.com/public/)