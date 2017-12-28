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

Will return a [Production](src/Production.php) object.

```php
$production = $otix->getSeriesProduction( 1111 );
```

### Get Production Performances

Will return array of [Performances](src/Performance.php) from a [Production](src/Production.php).

```php
$performances = $production->getPerformances();
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

## Roadmap

- [x] Implement basic HTTP layer for requests
- [x] Implement basic [OvationTix](src/OvationTix.php) class
- [x] Implement [Production](src/Production.php) class
- [x] Implement [Performance](src/Performance.php) class
- [ ] add `getUpcommingPerformances` method to [OvationTix](src/OvationTix.php)
- [ ] add `getPerformancesCalendar` method to [OvationTix](src/OvationTix.php)
- [ ] Implement Venue class, update the Production class with it


## Resources

- [OvationTix REST API](https://api.ovationtix.com/public/)