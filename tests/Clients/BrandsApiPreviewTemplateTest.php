<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Enum\TemplateNameEnum;
use SandwaveIo\RealtimeRegister\Domain\TemplatePreview;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class BrandsApiPreviewTemplateTest extends TestCase
{
    public function test_preview_template(): void
    {
        $customerHandle = 'customertestname';
        $brandHandle = 'brandtestname';
        $templateName = TemplateNameEnum::TEMPLATE_NAME_THANK_YOU_PAGE;

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/template_preview_valid.php'),
            MockedClientFactory::assertRoute('GET', "/v2/customers/{$customerHandle}/brands/{$brandHandle}/templates/{$templateName}/preview", $this)
        );

        $response = $sdk->brands->previewTemplate($customerHandle, $brandHandle, $templateName);
        $this->assertInstanceOf(TemplatePreview::class, $response);
    }

    public function test_preview_template_with_queries(): void
    {
        $customerHandle = 'customertestname';
        $brandHandle = 'brandtestname';
        $templateName = TemplateNameEnum::TEMPLATE_NAME_THANK_YOU_PAGE;
        $context = 'base';

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/template_preview_valid.php'),
            MockedClientFactory::assertRoute('GET', "/v2/customers/{$customerHandle}/brands/{$brandHandle}/templates/{$templateName}/preview", $this)
        );

        $response = $sdk->brands->previewTemplate($customerHandle, $brandHandle, $templateName, $context);
        $this->assertInstanceOf(TemplatePreview::class, $response);
    }

    public function test_preview_template_with_intended_usage_error(): void
    {
        $customerHandle = 'customertestname';
        $brandHandle = 'brandtestname';
        $templateName = TemplateNameEnum::TEMPLATE_NAME_WEB_HEADER;

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/template_preview_valid.php'),
            MockedClientFactory::assertRoute('GET', "/v2/customers/{$customerHandle}/brands/{$brandHandle}/templates/{$templateName}/preview", $this)
        );

        $this->expectException(\InvalidArgumentException::class);
        $sdk->brands->previewTemplate($customerHandle, $brandHandle, $templateName);
    }
}
