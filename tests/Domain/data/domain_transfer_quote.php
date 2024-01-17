<?php declare(strict_types = 1);

return [
    'command' => 'TransferDomainCommand',
    'quote' => [
        'currency' => 'EUR',
        'billables' => [
            [
                'action' => 'TRANSFER',
                'product' => 'domain_com',
                'quantity' => 1,
                'amount' => 500,
                'refundable' => false,
                'total' => 500,
            ],
        ],
        'total' => 500,
    ],
];
