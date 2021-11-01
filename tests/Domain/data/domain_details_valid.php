<?php declare(strict_types = 1);

return [
    'domainName' => 'example.nl',
    'registry' => 'sidn',
    'customer' => 'johndoe',
    'registrant' => 'johndoe',
    'privacyProtect' => false,
    'status' => ['PENDING_RENEW'],
    'authcode' => '294759302',
    'languageCode' => 'nl',
    'autoRenew' => true,
    'autoRenewPeriod' => 12,
    'ns' => [
        'ns01.example.com',
        'ns02.example.com',
    ],
    'childHosts' => [
        'example.com',
    ],
    'createdDate' => '2020-08-30T01:02:03Z',
    'updatedDate' => '2020-08-30T01:02:03Z',
    'expiryDate' => '2020-11-30T01:02:03Z',
    'premium' => false,
    'zone' => include __DIR__ . '/zone_valid.php',
    'contacts' => [
        include __DIR__ . '/domain_contact_valid.php',
        include __DIR__ . '/domain_contact_valid.php',
    ],
    'keyData' => [
        include __DIR__ . '/key_data_valid.php',
        include __DIR__ . '/key_data_valid.php',
    ],
    'ds_data' => [
        include __DIR__ . '/ds_data_valid.php',
        include __DIR__ . '/ds_data_valid.php',
    ],
];
