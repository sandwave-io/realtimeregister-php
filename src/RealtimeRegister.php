<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister;

use SandwaveIo\RealtimeRegister\Api\ContactsApi;
use SandwaveIo\RealtimeRegister\Support\AuthorizedClient;

final class RealtimeRegister
{
    const BASE_URL = 'https://api.yoursrs.com/';

    /** @var ContactsApi */
    public $contacts;

//    public $customers;
//
//    public $domains;

    public function __construct(string $apiKey, ?string $baseUrl = null)
    {
        $url = $baseUrl ?: RealtimeRegister::BASE_URL;
        $this->setClients(new AuthorizedClient($url, $apiKey));
    }

    public function setClients(AuthorizedClient $client): void
    {
        $this->contacts = new ContactsApi($client);
    }
}
