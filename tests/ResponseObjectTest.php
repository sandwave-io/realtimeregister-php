<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Exceptions\UnexpectedValueException;
use SandwaveIo\RealtimeRegister\Support\RealtimeRegisterResponse;

/** @covers \SandwaveIo\RealtimeRegister\Support\RealtimeRegisterResponse */
class ResponseObjectTest extends TestCase
{
    public function test_get_text(): void
    {
        $response = RealtimeRegisterResponse::fromString('This is text');

        $this->assertSame('This is text', $response->text());
    }

    public function test_to_string(): void
    {
        $response = RealtimeRegisterResponse::fromString('This is text');

        $this->assertSame('This is text', (string) $response);
    }

    public function test_parse_json(): void
    {
        $response = RealtimeRegisterResponse::fromString('{"foo": "bar"}');

        $this->assertSame(['foo' => 'bar'], $response->json());
    }

    public function test_invalid_json(): void
    {
        $response = RealtimeRegisterResponse::fromString('{"foo":  <><>>>>><<<< {{{{{{{{{{{{) "bar"}');

        $this->expectException(UnexpectedValueException::class);
        $response->json();
    }
}
