<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\TemplateCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class BrandsApiListTemplatesTest extends TestCase
{
    public function test_list_templates(): void
    {
        $customerHandle = 'customertestname';
        $brandHandle = 'brandtestname';

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/template_valid.php',
                    include __DIR__ . '/../Domain/data/template_valid.php',
                    include __DIR__ . '/../Domain/data/template_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', "/v2/customers/{$customerHandle}/brands/{$brandHandle}/templates", $this)
        );

        $response = $sdk->brands->listTemplates($customerHandle, $brandHandle);
        $this->assertInstanceOf(TemplateCollection::class, $response);
    }

    public function test_list_templates_with_queries(): void
    {
        $customerHandle = 'customertestname';
        $brandHandle = 'brandtestname';
        $searchTextOnFields = 'search';

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/template_valid.php',
                    include __DIR__ . '/../Domain/data/template_valid.php',
                    include __DIR__ . '/../Domain/data/template_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', "/v2/customers/{$customerHandle}/brands/{$brandHandle}/templates", $this)
        );

        $response = $sdk->brands->listTemplates($customerHandle, $brandHandle, 10, 0, $searchTextOnFields);
        $this->assertInstanceOf(TemplateCollection::class, $response);
    }

    public function test_list_with_search_and_parameters(): void
    {
        $customerHandle = 'customertestname';
        $brandHandle = 'brandtestname';
        $searchTextOnFields = 'search';

        $parameters = [
            'name' => 'EMAIL_HEADER',
        ];

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/template_valid.php',
                    include __DIR__ . '/../Domain/data/template_valid.php',
                    include __DIR__ . '/../Domain/data/template_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', "/v2/customers/{$customerHandle}/brands/{$brandHandle}/templates", $this, [
                'name' => 'EMAIL_HEADER',
                'limit' => '10',
                'offset' => '0',
                'q' => 'search',
            ])
        );

        $response = $sdk->brands->listTemplates($customerHandle, $brandHandle, 10, 0, $searchTextOnFields, $parameters);
        $this->assertInstanceOf(TemplateCollection::class, $response);
    }
}
