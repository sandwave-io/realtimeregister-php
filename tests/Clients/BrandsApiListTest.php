<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\BrandCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class BrandsApiListTest extends TestCase
{
    public function test_list(): void
    {
        $customerHandle = 'customertestname';

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/brand_valid.php',
                    include __DIR__ . '/../Domain/data/brand_valid.php',
                    include __DIR__ . '/../Domain/data/brand_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', "/v2/customers/{$customerHandle}/brands", $this)
        );

        $response = $sdk->brands->list($customerHandle);
        $this->assertInstanceOf(BrandCollection::class, $response);
    }

    public function test_list_with_queries(): void
    {
        $customerHandle = 'customertestname';
        $searchTextOnFields = 'search';

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/brand_valid.php',
                    include __DIR__ . '/../Domain/data/brand_valid.php',
                    include __DIR__ . '/../Domain/data/brand_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', "/v2/customers/{$customerHandle}/brands", $this)
        );

        $response = $sdk->brands->list($customerHandle, 3, 0, $searchTextOnFields);
        $this->assertInstanceOf(BrandCollection::class, $response);
    }

    public function test_list_with_search_and_parameters(): void
    {
        $customerHandle = 'customertestname';
        $parameters = [
            'city' => 'testcity',
            'country:in' => 'NL,BE',
        ];
        $search = 'search';

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/brand_valid.php',
                    include __DIR__ . '/../Domain/data/brand_valid.php',
                    include __DIR__ . '/../Domain/data/brand_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', "/v2/customers/{$customerHandle}/brands", $this, [
                'city' => 'testcity',
                'country:in' => 'NL,BE',
                'limit' => '3',
                'offset' => '0',
                'q' => 'search',
            ])
        );

        $response = $sdk->brands->list($customerHandle, 3, 0, $search, $parameters);
        $this->assertInstanceOf(BrandCollection::class, $response);
    }
}
