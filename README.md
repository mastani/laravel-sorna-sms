# Sorna SMS Laravel package

Only available for sornasms.net users

Sorna SMS laravel client

### Installation in Laravel 5.5 and up

```bash
$ composer require mastani/laravel-sorna-sms
```

Run the command below to publish the package config file `config/sornasms.php`:

```shell
php artisan vendor:publish
```

The package will automatically register itself.

### Installation in Laravel 5.4

```bash
$ composer require mastani/laravel-sorna-sms
```

Next up, the service provider must be registered:

```php
// config/app.php

'providers' => [
    ...
    mastani\SornaSMS\SornaSMSServiceProvider::class,
];
```

## Usage

```php
$sms = new SornaSMS();
$result = $map->getSystemCredit(); // return Array( [success] => 1 [result] => 105000 )
$result = $map->sendSMS('mobile number', 'message'); // return Array( [success] => 1 [result] => 8830401037900810478 )
```

## Function

| Function | Description |
| :--- | :--- |
| getSystemCredit() | Get account credit. |
| sendSMS(mobile, message) | Send single SMS. |
| sendSMS([mobiles], [messages]) | Send multiple SMS. |
| sendSMS021(mobile, message) | Send single SMS with 021 line (if you owned one). |
| sendSMS021([mobiles], [messages]) | Send multiple SMS with 021 line (if you owned one). |
| sendSMSBlacklist(mobile, message) | Send single SMS with blacklist module. |
| sendSMSBlacklist([mobiles], [messages]) | Send multiple SMS with blacklist module. |

## Error messages

| Error | Description |
| :--- | :--- |
| -99 | اتمام زمان مجاز جهت ارسال پیامک |
| -100 | Reference id مورد نظر یافت نشد. |
| -101 | احراز کاربر موفقیت آمیز نبود. |
| -102 | نام کاربری یافت نشد. |
| -103 | شماره کاربری اشتباه یا در بین بازه شماره های کاربر نیست. |
| -104 | اعتبار کاربر کم است. |
| -105 | فرمت درخواست اشتباه است. |
| -106 | تعداد Reference id ها بیش از 1000 عدد است. |
| -107 | شماره گیرنده پیام اشتباه است. |
| -108 | شماره گیرنده پیام اشتباه است. |
| -98 | شماره گیرنده در لیست سیاه مخابرات قرار دارد. |
| -111 | شماره گیرنده در لیست سیاه مخابرات قرار دارد. |
| -112 | شماره لیست سیاه یافت نشد. |
| -115 | برنامه ارسالی در حال اجرا میباشد. امکان ارسال همزمان وجود ندارد. |

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
