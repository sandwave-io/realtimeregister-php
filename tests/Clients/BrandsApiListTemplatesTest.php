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
}
