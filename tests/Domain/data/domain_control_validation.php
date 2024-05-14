<?php

declare(strict_types = 1);

return [
    [
        'commonName' => 'test.nl',
        'type' => \SandwaveIo\RealtimeRegister\Domain\Enum\DcvTypeEnum::LOCALE_EMAIL,
        'email' => 'domainmanager@test.nl',
        'status' => \SandwaveIo\RealtimeRegister\Domain\Enum\DcvStatusEnum::DCV_STATUS_ATTENTION
    ],
    [
        'commonName' => 'test2.nl',
        'type' => \SandwaveIo\RealtimeRegister\Domain\Enum\DcvTypeEnum::LOCALE_EMAIL,
        'email' => 'domainmanager@test2.nl',
        'status' => \SandwaveIo\RealtimeRegister\Domain\Enum\DcvStatusEnum::DCV_STATUS_ATTENTION
    ]
];
