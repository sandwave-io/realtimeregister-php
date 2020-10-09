<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Enum\TemplateNameEnum;
use SandwaveIo\RealtimeRegister\Domain\Template;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class BrandsApiGetTemplateTest extends TestCase
{
    public function test_get_template(): void
    {
        $customerHandle = 'customertestname';
        $brandHandle = 'brandtestname';
        $templateName = TemplateNameEnum::TEMPLATE_NAME_THANK_YOU_PAGE;

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/template_valid.php'),
            MockedClientFactory::assertRoute('GET', "/v2/customers/{$customerHandle}/brands/{$brandHandle}/templates/{$templateName}", $this)
        );

        $response = $sdk->brands->getTemplate($customerHandle, $brandHandle, $templateName);
        $this->assertInstanceOf(Template::class, $response);
    }
}
