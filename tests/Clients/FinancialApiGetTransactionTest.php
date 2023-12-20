<?php
declare(strict_types = 1);

namespace Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Transaction;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;
use Webmozart\Assert\Assert;

class FinancialApiGetTransactionTest extends TestCase
{
    public function test_get_transaction(): void
    {
        /** @var string $responseBody */
        $responseBody = json_encode(include __DIR__ . '/../Domain/data/transaction_valid.php');
        Assert::string($responseBody);
        $sdk = MockedClientFactory::makeSdk(
            200,
            $responseBody,
            MockedClientFactory::assertRoute('GET', 'v2/billing/financialtransactions/654563', $this)
        );

        $response = $sdk->financial->getTransaction(654563);
        $this->assertInstanceOf(Transaction::class, $response);
    }
}
