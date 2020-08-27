<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister;

use SandwaveIo\RealtimeRegister\Support\AuthorizedClient;

final class RealtimeRegister
{
    const BASE_URL = 'https://api.yoursrs.com/';

    /** @var AuthorizedClient */
    private $client;

    public function __construct(string $apiKey, ?string $baseUrl = null)
    {
        $url = $baseUrl ?: RealtimeRegister::BASE_URL;
        $this->client = new AuthorizedClient($url, $apiKey);
    }
}
