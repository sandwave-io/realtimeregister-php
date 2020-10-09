<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Enum\TemplateNameEnum;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class BrandsApiUpdateTemplateTest extends TestCase
{
    public function test_update(): void
    {
        $customerHandle = 'customertestname';
        $brandHandle = 'brandtestname';
        $templateName = TemplateNameEnum::TEMPLATE_NAME_THANK_YOU_PAGE;

        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', "/v2/customers/{$customerHandle}/brands/{$brandHandle}/templates/{$templateName}/update", $this)
        );

        $sdk->brands->updateTemplate(
            $customerHandle,
            $brandHandle,
            $templateName,
            'template_subject',
            'template_text',
            'template_html',
            ['base']
        );
    }
}
