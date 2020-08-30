<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\AccountCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CustomersApiCreditsTest extends TestCase
{
    public function test_credits(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/account_valid.php',
                    include __DIR__ . '/../Domain/data/account_valid.php',
                    include __DIR__ . '/../Domain/data/account_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/credit', $this)
        );

        $response = $sdk->customers->credits('johndoe');
        $this->assertInstanceOf(AccountCollection::class, $response);
    }
}
