# Sitehandy Laravel World Database

[![Latest Stable Version](https://poser.pugx.org/sitehandy/laravel-world/v/stable)](https://packagist.org/packages/sitehandy/laravel-world)
[![License](https://poser.pugx.org/sitehandy/laravel-world/license)](https://packagist.org/packages/sitehandy/laravel-world)
[![Laravel](https://img.shields.io/badge/Laravel-9%2B-orange.svg)](https://laravel.com)

This package provides World Countries, Regions, and Cities database with locale support for Laravel 9-12.

## Credits

This package is a fork of the excellent [khsing/world](https://github.com/khsing/world) package by [Guixing Bai](https://github.com/khsing). We extend our gratitude to the original author for creating this valuable resource.

### What's Changed in This Fork

- **Updated namespace**: Changed from `Khsing\World` to `Sitehandy\World`
- **Laravel 9-12 compatibility**: Full support with modern Laravel syntax
- **PHP 8.1+ support**: Updated to support modern PHP versions
- **Database modernization**: 
  - Updated all migrations to use `Schema::dropIfExists()` instead of deprecated `Schema::drop()`
  - Modernized primary key definitions using `id()` method
  - Enhanced foreign key constraint handling
- **Code quality improvements**: All deprecated Laravel features updated
- **Package optimization**: Configured for professional Packagist publishing
- **Maintained by**: Sitehandy Solutions
- **Semantic versioning**: Starting from version 1.0.0

## Version

Current version: **1.0.0**

We follow [Semantic Versioning](https://semver.org/) for all releases:
- **Major** (1.x.x): Breaking changes
- **Minor** (x.1.x): New features, backward compatible
- **Patch** (x.x.1): Bug fixes, backward compatible

## Conceptions

There are 5 main objects in this package.

- World: the earth world.
- Continent: 7 continent
- Country: 248 countries
- Division: Divisions such as state/province.
- City: the last level of region, some cities up to Country, some up to Division.

### Attributes

Common attributes:

- `name`: Common name of region(english).
- `full_name`: Full name or official name(english).
- `code`: ISO-3166-1-alpha2/ISO-3166-2 code
- `local_name`: translation of Common name
- `local_full_name`: translation of full name
- `local_alias`: alias in different language
- `local_abbr`: Abbreviation

Country spec attributes:

- `emoji`: Emoji flag of country
- `capital`: Captial of this country
- `code_alpha3`: Code of ISO-3166-1-alpha3
- `currency_code`: ISO-4177 Currency Code, e.g. USD, CNY
- `currency_name`: ISO-4177 Currency Name,
- `local_currency_name`: ISO-4177 Currency name in locale

Example:

```php
use Sitehandy\World\World;
$china = World::getByCode('cn');
$china->setLocale('zh-cn');
$china->name; // China
$china->local_name; // 中国
$china->full_name; // People's Republic of China
$china->local_full_name; // 中华人民共和国
$china->emoji; // 🇨🇳
$china->callingcode; // 86
$china->code; // CN
$china->code_alpha3; // CHN
$china->has_division; // true
$china->currency_code; // CNY
$china->currency_name; // Yuan Renminbi
$china->local_currency_name; // 人民币
```

### Localization

Right now, only English(default and fallback) and Chinese-Simp `zh-cn` are supported. Locale settings is following Laravel project settings in `config/app.php`.

## Requirements

- **PHP**: 8.1 or higher (required for Laravel 11+ compatibility)
- **Laravel**: 9.0 or higher
  - ✅ Laravel 9.x - Full support
  - ✅ Laravel 10.x - Full support  
  - ✅ Laravel 11.x - Full support
  - ✅ Laravel 12.x - Full support
- **Database**: MySQL 5.7+, PostgreSQL 10+, SQLite 3.8+, SQL Server 2017+

## Installation

### Step 1: Install via Composer

```bash
composer require sitehandy/laravel-world
```

### Step 2: Service Provider (Laravel < 5.5 only)

For Laravel 5.5+, the service provider is automatically registered via package discovery.

For older versions, add to `config/app.php`:

```php
'providers' => [
    // ...
    Sitehandy\World\WorldServiceProvider::class,
]
```

### Step 3: Publish and Initialize

```bash
php artisan vendor:publish --force --provider="Sitehandy\World\WorldServiceProvider"
composer dump-autoload
php artisan world:init
```

**Note**: The `world:init` command will create the necessary database tables and seed them with world data. This may take a few minutes to complete.

## Technical Improvements

This package has been thoroughly modernized for Laravel 9-12 compatibility:

### Database Migrations & Seeders
- ✅ **Modern Schema Methods**: All migrations updated to use `Schema::dropIfExists()` instead of deprecated `Schema::drop()`
- ✅ **Primary Key Modernization**: Updated from `bigIncrements()` to modern `id()` method
- ✅ **Foreign Key Optimization**: Enhanced foreign key constraint handling for better performance
- ✅ **Cross-Database Compatibility**: Tested with MySQL, PostgreSQL, SQLite, and SQL Server
- ✅ **Strict Type Declarations**: Added `declare(strict_types=1)` to all migration and seeder files
- ✅ **Return Type Hints**: All migration and seeder methods now have proper `: void` return types
- ✅ **Modern Import Statements**: Updated seeders to use `use Illuminate\Support\Facades\DB;` instead of `\DB::`
- ✅ **Consistent Code Formatting**: Standardized bracket styles and spacing across all database files
- ✅ **Professional Documentation**: Added comprehensive DocBlocks to all migration and seeder classes
- ✅ **Laravel 12 Compliance**: All database files follow the latest Laravel 12 best practices and conventions

### Code Quality & Best Practices
- ✅ **Namespace Consistency**: Complete migration from `Khsing\World` to `Sitehandy\World`
- ✅ **Laravel Standards**: All deprecated features updated to current Laravel standards
- ✅ **PHP 8.1+ Features**: Leveraging modern PHP capabilities for better performance
- ✅ **Package Optimization**: Configured for professional Packagist publishing standards
- ✅ **Strict Type Declarations**: Added `declare(strict_types=1)` to all PHP files
- ✅ **Modern Return Types**: All methods now have proper return type declarations
- ✅ **PSR-4 Autoloading**: Full compliance with PSR-4 autoloading standards
- ✅ **Typed Properties**: Modern PHP 8.1+ typed properties implementation
- ✅ **Null Coalescing**: Leveraging null coalescing operators for cleaner code
- ✅ **Union Types**: Using PHP 8.0+ union types where appropriate
- ✅ **Arrow Functions**: Modern arrow function syntax for improved readability
- ✅ **Comprehensive DocBlocks**: Professional documentation for all classes and methods
- ✅ **Laravel Eloquent Best Practices**: Proper relationship type hints and return types
- ✅ **Error Handling**: Improved exception handling with typed exceptions
- ✅ **Code Organization**: Clean separation of concerns and single responsibility principle

### Compatibility Testing
- ✅ **Laravel 9.x**: Full compatibility verified
- ✅ **Laravel 10.x**: Full compatibility verified
- ✅ **Laravel 11.x**: Full compatibility verified
- ✅ **Laravel 12.x**: Full compatibility verified
- ✅ **PHP 8.1-8.3**: Tested across all supported PHP versions

## Usage

### Basic Usage Examples

#### Get all Continents

```php
use Sitehandy\World\World;

$continents = World::Continents();
```

#### Get all Countries

```php
use Sitehandy\World\World;

$countries = World::Countries();
```

#### Get Country/City/Division by Code

```php
use Sitehandy\World\World;

$china = World::getByCode('cn');     // ISO-3166 alpha 2 code
$china = World::getByCode('chn');    // ISO-3166 alpha 3 code
$beijing = World::getByCode('cn-11'); // Beijing
```

#### Get Countries by Continent

```php
use Sitehandy\World\Models\Continent;

$asia = Continent::getByCode('AS');
$countries = $asia->countries()->get();
// or use children method
$countries = $asia->children();
```

#### Get Parent (Continent/Country)

```php
use Sitehandy\World\Models\Country;

$china = Country::getByCode('cn');
$asia = $china->parent(); // Returns the continent
```

#### Get Divisions/States/Provinces

```php
use Sitehandy\World\Models\Country;

$china = Country::getByCode('cn');
$provinces = $china->divisions()->get();
// or use children method
$provinces = $china->children();
```

#### Get Cities

```php
use Sitehandy\World\Models\Country;

$china = Country::getByCode('cn');
// Check has_division to determine if next level is division or city
if ($china->has_division) {
    $regions = $china->children(); // Returns divisions/provinces
} else {
    $cities = $china->children(); // Returns cities directly
}
```

## Contributions

If you want contribute to this library, issue and pr are welcome. please following those steps.

1. start a new laravel project and install this library.
2. install [orangehill/iseed](https://github.com/orangehill/iseed).
3. modify datas via sql.
4. generate seeds via `artisan iseed world_cities,world_cities_locale,world_continents,world_continents_locale,world_countries,world_countries_locale,world_divisions,world_divisions_locale`
5. replace `delete()` with `truncate()`, `cd database/seeders/ && sed -i 's/->delete()/->truncate()/g' World*.php`
6. copy seeds files into library.
7. commit your work. ;)

## TODO

- change the way to seed data, eg. loading data from json?
- add front-end support
- find a way to update dataset

## Data Sources

- [ISO 639-1 Standard Language Codes](https://www.knowledgebase-script.com/kb/article/iso-639-1-standard-language-codes-255.html): language codes
- [ISO 639-1 standard language codes](https://www.andiamo.co.uk/resources/iso-language-codes/): language codes
- [United Nations Statistics Division: Standard country or area codes for statistical use (M49)](https://unstats.un.org/unsd/methodology/m49/overview/): ISO-3166-alpha3 code and country list.
- [ISO 3166-2](https://en.wikipedia.org/wiki/ISO_3166-2): main data source

## Thanks

- [moolighty/geo](https://github.com/moolighty/geo)
- [mledoze/countries](https://github.com/mledoze/countries)
- [cn/GB2260](https://github.com/cn/GB2260)

## Changelog

### Version 1.0.0 (2025-08-16)
- **Initial release** of sitehandy/laravel-world package
- **Breaking change**: Namespace changed from `Khsing\World` to `Sitehandy\World`
- **Added**: Full Laravel 9-12 compatibility with modern syntax
- **Added**: PHP 8.1+ support with strict type requirements
- **Updated**: Database migrations to use modern Laravel syntax
  - Replaced deprecated `Schema::drop()` with `Schema::dropIfExists()`
  - Updated `increments()` method to modern `id()` method
  - All foreign key constraints modernized
- **Enhanced**: Package configuration optimized for Packagist publishing
- **Improved**: All deprecated Laravel features updated to current standards
- **Modernized**: Complete code quality overhaul following Laravel best practices
  - Added strict type declarations (`declare(strict_types=1)`) to all PHP files
  - Implemented proper return type hints for all methods
  - Added comprehensive PHPDoc blocks with parameter and return types
  - Leveraged modern PHP 8.1+ features (typed properties, union types, null coalescing)
  - Applied Laravel Eloquent best practices with proper relationship type hints
  - Improved error handling with typed exceptions
  - Enhanced code organization following single responsibility principle
- **Database Modernization**: Complete overhaul of all migration and seeder files
  - Updated all migrations to use modern Laravel 12 syntax and conventions
  - Replaced deprecated methods with current Laravel standards
  - Added strict typing and return type declarations to all database files
  - Improved import statements and code formatting consistency
  - Enhanced documentation with professional DocBlocks
- **Verified**: Complete compatibility testing across Laravel 9, 10, 11, and 12
- **Maintained**: All original functionality from khsing/world with enhanced reliability and performance

## Contributing

We welcome contributions! Please feel free to submit issues and pull requests.

### Development Setup

If you want to contribute to this library, issues and PRs are welcome. Please follow these steps:

1. Start a new Laravel project and install this library
2. Install [orangehill/iseed](https://github.com/orangehill/iseed)
3. Modify data via SQL
4. Generate seeds via `artisan iseed world_cities,world_cities_locale,world_continents,world_continents_locale,world_countries,world_countries_locale,world_divisions,world_divisions_locale`
5. Replace `delete()` with `truncate()`: `cd database/seeders/ && sed -i 's/->delete()/->truncate()/g' World*.php`
6. Copy seed files into the library
7. Commit your work

## License

This package is published under the MIT license.

## Support

If you have any questions or suggestions, please feel free to:
- Submit an issue on GitHub
- Email us at support@sitehandy.com

## About Sitehandy Solutions

Sitehandy Solutions is committed to maintaining and improving this package. We appreciate the original work by Guixing Bai and the community.

Have a nice day! 🌍
