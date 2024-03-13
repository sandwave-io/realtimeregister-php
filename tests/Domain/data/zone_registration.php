<?php declare(strict_types = 1);

return [
    'id' => 1,
    'customer' => 'example',
    'createdDate' => '2024-03-05T10:10:10Z',
    'managed' => true,
    'service' => \SandwaveIo\RealtimeRegister\Domain\Enum\DomainZoneServiceEnum::BASIC,
    'hostMaster' => 'hostmaster@example.com',
    'refresh' => 255,
    'retry' => 1,
    'expire' => 1,
    'ttl' => 127,
    'dnssec' => true,
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
