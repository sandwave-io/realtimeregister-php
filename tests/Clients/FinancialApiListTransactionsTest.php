<?php
declare(strict_types = 1);

namespace Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;
use Webmozart\Assert\Assert;

class FinancialApiListTransactionsTest extends TestCase
{
    public function test_list_transactions(): void
    {
        /** @var string $responseBody */
        $responseBody = json_encode(
            [
                'entities' => [
                    include __DIR__ . '/../Domain/data/transaction_valid.php',
                    include __DIR__ . '/../Domain/data/transaction_valid.php',
                    include __DIR__ . '/../Domain/data/transaction_valid.php',
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
            MockedClientFactory::assertRoute('GET', 'v2/billing/financialtransactions', $this)
        );

        $sdk->financial->listTransactions();
    }

    public function test_list_with_queries(): void
    {
        /** @var string $responseBody */
        $responseBody = json_encode(
            [
                'entities' => [
                    include __DIR__ . '/../Domain/data/transaction_valid.php',
                    include __DIR__ . '/../Domain/data/transaction_valid.php',
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
            MockedClientFactory::assertRoute('GET', 'v2/billing/financialtransactions', $this)
        );

        $sdk->financial->listTransactions(2, 0, 'identifier:eq=something');
    }

    public function test_list_with_search_and_parameters(): void
    {
        $parameters = [
            'processType' => 'incomingTransfer',
            'order' => '-updatedDate',
        ];

        /** @var string $responseBody */
        $responseBody = json_encode(
            [
                'entities' => [
                    include __DIR__ . '/../Domain/data/transaction_valid.php',
                    include __DIR__ . '/../Domain/data/transaction_valid.php',
                ],
                'pagination' => [
                    'total' => 2,
                    'offset' => 0,
                    'limit' => 2,
                ],
            ]
        );

        $sdk = MockedClientFactory::makeSdk(
            200,
            $responseBody,
            MockedClientFactory::assertRoute('GET', 'v2/billing/financialtransactions', $this, [
                'processType' => 'incomingTransfer',
                'order' => '-updatedDate',
                'limit' => '2',
                'offset' => '0',
                'q' => 'search',
            ])
        );

        $sdk->financial->listTransactions(2, 0, 'search', $parameters);
    }
}
