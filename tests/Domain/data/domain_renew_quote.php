<?php declare(strict_types = 1);

return [
    'command' => 'RenewDomainCommand',
    'quote' => [
        'currency' => 'EUR',
        'billables' => [
            [
                'action' => 'RENEW',
                'product' => 'domain_com',
                'quantity' => 1,
                'amount' => 500,
                'refundable' => true,
                'total' => 500,
            ],
        ],
        'total' => 500,
    ],
];
