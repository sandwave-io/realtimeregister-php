<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\RealtimeRegister;
use SandwaveIo\RealtimeRegister\Support\AuthorizedClient;

/** @covers \SandwaveIo\RealtimeRegister\RealtimeRegister */
class RealtimeRegisterClientTest extends TestCase
{
    public function test_construct(): void
    {
        $client = new RealtimeRegister('https://example.com/api/v2/', 'bigseretdonttellanyone');

        $client->setClient(new AuthorizedClient('https://example.com/api/v2/', 'bigseretdonttellanyone'));

        $this->assertInstanceOf(RealtimeRegister::class, $client);
    }
}
