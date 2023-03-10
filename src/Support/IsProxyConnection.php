<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Support;

/** @codeCoverageIgnore */
class IsProxyConnection
{
    protected string $apiKey;

    protected string $host;

    protected int $port;

    /** @var resource */
    protected $socket;

    public function __construct(string $apiKey, string $host = 'is.yoursrs.com', int $port = 2001)
    {
        $this->apiKey = $apiKey;
        $this->host = $host;
        $this->port = $port;
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function connect(): bool
    {
        $socket = @fsockopen($this->host, $this->port, $errno, $errstr, 10);
        if (! is_resource($socket)) {
            return false;
        }

        $this->socket = $socket;
        return $this->login();
    }

    public function disconnect(): void
    {
        $this->write('CLOSE');

        @fclose($this->socket);
    }

    public function write(string $message): bool
    {
        if (! $this->isConnected()) {
            $this->connect();
        }

        return @fputs($this->socket, $message . "\r\n") !== false;
    }

    public function read(): string
    {
        if (! $this->isConnected()) {
            $this->connect();
        }

        if (! $response = fgets($this->socket, 1024)) {
            return '';
        }

        return trim($response);
    }

    protected function login(): bool
    {
        if (! $this->write('LOGIN ' . $this->apiKey)) {
            return false;
        }

        $response = $this->read();
        if (preg_match('#^400\sLogin\sfailed#', $response)) {
            return false;
        }

        return (bool) preg_match('#^100\sLogin\sok#', $response);
    }

    protected function isConnected(): bool
    {
        return is_resource($this->socket);
    }
}
