<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\NotificationCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class NotificationsApiListTest extends TestCase
{
    public function test_list(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/notification_valid.php',
                    include __DIR__ . '/../Domain/data/notification_valid.php',
                    include __DIR__ . '/../Domain/data/notification_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/notifications', $this)
        );

        $response = $sdk->notifications->list('johndoe');
        $this->assertInstanceOf(NotificationCollection::class, $response);
    }

    public function test_list_with_queries(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/notification_valid.php',
                    include __DIR__ . '/../Domain/data/notification_valid.php',
                    include __DIR__ . '/../Domain/data/notification_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/notifications', $this)
        );

        $response = $sdk->notifications->list('johndoe', 3, 0, 'john');
        $this->assertInstanceOf(NotificationCollection::class, $response);
    }

    public function test_list_with_search_and_parameters(): void
    {
        $parameters = [
            'notificationType' => 'test',
        ];

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/notification_valid.php',
                    include __DIR__ . '/../Domain/data/notification_valid.php',
                    include __DIR__ . '/../Domain/data/notification_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/notifications', $this, [
                'notificationType' => 'test',
                'limit' => '3',
                'offset' => '0',
                'q' => 'john',
            ])
        );

        $response = $sdk->notifications->list('johndoe', 3, 0, 'john', $parameters);
        $this->assertInstanceOf(NotificationCollection::class, $response);
    }
}
