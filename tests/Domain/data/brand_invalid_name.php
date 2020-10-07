<?php declare(strict_types = 1);

use SandwaveIo\RealtimeRegister\Domain\Enum\LocaleEnum;

return [
    'customer' => 1,
    'handle' => 'brandtestname',
    'locale' => LocaleEnum::LOCALE_EN_US,
    'organization' => 'organizationtestname',
    'addressLine' => ['addresslinetest_1', 'addresslinetest_2'],
    'postalCode' => 'postcodetest',
    'city' => 'citytest',
    'state' => 'statetest',
    'country' => 'countrytest',
    'email' => 'email@test.com',
    'url' => 'http://www.test.com',
    'voice' => 'voicetest',
    'fax' => 'faxtest',
    'privacyContact' => 'privacycontacttest',
    'abuseContact' => 'abusecontacttest',
    'createdDate' => '2020-08-30 01:02:03',
    'updatedDate' => '2020-09-05 11:02:03',
];
