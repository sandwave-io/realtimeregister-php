<?php declare(strict_types = 1);

return [
    'command' => 'CreateDomainCommand',
    'quote' => [
        'currency' => 'EUR',
        'billables' => [
            [
                'action' => 'CREATE',
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
