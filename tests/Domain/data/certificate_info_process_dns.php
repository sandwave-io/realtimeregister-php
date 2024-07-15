<?php declare(strict_types = 1);

return [
    'commonName' => 'example',
    'requiresAttention' => false,
    'certificateId' => 1,
    'validations' => [
        'organization' => 'VALIDATED',
        'dcv' => [
            [
                'commonName' => 'v1.example.com',
                'type' => 'DNS',
                'status' => 'VALIDATED',
                'dnsRecord' => 'acme',
                'dnsType' => 'TXT',
                'dnsContents' => 'henkisalleenhenkisalleenhenkalserhenkinstaat.nl',
            ],
        ],
    ],
];
