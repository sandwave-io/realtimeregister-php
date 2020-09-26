<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class NotificationsApiAckTest extends TestCase
{
    public function test_ack(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/notifications/1/ack', $this)
        );

        $sdk->notifications->ack('johndoe', 1);
    }
}
