<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Api\ContactsApi;
use SandwaveIo\RealtimeRegister\Api\CustomersApi;
use SandwaveIo\RealtimeRegister\Api\DomainsApi;
use SandwaveIo\RealtimeRegister\Api\NotificationsApi;
use SandwaveIo\RealtimeRegister\RealtimeRegister;
use SandwaveIo\RealtimeRegister\Support\AuthorizedClient;

/** @covers \SandwaveIo\RealtimeRegister\RealtimeRegister */
class RealtimeRegisterClientTest extends TestCase
{
    public function test_construct(): void
    {
        $client = new RealtimeRegister('https://example.com/api/v2/', 'bigseretdonttellanyone');

        $client->setClient(new AuthorizedClient('https://example.com/api/v2/', 'bigseretdonttellanyone'));

        $this->assertInstanceOf(RealtimeRegister::class, $client, 'The $client could not be instantiated.');
        $this->assertInstanceOf(ContactsApi::class, $client->contacts, 'The contacts could not be instantiated.');
        $this->assertInstanceOf(CustomersApi::class, $client->customers, 'The customers could not be instantiated.');
        $this->assertInstanceOf(DomainsApi::class, $client->domains, 'The domains could not be instantiated.');
        $this->assertInstanceOf(NotificationsApi::class, $client->notifications, 'The notifications could not be instantiated.');
    }
}
