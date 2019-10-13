# Laravel World Database

This package focused on World Countries, Regions, and Cities database with locale support for Laravel.

Note: This package is originally forked from https://github.com/khsing/laravel-world/

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

## Setup

- `composer require`

```php
composer require sitehandy/laravel-world
```

- Add Service Provider into `config/app.php`

```php
'providers' => [
    // ...
    Sitehandy\World\WorldServiceProvider::class,
]
```

- Publish

```php
php artisan vendor:publish --force --provider="Sitehandy\World\WorldServiceProvider"
composer dump-autoload
```
The above process will copy seeder files to database/seeds

- Init (Run Seeder)

```php
php artisan db:seed --class=WorldTableSeeder
```

## Usage

- get all Continent

```php
use Sitehandy\World\World;

World::Continents()

```

- get all Countries

```php
use Sitehandy\World\World;

World::Countries()
```


- get all Countries

```php
use Sitehandy\World\Models\Country;

Country::all()
```


- get country/city/division by code

```php
use Sitehandy\World\World;

World::getByCode('cn'); // iso-3166 alpha 2 code
World::getByCode('chn'); // iso-3166 alpha 3 code
World::getByCode('cn-11'); // Beijing
```

- get countries belong to a continent

```php
use Sitehandy\World\Models\Continent;

$asia = Continent::getByCode('AS');
$countries = $asia->countries()->get();
// or use children method
$countries = $asia->children();
```

- get continent or parent

```php
$china = Country::getByCode('cn');
$asia = $china->parent();
```

- get division/state/province via Conutry

```php
$china = Country::getByCode('cn');
$provinces = $china->divisions()->get()
// or use children method
$provinces = $china->children();
```

- get cities via Country or Division.

```php
$china = Country::getByCode('cn');
// check has_division to determine next level is division or city.
$china->has_division; // true, otherwise is false
$regsions = $china->children();
```

## Contributions

If you want contribute to this library, issue and pr are welcome.


## Thanks
- [khsing/laravel-world](https://github.com/khsing/laravel-world)
- [moolighty/geo](https://github.com/moolighty/geo)
- [mledoze/countries](https://github.com/mledoze/countries)
- [cn/GB2260](https://github.com/cn/GB2260)

## About

This package published under MIT license. If you have any question or suggestion, please feel free to submit a issue.

All the best!.
