
# Laravel package for Zoom video conferencing

[![Latest Version on Packagist](https://img.shields.io/packagist/v/MinaWilliam/zoom-api.svg?style=flat-square)](https://packagist.org/packages/MinaWilliam/zoom-api)
[![Total Downloads](https://img.shields.io/packagist/dt/MinaWilliam/zoom-api.svg?style=flat-square)](https://packagist.org/packages/MinaWilliam/zoom-api)

Package to manage the Zoom API in Laravel

## Installation

You can install the package via composer:

```bash
composer require minawilliam/zoom-api
```

The service provider should automatically register for Laravel > 5.4.

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

To get a list of user meetings or webinars

``` php
	$zoom = new \MinaWilliam\Zoom\Zoom();
	$meetings = $zoom->meetings->list('zoomUserId');
    $webinars = $zoom->webinars->list('zoomUserId');
```

## Find all

To get a list of all users

``` php
	$zoom = new \MinaWilliam\Zoom\Zoom();
	$users = $zoom->users->list();
```

## Creating Items

We can a user by passing an array of user details 

``` php
	$user = $zoom->users->create([
        'name' => 'Test Name',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'test@test.com',
        'password' => 'secret',
        'type' => 1
    ]);
    
    $webinar = $zoom->webinars->create('zoomUserId', [
        'topic' => 'string',
        'agenda' => 'string',
        'type' => 'integer', // 5 - Webinar, 6 - Recurring webinar with no fixed time, 9 - Recurring webinar with a fixed time.
        'start_time' => $start_at->toDateTimeLocalString(), // Webinar start time in GMT/UTC.
        'timezone' => $start_at->tzName, // webinar timezone
        'duration' => 'integer' // duration in minutes,
        'password' => 'string' // zoom webinar password,
    ]);
```
## Update Items

We can a user by passing an array of user details

``` php
    
    $webinar = $zoom->webinars->update('webinarId', [
        'topic' => 'string',
        'agenda' => 'string',
    ]);
    
    //end webinar/meeting by updating its status.
    $zoom->webinars->updateStatus('webinarId', 'end')
    $zoom->meetings->updateStatus('meetingId', 'end')
```

### RESOURCES

We cover the main resources

```
users 
   methods (list, retrieve, create, update, updatePassword, remove, assistantsList, addAssistant, deleteAssistants, deleteAssistant, deletesSchedulers, deletesScheduler)
meetings 
    methods (list, retrieve, create, update, updateStatus, remove, records)
mebinars
    methods (list, retrieve, create, update, updateStatus, remove, records)
```


We aim to add additional resources/sub-resources over time

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mwfayez@gmail.com instead of using the issue tracker.

## Credits

- [Mina William](https://github.com/MinaWilliam)
- forked from: https://github.com/Fessnik/zoom

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
