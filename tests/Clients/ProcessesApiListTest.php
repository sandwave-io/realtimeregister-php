<?php
declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;
use Webmozart\Assert\Assert;

class ProcessesApiListTest extends TestCase
{
    public function test_list(): void
    {
        /** @var string $responseBody */
        $responseBody = json_encode(
            [
                'entities' => [
                    include __DIR__ . '/../Domain/data/process_valid.php',
                    include __DIR__ . '/../Domain/data/process_valid.php',
                    include __DIR__ . '/../Domain/data/process_valid.php',
                ],
                'pagination' => [
                    'total' => 3,
                    'offset' => 0,
                    'limit' => 10,
                ],
            ]
        );
        Assert::string($responseBody);
        $sdk = MockedClientFactory::makeSdk(
            200,
            $responseBody,
            MockedClientFactory::assertRoute('GET', 'v2/processes', $this)
        );

        $sdk->processes->list();
    }

    public function test_list_with_queries(): void
    {
        /** @var string $responseBody */
        $responseBody = json_encode(
            [
                'entities' => [
                    include __DIR__ . '/../Domain/data/process_valid.php',
                    include __DIR__ . '/../Domain/data/process_valid.php',
                ],
                'pagination' => [
                    'total' => 2,
                    'offset' => 0,
                    'limit' => 2,
                ],
            ]
        );
        Assert::string($responseBody);

        $sdk = MockedClientFactory::makeSdk(
            200,
            $responseBody,
            MockedClientFactory::assertRoute('GET', 'v2/processes', $this)
        );

        $sdk->processes->list(2, 0, 'identifier:eq=something');
    }
}
