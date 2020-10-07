<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Brand;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class BrandsApiGetTest extends TestCase
{
    public function test_get(): void
    {
        $customerHandle = 'customertestname';
        $brandHandle = 'brandtestname';

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/brand_valid.php'),
            MockedClientFactory::assertRoute('GET', "/v2/customers/{$customerHandle}/brands/{$brandHandle}", $this)
        );

        $response = $sdk->brands->get($customerHandle, $brandHandle);
        $this->assertInstanceOf(Brand::class, $response);
    }
}
