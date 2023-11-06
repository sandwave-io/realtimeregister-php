<?php declare(strict_types = 1);

return  [
    'id' => 654563,
    'customer' => 'johndoe',
    'date' => '2021-08-11T06:17:15Z',
    'amount' => 1000000,
    'currency' => 'EUR',
    'processId' => 46069000,
    'processType' => 'contact',
    'processIdentifier' => 'rtr-handle123',
    'processAction' => 'update',
    'chargesPerAccount' => [
        'USD' => 1000000,
    ],
    'billables' => [
        include __DIR__ . '/billable_valid.php',
        include __DIR__ . '/billable_valid.php',
    ],
];
