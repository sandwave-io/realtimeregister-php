<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsTemplatesApiDeleteTest extends TestCase
{
    public function test_delete(): void
    {
        $customerHandle = 'johndoe';
        $dnsTemplateName = 'test';

        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('DELETE', "v2/customers/{$customerHandle}/dnstemplates/{$dnsTemplateName}", $this)
        );

        $sdk->dnstemplates->delete($customerHandle, $dnsTemplateName);
    }
}
