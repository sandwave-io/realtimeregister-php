<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use SandwaveIo\RealtimeRegister\Support\AuthorizedClient;

abstract class AbstractApi
{
    /** @var AuthorizedClient */
    protected $client;

    public function __construct(AuthorizedClient $client)
    {
        $this->client = $client;
    }
}
