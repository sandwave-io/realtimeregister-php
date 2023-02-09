<?php declare(strict_types = 1);

return [
    include __DIR__ . '/dnstemplate_valid_with_records.php',
    include __DIR__ . '/dnstemplate_valid_without_records.php',
    [
        'customer'   => 'jackdaniels',
        'name'       => 'whiskey',
        'hostMaster' => 'cheers@home.nl',
        'refresh'    => 1,
        'retry'      => 2,
        'expire'     => 3,
        'ttl'        => 4
    ]
];
