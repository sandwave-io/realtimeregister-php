<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\IsProxyDomain;
use SandwaveIo\RealtimeRegister\Exceptions\IsProxyConnectionException;
use SandwaveIo\RealtimeRegister\IsProxy;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedIsProxyConnection;

class IsProxyConnectionTest extends TestCase
{
    public function test_check(): void
    {
        $connection = (new MockedIsProxyConnection('secret', $this))
            ->expectWrite('LOGIN secret')
            ->expectRead('100 Login ok')
            ->expectWrite('IS example.com')
            ->expectRead('example.com available')
            ->expectWrite('CLOSE');

        $isProxy = new IsProxy('secret');
        $isProxy->setConnection($connection);

        $result = $isProxy->check('example', 'com');

        $this->assertInstanceOf(IsProxyDomain::class, $result);
        $this->assertSame(IsProxyDomain::STATUS_AVAILABLE, $result->getStatus());
        $this->assertSame('example.com', $result->getDomain());
        $this->assertTrue($result->isAvailable());
    }

    public function test_connection_error(): void
    {
        $connection = (new MockedIsProxyConnection('secret', $this))
            ->expectWrite('LOGIN secret')
            ->expectRead('400 Login failed');

        $isProxy = new IsProxy('secret');
        $isProxy->setConnection($connection);

        $this->expectException(IsProxyConnectionException::class);
        $isProxy->check('example', 'com');
    }

    public function test_check_wrong_answer(): void
    {
        $connection = (new MockedIsProxyConnection('secret', $this))
            ->expectWrite('LOGIN secret')
            ->expectRead('100 Login ok')
            ->expectWrite('IS example.com')
            ->expectRead('lksdflkjsdflkjsdflkj')
            ->expectWrite('CLOSE');

        $isProxy = new IsProxy('secret');
        $isProxy->setConnection($connection);

        $result = $isProxy->check('example', 'com');

        $this->assertNull($result);
    }

    public function test_check_many(): void
    {
        $connection = (new MockedIsProxyConnection('secret', $this))
            ->expectWrite('LOGIN secret')
            ->expectRead('100 Login ok')
            ->expectWrite('IS example.com')
            ->expectRead('example.com available')
            ->expectWrite('IS example.nl')
            ->expectRead('example.nl not available')
            ->expectWrite('IS example.net')
            ->expectRead('example.net error')
            ->expectWrite('IS example.org')
            ->expectRead('example.org invalid domain')
            ->expectWrite('IS example.fail')
            ->expectRead('lkjsdflkjsdf')
            ->expectWrite('CLOSE');

        $isProxy = new IsProxy('secret');
        $isProxy->setConnection($connection);

        $result = $isProxy->checkMany('example', ['com', 'nl', 'net', 'org', 'fail']);

        $this->assertCount(4, $result, 'Unexpected number of results');

        [$availableDomain, $notAvailableDomain, $errorDomain, $invalidDomain] = $result;

        $this->assertInstanceOf(IsProxyDomain::class, $availableDomain);
        $this->assertSame(IsProxyDomain::STATUS_AVAILABLE, $availableDomain->getStatus());
        $this->assertSame('example.com', $availableDomain->getDomain());
        $this->assertTrue($availableDomain->isAvailable());

        $this->assertInstanceOf(IsProxyDomain::class, $notAvailableDomain);
        $this->assertSame(IsProxyDomain::STATUS_NOT_AVAILABLE, $notAvailableDomain->getStatus());
        $this->assertSame('example.nl', $notAvailableDomain->getDomain());
        $this->assertTrue($notAvailableDomain->isNotAvailable());

        $this->assertInstanceOf(IsProxyDomain::class, $errorDomain);
        $this->assertSame(IsProxyDomain::STATUS_ERROR, $errorDomain->getStatus());
        $this->assertSame('example.net', $errorDomain->getDomain());
        $this->assertTrue($errorDomain->isError());

        $this->assertInstanceOf(IsProxyDomain::class, $invalidDomain);
        $this->assertSame(IsProxyDomain::STATUS_INVALID_DOMAIN, $invalidDomain->getStatus());
        $this->assertSame('example.org', $invalidDomain->getDomain());
        $this->assertTrue($invalidDomain->isInvalid());
    }

    public function test_check_many_connection_fail(): void
    {
        $connection = (new MockedIsProxyConnection('secret', $this))
            ->expectWrite('LOGIN secret')
            ->expectRead('400 Login failed');

        $isProxy = new IsProxy('secret');
        $isProxy->setConnection($connection);

        $this->expectException(IsProxyConnectionException::class);
        $isProxy->checkMany('example', ['com', 'nl', 'net', 'org', 'fail']);
    }

    public function test_check_premium(): void
    {
        $connection = (new MockedIsProxyConnection('secret', $this))
            ->expectWrite('LOGIN secret')
            ->expectRead('100 Login ok')
            ->expectWrite('ENABLE premium')
            ->expectRead('100 ok')
            ->expectWrite('IS example.com')
            ->expectRead('example.com available (type=premium,price=1500,currency=USD)')
            ->expectWrite('IS example.de')
            ->expectRead('example.de available')
            ->expectWrite('IS example.nl')
            ->expectRead('example.nl not available')
            ->expectWrite('IS example.net')
            ->expectRead('example.net error')
            ->expectWrite('IS example.org')
            ->expectRead('example.org invalid domain')
            ->expectWrite('IS example.fail')
            ->expectRead('lkjsdflkjsdf')
            ->expectWrite('CLOSE');

        $isProxy = new IsProxy('secret');
        $isProxy->setConnection($connection);
        $isProxy->enable('premium');

        $result = $isProxy->checkMany('example', ['com', 'de', 'nl', 'net', 'org', 'fail']);

        $this->assertCount(5, $result, 'Unexpected number of results');

        [$premiumDomain, $availableDomain, $notAvailableDomain, $errorDomain, $invalidDomain] = $result;

        $this->assertInstanceOf(IsProxyDomain::class, $premiumDomain);
        $this->assertSame(IsProxyDomain::STATUS_AVAILABLE, $premiumDomain->getStatus());
        $this->assertSame('example.com', $premiumDomain->getDomain());
        $this->assertSame(['type' => 'premium', 'price' => '1500', 'currency' => 'USD'], $premiumDomain->getExtras());
        $this->assertSame('example.com', $premiumDomain->getDomain());
        $this->assertTrue($premiumDomain->isAvailable());

        $this->assertInstanceOf(IsProxyDomain::class, $availableDomain);
        $this->assertSame(IsProxyDomain::STATUS_AVAILABLE, $availableDomain->getStatus());
        $this->assertSame('example.de', $availableDomain->getDomain());
        $this->assertEmpty($availableDomain->getExtras());
        $this->assertTrue($availableDomain->isAvailable());

        $this->assertInstanceOf(IsProxyDomain::class, $notAvailableDomain);
        $this->assertSame(IsProxyDomain::STATUS_NOT_AVAILABLE, $notAvailableDomain->getStatus());
        $this->assertSame('example.nl', $notAvailableDomain->getDomain());
        $this->assertEmpty($availableDomain->getExtras());
        $this->assertTrue($notAvailableDomain->isNotAvailable());

        $this->assertInstanceOf(IsProxyDomain::class, $errorDomain);
        $this->assertSame(IsProxyDomain::STATUS_ERROR, $errorDomain->getStatus());
        $this->assertSame('example.net', $errorDomain->getDomain());
        $this->assertEmpty($availableDomain->getExtras());
        $this->assertTrue($errorDomain->isError());

        $this->assertInstanceOf(IsProxyDomain::class, $invalidDomain);
        $this->assertSame(IsProxyDomain::STATUS_INVALID_DOMAIN, $invalidDomain->getStatus());
        $this->assertSame('example.org', $invalidDomain->getDomain());
        $this->assertEmpty($availableDomain->getExtras());
        $this->assertTrue($invalidDomain->isInvalid());
    }
}
