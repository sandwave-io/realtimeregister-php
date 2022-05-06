<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Support;

use SandwaveIo\RealtimeRegister\Exceptions\UnexpectedValueException;

class RealtimeRegisterResponse
{
    private string $response;
    private array $headers;

    public function __construct(string $response, array $headers)
    {
        $this->response = $response;
        $this->headers = $headers;
    }

    public function __toString(): string
    {
        return $this->text();
    }

    public static function fromString(string $response, array $headers): RealtimeRegisterResponse
    {
        return new RealtimeRegisterResponse($response, $headers);
    }

    public function json(): array
    {
        $json = json_decode($this->response, true);

        if (json_last_error() || $json === false) {
            throw new UnexpectedValueException("Could not parse JSON response body:\n" . $this->response);
        }

        return $json;
    }

    public function text(): string
    {
        return $this->response;
    }

    public function headers(): array
    {
        return $this->headers;
    }
}
