# Realtime Register RESTful API - PHP SDK

[![Codecov](https://codecov.io/gh/sandwave-io/realtimeregister-php/branch/master/graph/badge.svg?token=CWWIFWRKZC)](https://packagist.org/packages/sandwave-io/realtimeregister-php)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/sandwave-io/realtimeregister-php/CI)](https://packagist.org/packages/sandwave-io/realtimeregister-php)
[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/sandwave-io/realtimeregister-php)](https://packagist.org/packages/sandwave-io/realtimeregister-php)
[![Packagist PHP Version Support](https://img.shields.io/packagist/v/sandwave-io/realtimeregister-php)](https://packagist.org/packages/sandwave-io/realtimeregister-php)
[![Packagist Downloads](https://img.shields.io/packagist/dt/sandwave-io/realtimeregister-php)](https://packagist.org/packages/sandwave-io/realtimeregister-php)

## Supported APIs

This SDK currently supports these APIs:
* [Domains API](https://dm.realtimeregister.com/docs/api/domains)
* [Customers API](https://dm.realtimeregister.com/docs/api/customers)
* [Contacts API](https://dm.realtimeregister.com/docs/api/contacts)

Are you missing functionality? Feel free to create an issue, or hit us up with a pull request.

## How to use

```bash
composer require sandwave-io/realtimeregister-php
```

```php
<?php

use SandwaveIo\RealtimeRegister\RealtimeRegister;

$realtimeRegister = new RealtimeRegister('my-secret-api-key');

$realtimeRegister->contacts->list('johndoe');
```

## How to contribute

Feel free to create a PR if you have any ideas for improvements. Or create an issue.

* When adding code, make sure to add tests for it (phpunit).
* Make sure the code adheres to our coding standards (use php-cs-fixer to check/fix). 
* Also make sure PHPStan does not find any bugs.

```bash

vendor/bin/php-cs-fixer fix

vendor/bin/phpstan analyze

vendor/bin/phpunit --coverage-text

```

These tools will also run in GitHub actions on PR's and pushes on master.
