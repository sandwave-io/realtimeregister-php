<?php


namespace SandwaveIo\RealtimeRegister\Tests;


use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\IsProxyDomain;
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
}