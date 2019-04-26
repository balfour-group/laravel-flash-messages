# laravel-flash-messages

A super lightweight library for handling flash messages in Laravel.

*This library is in early release and is pending unit tests.*

## Installation

```bash
composer require balfour/laravel-flash-messages
```

## Usage

```php
use Balfour\LaravelFlashMessages\FlashMessages;

// resolve the message container
$flash = app(FlashMessages::class);

// or
$flash = app('flash');

// flash a message
$flash->flash('error', 'You are not authorized.');

// flash a message with a title
$flash->flash('error', 'You are not authorized.', 'Oopsie');

// add a message to the current container
// this message won't flash to the next request
$flash->add('error', 'You are not authorized.');

// retrieve all flash message
$messages = $flash->all();

// wipe all messages
$messages->clear();
```
