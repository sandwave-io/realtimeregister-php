<?php declare(strict_types = 1);

return [
    'id' => 1111111,
    'service' => 'BASIC',
    'hostMaster' => 'hostmaster@example.com',
    'refresh' => 3600,
    'retry' => 3600,
    'expire' => 1209600,
    'ttl' => 3600,
    'defaultRecords' => [
        [
            'name' => 'example.com',
            'type' => 'SOA',
            'content' => 'ns1.yoursrs.com hostmaster@example.com 2022122300 3600 3600 1209600 3600',
            'ttl' => 3600,
        ],
        [
            'name' => 'example.com',
            'type' => 'NS',
            'content' => 'ns1.yoursrs.com',
            'ttl' => 3600,
        ],
        [
            'name' => 'example.com',
            'type' => 'NS',
            'content' => 'ns2.yoursrs.com',
            'ttl' => 3600,
        ],
    ],
    'records' => [
        [
            'name' => 'example.com',
            'type' => 'A',
            'content' => '1.1.1.1',
            'ttl' => 3600,
        ],
        [
            'name' => 'example.com',
            'type' => 'AAAA',
            'content' => '2606:4700:4700::1111',
            'ttl' => 3600,
        ],
    ],
];
