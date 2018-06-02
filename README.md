[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]

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

```php
RobRogers3\LaravelExceptionHandler\ServiceProvider::class,
```

### Using it:

Option 1: Update your .env file by adding this line:

USE_JSON_EXCEPTION_HANDLER=true

This will use the JsonHandler for json requests and the Laravel Exception Handler for regular requests.

Note: it will completely ignore your app's Exception Handler. This means you can't override anything in this class.

Option 2: Update your App Handler class to extend the JsonAwareExceptionHandler

You do not have to update your .env file.

The benefit of this is you can overide how the JsonAwareExceptionHandler

To do this you  need to change your `App\Exceptions\Handler` class to extend `RobRogers3\LaravelExceptionHandler\JsonAwareExceptionHandler` rather than extending `Illuminate\Foundation\Exceptions\Handler`. Like so:


```php
<?php

use RobRogers3\LaravelExceptionHandler\JsonAwareExceptionHandler;

class Handler extends JsonAwareExceptionHandler
{
    
}
```

## Last Step

You need to run this artisan command:

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

Here's where you want to take advantage of this. 

Take a look at this handling of an ajax response error.


```javascript
	handle (error) {
	       
	    if (error.response.data) {
	    //the error message returned by the json response corresponds to the error.response.data property

	    //Usually it's a string
		 if (typeof error.response.data == 'string') {
		 
		     return alert(error.response.data);
		 }

		 //validation errors are an array
		 if (error.response.status == 422 && error.response.data.length) {
		     let errors = [];

			 error.response.data.forEach(datum => {
			     errors.push(datum);
			 });
		     
		     return alert(errors.join("\n"));
		 }

		 //used to handle a teapot message 418
		 //can be a random exception you throw as say MessagingException
		 
		 //you can tweek your teapot messages to have an extra 'message' property. Up to you.
		 //by default it doesn't 
		 if (error.response.status == 418 && error.response.data.message) {
		     return alert(error.response.data);
		 }
		 
	     }
	     return alert('We could not handle your request');
	}
    }
```


[ico-version]: https://img.shields.io/packagist/v/robrogers3/laravel-jsonaware-exception-handler.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/robrogers3/laravel-jsonaware-exception-handler/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/robrogers3/laraldap-auth.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/robrogers3/laraldap-auth.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/robrogers3/laravel-jsonaware-exception-handler.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/robrogers3/laravel-jsonaware-exception-handler
[link-travis]: https://travis-ci.org/robrogers3/laravel-jsonaware-exception-handler
[link-scrutinizer]: https://scrutinizer-ci.com/g/robrogers3/laradauth/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/robrogers3/laraldap-auth
[link-downloads]: https://packagist.org/packages/robrogers3/laravel-jsonaware-exception-handler
[link-author]: https://github.com/robrogers3
[link-contributors]: ../../contributors
