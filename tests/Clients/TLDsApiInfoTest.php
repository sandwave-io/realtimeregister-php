<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\LanguageCodes;
use SandwaveIo\RealtimeRegister\Domain\TLDInfo;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class TLDsApiInfoTest extends TestCase
{
    public function test_info_com(): void
    {
        $json = file_get_contents(__DIR__ . '/../Domain/data/tldinfo_com.json');

        assert(is_string($json));

        $sdk = MockedClientFactory::makeSdk(
            200,
            $json,
            MockedClientFactory::assertRoute('GET', 'v2/tlds/com/info', $this)
        );

        $response = $sdk->tlds->info('com');
        $this->assertInstanceOf(TLDInfo::class, $response);

        $languageCodes = $response->metadata->domainSyntax->languageCodes;

        assert($languageCodes !== null);

        Assert::assertInstanceOf(LanguageCodes::class, $languageCodes);
        Assert::assertSame(113, $languageCodes->count());
    }

    public function test_info_nl(): void
    {
        $json = file_get_contents(__DIR__ . '/../Domain/data/tldinfo_nl.json');

        assert(is_string($json));

        $sdk = MockedClientFactory::makeSdk(
            200,
            $json,
            MockedClientFactory::assertRoute('GET', 'v2/tlds/nl/info', $this)
        );

        $response = $sdk->tlds->info('nl');

        Assert::assertInstanceOf(TLDInfo::class, $response);
        Assert::assertNull($response->metadata->domainSyntax->languageCodes);
    }
}
