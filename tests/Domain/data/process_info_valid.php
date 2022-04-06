<?php declare(strict_types = 1);

return [
    'commonName' => 'foobar.dev',
    'requiresAttention' => false,
    'validations' => [
        'organization' => 'ATTENTION',
        'voice' => 'ATTENTION',
        'whois' => 'VALIDATED',
        'request' => 'SUSPENDED',
        'dcv' => [
            [
                'commonName' => 'example.com',
                'type' => 'DNS',
                'status' => 'WAITING',
            ],
        ],
    ],
    'notes' => [
        [
            'createdDate' => '2020-09-09T09:18:57Z',
            'type' => 'OUTGOING',
            'message' => 'Some note message',
        ],
    ],
];
