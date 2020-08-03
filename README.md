# SENDER.GE Integration for Laravel

[![Packagist](https://img.shields.io/packagist/v/zgabievi/laravel-sender.svg?v=2)](https://packagist.org/packages/zgabievi/laravel-sender)
[![Packagist](https://img.shields.io/packagist/dt/zgabievi/laravel-sender.svg?v=2)](https://packagist.org/packages/zgabievi/laravel-sender)
[![license](https://img.shields.io/github/license/zgabievi/laravel-sender.svg?v=2)](https://packagist.org/packages/zgabievi/laravel-sender)

## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
- [Notification](#notification)
- [Configuration](#configuration)
- [License](#license)

## Installation

To get started, you need to install package:

```sh
composer require zgabievi/laravel-sender
```

If your laravel version is older than 5.5, then add this to your service providers in *config/app.php*:

```php
'providers' => [
    ...
    Zorb\Sender\SenderServiceProvider::class,
    ...
];
```

You can publish config file using this command:

```sh
php artisan vendor:publish --provider="Zorb\Sender\SenderServiceProvider"
```

This command will copy config file in your config directory.

## Usage

- [Send Message](#send-message)
- [Delivery Reports](#delivery-reports)

### Send Message

```php
use Zorb\Sender\Enums\MessageType;
use Zorb\Sender\Sender;

public function __invoke(Sender $sender)
{
  $result = $sender->send('511001100', 'Example message goes here', MessageType::Advertising);
}
```

By default, third parameter is Information (without SMS NO);
Successful result will return following data:

```json
{
  "data": [
    {
      "messageId": "123123",
      "statusId": 1
    }
  ]
}
```

#### Message types can be:

1. Advertisement (with SMS NO)
2. Information (Without SMS NO)

These types can be found in `Zorb\Sender\Enums\MessageType`;

### Delivery Reports

```php
  $result = $sender->report(123123);
```

Successful result will return following data:

```json
{
  "data": [
    {
      "messageId": "2373263",
      "statusId": "1",
      "timestamp": "2020-08-03 22:19:44"
    }
  ]
}
```

#### Status id can be:
0. Pending
1. Delivered
2. Undelivered

These types can be found in `Zorb\Sender\Enums\MessageStatus`;

## Notification

You can you this package as notification channel.

```php
use Zorb\Sender\Channels\SenderChannel;
use Zorb\Sender\Notifications\SmsMessage;

//
public function via($notifiable)
{
    return [SenderChannel::class];
}

//
public function toTwilioSms($notifiable): SmsMessage
{
    return (new SmsMessage())
        ->content('Your message goes here.')
        ->recipient($notifiable->phone);
}
```

## Configuration

You can configure environment file with following variables:

```
SENDER_DEBUG=true/false
SENDER_API_KEY=API_KEY_FROM_SENDER_HERE
```

## License

laravel-sender is licensed under a [MIT License](https://github.com/zgabievi/laravel-sender/blob/master/LICENSE).

