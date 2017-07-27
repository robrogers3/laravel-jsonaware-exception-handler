[![Latest Stable Version](https://img.shields.io/packagist/v/robrogers3/laravel-json-aware-exception-handler.svg?style=flat-square)](https://packagist.org/packages/robrogers3/laravel-json-aware-exception-handler) [![License](https://img.shields.io/dub/l/vibe-d.svg?style=flat-square)](license.md) [![Downloads](https://img.shields.io/packagist/dt/robrogers3/laravel-json-aware-exception-handler.svg?style=flat-square)](https://packagist.org/packages/robrogers3/laravel-json-aware-exception-handler)

# Laravel Json Aware Exception Handler

## Installation

To get the latest version of Laravel Error Handler, simply require the project using Composer:

```bash
$ composer require robrogers3/laravel-json-aware-exception-handler
```

## Configuration 

Add the service provider in your `config/app.php` :

```php
...
RobRogers3\LaravelExceptionHandler\ServiceProvider::class,
...
```

You then need to change your `App\Exceptions\Handler` class to extend `RobRogers3\LaravelExceptionHandler\JsonAwareExceptionHandler` rather than extending `Illuminate\Foundation\Exceptions\Handler`.


## Usage
