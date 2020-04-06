# Laravel package for Zoom video conferencing

[![Latest Version on Packagist](https://img.shields.io/packagist/v/MinaWilliam/zoom-api.svg?style=flat-square)](https://packagist.org/packages/MinaWilliam/zoom-api)
[![Total Downloads](https://img.shields.io/packagist/dt/MinaWilliam/zoom-api.svg?style=flat-square)](https://packagist.org/packages/MinaWilliam/zoom-api)

Package to manage the Zoom API in Laravel

## Installation

You can install the package via composer:

```bash
composer require minawilliam/zoom-api
```

The service provider should automatically register for For Laravel > 5.4.

For Laravel < 5.5, open config/app.php and, within the providers array, append:

``` php
MinaWilliam\Zoom\Providers\ZoomServiceProvider::class
```

## Configuration file

Publish the configuration file

```bash
php artisan vendor:publish --provider="MinaWilliam\Zoom\Providers\ZoomServiceProvider"
```

This will create a zoom/config.php within your config directory, where you add value for api_key and api_secret.

## Usage

To get a list of meetings

``` php
	$zoom = new \MinaWilliam\Zoom\Zoom();
	$meetings = $zoom->users->find('test@domain.com')->meetings()->all();
```

## Find all

The find all function returns a Laravel Collection so you can use all the Laravel Collection magic

``` php
	$zoom = new \MinaWilliam\Zoom\Zoom();
	$users = $zoom->users->all();
```

## Creating Items

We can create and update records using the save function, below is the full save script for a creation.

``` php
	$user = $zoom->user->create([
        'name' => 'Test Name',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'test@test.com',
        'password' => 'secret',
        'type' => 1
    ]);
```

### RESOURCES

We cover the main resources

```
Meetings
Panelists
Registrants
Users
Webinars
```

We aim to add additional resources/sub-resources over time

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email colin@macsi.co.uk instead of using the issue tracker.

## Credits

- [Colin Hall](https://github.com/MinaWilliam)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
