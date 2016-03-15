#  PHP Google Suggest
[![Latest Stable Version](https://poser.pugx.org/euclid1990/php-google-suggest/version)](https://packagist.org/packages/euclid1990/php-google-suggest)
[![Total Downloads](https://poser.pugx.org/euclid1990/php-google-suggest/downloads)](https://packagist.org/packages/euclid1990/php-google-suggest)
[![License](https://poser.pugx.org/euclid1990/php-google-suggest/license)](https://packagist.org/packages/euclid1990/php-google-suggest)

PHP Google suggest keyword tool. Google suggest search result.

## Installation

[PHP](https://php.net) 5.4 is required.

The PHP Google Suggest Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the
`euclid1990/php-google-suggest` package in your
project's `composer.json`.

```json
{
    "require": {
        "euclid1990/php-google-suggest": "~1.0"
    },
    "minimum-stability": "stable"
}
```

or

Require this package with composer:
```
composer require euclid1990/php-google-suggest
```

Update your packages with ```composer update``` or install with ```composer install```.

## Setup

#### Commmon

Add boostrap autoload file:
```php
require_once __DIR__ . '/../vendor/autoload.php';

use euclid1990\PhpGoogleSuggest\GoogleSuggest;
```

#### For Laravel

To use the Google Suggest Service, you must register the provider when bootstrapping your Laravel application. There are essentially two ways to do this.

Find the `providers` key in `config/app.php` and register the Google Suggest Service Provider.

```php
    'providers' => [
        // ...
        'euclid1990\PhpGoogleSuggest\Providers\GoogleSuggestServiceProvider',
    ]
```
for Laravel 5.1+
```php
    'providers' => [
        // ...
        euclid1990\PhpGoogleSuggest\Providers\GoogleSuggestServiceProvider::class,
    ]
```

Find the `aliases` key in `config/app.php`.

```php
    'aliases' => [
        // ...
        'GoogleSuggest' => 'euclid1990\PhpGoogleSuggest\Facades\GoogleSuggest',
    ]
```
for Laravel 5.1+
```php
    'aliases' => [
        // ...
        'GoogleSuggest' => euclid1990\PhpGoogleSuggest\Facades\GoogleSuggest::class,
    ]
```

## Usage

#### 1. Common PHP:

Please refer to [demo/run.php](https://github.com/euclid1990/php-google-suggest/blob/master/demo/run.php) or you can execute this command line:
```
# php demo/run.php
```

```php
require_once __DIR__ . '/../vendor/autoload.php';

use euclid1990\PhpGoogleSuggest\GoogleSuggest;

$configArr = require __DIR__.'/../config/google_suggest.php';
$config = ['google_suggest' => $configArr];
$googleSuggest = new GoogleSuggest(new Illuminate\Config\Repository($config));

$english = 'Google';
$result = $googleSuggest->search($english, $configArr['language']);
echo "Search results for English keyword.\n";
print_r($result);

$japanese = 'あいうえお';
$result = $googleSuggest->search($japanese, $configArr['language']);
echo "Search results for Japanese keyword.\n";
print_r($result);

$vietnamese = 'tìm';
$result = $googleSuggest->search($vietnamese, $configArr['language']);
echo "Search results for Vietnamese keyword.\n";
print_r($result);
```

Result:

![Preview](https://raw.githubusercontent.com/euclid1990/php-google-suggest/master/demo/preview.png)

#### 2. For Laravel

```php
$keyword = 'suggest';
// Class method
\GoogleSuggest::search($keyword);
// Helper
google_suggest($keyword);
```

## Reference

[Packagist](https://packagist.org/packages/euclid1990/php-google-suggest)