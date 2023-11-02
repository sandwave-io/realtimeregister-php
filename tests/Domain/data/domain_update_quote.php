<?php declare(strict_types = 1);

return [
    'command' => 'UpdateDomainCommand',
    'quote' => [
        'currency' => 'EUR',
        'billables' => [
            [
                'action' => 'UPDATE',
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
