<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiListDcvEmailAddressesTest extends TestCase
{
    public function test_list(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'test@mail.com',
                'test5@mail.com',
            ]),
            MockedClientFactory::assertRoute('GET', '/v2/ssl/dcvemailaddresslist/example.com', $this)
        );

        $addresses = $sdk->certificates->listDcvEmailAddresses('example.com');

        self::assertCount(2, $addresses);
        self::assertSame('test@mail.com', $addresses[0]);
        self::assertSame('test5@mail.com', $addresses[1]);
    }
}
