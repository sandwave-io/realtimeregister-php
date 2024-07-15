<?php declare(strict_types = 1);

return [
    'commonName' => 'example',
    'requiresAttention' => false,
    'certificateId' => 1,
    'validations' => [
        'docs' => \SandwaveIo\RealtimeRegister\Domain\Enum\DcvStatusEnum::DCV_STATUS_VALIDATED,
        'dcv' => [
            [
                'commonName' => 'v1.example.com',
                'type' => \SandwaveIo\RealtimeRegister\Domain\Enum\DcvTypeEnum::LOCALE_DNS,
                'status' => \SandwaveIo\RealtimeRegister\Domain\Enum\DcvStatusEnum::DCV_STATUS_VALIDATED,
                'dnsRecord' => 'acme',
                'dnsContents' => 'henkisalleenhenkisalleenhenkalserhenkinstaat.nl',
            ],
        ],
    ],
];
