<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister;

use Psr\Log\LoggerInterface;
use SandwaveIo\RealtimeRegister\Api\ContactsApi;
use SandwaveIo\RealtimeRegister\Api\CustomersApi;
use SandwaveIo\RealtimeRegister\Api\DomainsApi;
use SandwaveIo\RealtimeRegister\Support\AuthorizedClient;

final class RealtimeRegister
{
    const BASE_URL = 'https://api.yoursrs.com/';

    /** @var ContactsApi */
    public $contacts;

    /** @var CustomersApi */
    public $customers;

    /** @var DomainsApi */
    public $domains;

    public function __construct(string $apiKey, ?string $baseUrl = null, ?LoggerInterface $logger = null)
    {
        $url = $baseUrl ?: RealtimeRegister::BASE_URL;
        $this->setClient(new AuthorizedClient($url, $apiKey, [], $logger));
    }

    public function setClient(AuthorizedClient $client): void
    {
        $this->contacts  = new ContactsApi($client);
        $this->customers = new CustomersApi($client);
        $this->domains   = new DomainsApi($client);
    }
}
