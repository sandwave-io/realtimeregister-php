<?php declare(strict_types = 1);

return [
    'id'           => 1111111112,
    'customer'     => 'johndoe',
    'name'         => 'test',
    'createdDate'  => '2023-05-08T05:10:20Z',
    'service'      => 'PREMIUM',
    'dnssec'       => false,
    'managed'      => true,
    'ns'           => ['ns1.yoursrs.com', 'ns2.yoursrs.com'],
    'hostMaster'   => 'john.doe@example.com',
    'refresh'      => 129371293,
    'retry'        => 123456,
    'expire'       => 78123139,
    'ttl'          => 712312377,
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
        ],
    ],
];
