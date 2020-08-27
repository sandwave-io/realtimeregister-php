<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Support;

use SandwaveIo\RealtimeRegister\Exceptions\UnexpectedValueException;

class RealtimeRegisterResponse
{
    /** @var string */
    private $response;

    public function __construct(string $response)
    {
        $this->response = $response;
    }

    public function __toString(): string
    {
        return $this->text();
    }

    public static function fromString(string $response): RealtimeRegisterResponse
    {
        return new RealtimeRegisterResponse($response);
    }

    public function json(): array
    {
        $json = json_decode($this->response, true);

        if (json_last_error() || $json === false) {
            throw new UnexpectedValueException("Could not parse JSON reponse body:\n" . $this->response);
        }

        return $json;
    }

    public function text(): string
    {
        return $this->response;
    }
}
