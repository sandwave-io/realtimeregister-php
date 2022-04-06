<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Enum\LanguageEnum;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiSendSubscriberAgreementTest extends TestCase
{
    public function test_send(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', '/v2/processes/1/send-subscriber-agreement', $this)
        );

        $sdk->certificates->sendSubscriberAgreement(1, 'test@mail.com', LanguageEnum::ENGLISH);
    }
}
