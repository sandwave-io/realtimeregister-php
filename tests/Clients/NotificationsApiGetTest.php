<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Notification;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class NotificationsApiGetTest extends TestCase
{
    public function test_get(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/notification_valid.php'),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/notifications/1', $this)
        );

        $response = $sdk->notifications->get('johndoe', 1);
        $this->assertInstanceOf(Notification::class, $response);
    }
}
