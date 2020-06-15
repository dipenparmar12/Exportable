# Export table records in csv files

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dipenparmar12/exportable.svg?style=flat-square)](https://packagist.org/packages/dipenparmar12/exportable)
[![Build Status](https://img.shields.io/travis/dipenparmar12/exportable/master.svg?style=flat-square)](https://travis-ci.org/dipenparmar12/exportable)
[![Quality Score](https://img.shields.io/scrutinizer/g/dipenparmar12/exportable.svg?style=flat-square)](https://scrutinizer-ci.com/g/dipenparmar12/exportable)
[![Total Downloads](https://img.shields.io/packagist/dt/dipenparmar12/exportable.svg?style=flat-square)](https://packagist.org/packages/dipenparmar12/exportable)

A Laravel package for hassle free generate CSV,JSON files from Eloquent model,Collection Array, You can Import/Export Data from just one command.

## Installation

You can install the package via composer:

```bash
composer require dipenparmar12/exportable
```

## Usage

Syntax

> `php artisan csv:export <table_name1> <table_name2> <table_name...>`

Example

> `php artisan csv:export Users Posts Jobs`

To Export all tables

> `php artisan csv:export tables --all`

### Features log

Dump

-   [x] Export table data in Csv file
-   [ ] Export table data in Json file

Import

-   [ ] Import table data in Csv file
-   [ ] Import table data in Json file

Conversions

-   [ ] Json to Csv
-   [ ] Csv to Json

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email dipenparmar12@gmail.com instead of using the issue tracker.

## Credits

-   [Dipen Parmar](https://github.com/dipenparmar12)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
