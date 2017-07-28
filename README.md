[![Latest Stable Version](https://img.shields.io/packagist/v/robrogers3/laravel-json-aware-exception-handler.svg?style=flat-square)](https://packagist.org/packages/robrogers3/laravel-json-aware-exception-handler)
[![License](https://img.shields.io/dub/l/vibe-d.svg?style=flat-square)](license.md)
[![Downloads](https://img.shields.io/packagist/dt/robrogers3/laravel-json-aware-exception-handler.svg?style=flat-square)](https://packagist.org/packages/robrogers3/laravel-json-aware-exception-handler)
[![Build Status](https://api.travis-ci.org/robrogers3/laravel-jsonaware-exception-handler.svg?branch=master)](https://travis-ci.org/robrogers3/laravel-jsonaware-exception-handler)


# Laravel Json Aware Exception Handler

Every one likes cool error message pages. Github has an awesome 404.

And it's very easy to create your own custom error pages for html responses.

But doing this for Ajax and Json responses meant either doing something generic or figuring out your own solution.
Often something like returning an error message like  'Sorry we cant handle your request'. Nothing informative.

This package solves this problem.

Once it's installed. Tune your error messages for over a dozen possible error codes.
You can even add more. Just create a ZizzZazzException assign a status code to it, and a custom message. Done!

## Installation

Install Laravel Json Aware Exception Handler with Composer.

```bash
$ composer require robrogers3/laravel-json-aware-exception-handler
```

## Configuration 

Add the service provider in your `config/app.php` :

```php
RobRogers3\LaravelExceptionHandler\ServiceProvider::class,
```

You then need to change your `App\Exceptions\Handler` class to extend `RobRogers3\LaravelExceptionHandler\JsonAwareExceptionHandler` rather than extending `Illuminate\Foundation\Exceptions\Handler`. e.g.

```php
<?php

use RobRogers3\LaravelExceptionHandler\JsonAwareExceptionHandler;

class Handler extends JsonAwareExceptionHandler
{

```

Then you need to run the artisan command:

```bash
$ artisan vendor:publish
```
This will copy the exception messages to your local lang directory.

## Optional Setup.

Open the exceptionmessages.php and change the messages you want to show for different http status codes.

You may want to change 401 to something more clever or more corporate. It's up to you.

## Usage

### Server Side Usage

There really is only one thing to use: Taking advantage of the MessagingException::class

Throwing this with a custom message allows you to display something detailed or specific to the situtation.

### Client Side Usage with Ajax

Here's where you want to take advantage of this. Take a look at this handling an ajax response error.

Here's a general error handler for axios.

```javascript
	handle (error) {
	       
	    if (error.response.data) {
	    //the error message returned by the json response corresponds to the error.response.data property

	    //Usually it's a string
		 if (typeof error.response.data == 'string') {
		 
		     return flash(error.response.data, 'danger');
		 }

		 //validation errors are an array
		 if (error.response.status == 422 && error.response.data.length) {
		     let errors = [];

			 error.response.data.forEach(datum => {
			     errors.push(datum);
			 });
		     
		     return flash(errors.join("\n"), 'danger');
		 }

		 //used to handle a teapot message 418
		 //can be a random exception you throw as say MessagingException
		 
		 //you can tweek your teapot messages to have an extra 'message' property. Up to you.
		 //by default it doesn't 
		 if (error.response.status == 418 && error.response.data.message) {
		     return flash(error.response.data, 'danger');
		 }
		 
	     }
	     return flash('We could not handle your request','danger');
	}
    }
```
