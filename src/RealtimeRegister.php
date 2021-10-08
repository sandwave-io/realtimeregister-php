<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister;

use Psr\Log\LoggerInterface;
use SandwaveIo\RealtimeRegister\Api\BrandsApi;
use SandwaveIo\RealtimeRegister\Api\ContactsApi;
use SandwaveIo\RealtimeRegister\Api\CustomersApi;
use SandwaveIo\RealtimeRegister\Api\DomainsApi;
use SandwaveIo\RealtimeRegister\Api\NotificationsApi;
use SandwaveIo\RealtimeRegister\Api\ProcessesApi;
use SandwaveIo\RealtimeRegister\Api\ProvidersApi;
use SandwaveIo\RealtimeRegister\Api\TLDsApi;
use SandwaveIo\RealtimeRegister\Support\AuthorizedClient;

final class RealtimeRegister
{
    private const BASE_URL = 'https://api.yoursrs.com/';

    public ContactsApi $contacts;
    public CustomersApi $customers;
    public DomainsApi $domains;
    public TLDsApi $tlds;
    public NotificationsApi $notifications;
    public ProvidersApi $providers;
    public BrandsApi $brands;
    public ProcessesApi $processes;

    public function __construct(string $apiKey, ?string $baseUrl = null, ?LoggerInterface $logger = null)
    {
        $url = $baseUrl ?: self::BASE_URL;
        $this->setClient(new AuthorizedClient($url, $apiKey, [], $logger));
    }

    public function setClient(AuthorizedClient $client): void
    {
        $this->contacts  = new ContactsApi($client);
        $this->customers = new CustomersApi($client);
        $this->domains   = new DomainsApi($client);
        $this->tlds      = new TLDsApi($client);
        $this->notifications  = new NotificationsApi($client);
        $this->providers = new ProvidersApi($client);
        $this->brands = new BrandsApi($client);
        $this->processes = new ProcessesApi($client);
    }
}
