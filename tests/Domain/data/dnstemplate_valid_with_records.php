<?php declare(strict_types = 1);

return [
    'customer'   => 'donaldduck',
    'name'       => 'magazine',
    'hostMaster' => 'movies@ducktown.disney.com',
    'refresh'    => 129371293,
    'retry'      => 123456,
    'expire'     => 78123139,
    'ttl'        => 712312377,
    'defaultRecords' => [
        [
            'name' => '##DOMAIN##',
            'type' => 'NS',
            'content' => 'ns2.yoursrs.com',
            'ttl' => 3600,
        ],
        [
            'name' => '##DOMAIN##',
            'type' => 'NS',
            'content' => 'ns1.yoursrs.com',
            'ttl' => 3600,
        ],
        [
            'name' => '##DOMAIN##',
            'type' => 'SOA',
            'content' => 'ns1.yoursrs.com dns.example.com 0 86400 10800 3600000 3600',
            'ttl' => 3600,
        ]
    ],
    'records'    => [
        [
            'name'    => '##DOMAIN##',
            'type'    => 'URL',
            'content' => 'http://www.donaldduck.nl/',
            'ttl'     => 300
        ],
        [
            'name' => 'www.##DOMAIN##',
            'type' => 'A',
            'content' => '1.1.1.1',
            'ttl' => 300
        ]
    ]
];
