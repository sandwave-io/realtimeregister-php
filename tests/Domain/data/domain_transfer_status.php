<?php declare(strict_types = 1);

return [
    'domainName' => 'example.nl',
    'registrar' => 'SIDN',
    'status' => 'pending',
    'requestedDate' => '2020-03-04T12:34:56Z',
    'actionDate' => '2020-04-04T12:34:56Z',
    'expiryDate' => '2020-05-04T12:34:56Z',
    'type' => 'IN',
    'processId' => 5,
    'log' => [
        include __DIR__ . '/log.php',
        include __DIR__ . '/log.php',
        include __DIR__ . '/log.php',
    ],
];
