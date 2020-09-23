<?php


namespace SandwaveIo\RealtimeRegister\Tests\Helpers;


use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Support\IsProxyConnection;

class MockedIsProxyConnection extends IsProxyConnection
{
    /** @var TestCase */
    private $testCase;

    /** @var string[] */
    private $expectedReads;

    /** @var string[] */
    private $expectedWrites;

    public function __construct(string $apiKey, TestCase $testCase)
    {
        parent::__construct($apiKey);

        $this->testCase = $testCase;
    }

    public function __destruct()
    {
        if (count($this->expectedReads) > 0) {
            foreach ($this->expectedReads as $read) {
                $this->testCase->assertTrue(false, "Message expected to be read but was not: '{$read}'");
            }
        }
        if (count($this->expectedWrites) > 0) {
            foreach ($this->expectedWrites as $write) {
                $this->testCase->assertTrue(false, "Message expected to be written but was not: '{$write}'");
            }
        }
    }

    public function expectRead(string $message): MockedIsProxyConnection
    {
        $this->expectedReads[] = $message;
        return $this;
    }

    public function expectWrite(string $message): MockedIsProxyConnection
    {
        $this->expectedWrites[] = $message;
        return $this;
    }

    public function connect(): bool
    {
        return $this->login();
    }

    public function disconnect(): void
    {
        $this->write('CLOSE');
    }

    public function write(string $message): bool
    {
        $expected = array_shift($this->expectedWrites);
        $this->testCase->assertSame($expected, $message);
        return true;
    }

    public function read(): string
    {
        $expected = array_shift($this->expectedReads);
        $this->testCase->assertIsString($expected);
        return $expected;
    }

    protected function isConnected(): bool
    {
        return true;
    }
}