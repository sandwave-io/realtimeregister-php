<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister;

use SandwaveIo\RealtimeRegister\Domain\IsProxyDomain;
use SandwaveIo\RealtimeRegister\Exceptions\IsProxyConnectionException;
use SandwaveIo\RealtimeRegister\Support\IsProxyConnection;

final class IsProxy
{
    /** @var IsProxyConnection */
    private $connection;

    public function __construct(string $apiKey, string $host = 'is.yoursrs.com', int $port = 2001)
    {
        $this->setConnection(new IsProxyConnection($apiKey, $host, $port));
    }

    public function setConnection(IsProxyConnection $connection): void
    {
        $this->connection = $connection;
    }

    /**
     * @param string   $domain
     * @param string[] $tlds
     *
     * @return IsProxyDomain[]
     */
    public function checkMany(string $domain, array $tlds): array
    {
        if (! $this->connection->connect()) {
            throw new IsProxyConnectionException('Cannot connect to IsProxy');
        }

        $results = array_map(function (string $tld) use ($domain) {
            return $this->sendCheckRequest($domain, $tld);
        }, $tlds);

        $this->connection->disconnect();

        return array_filter($results);
    }

    public function check(string $domain, string $tld): ?IsProxyDomain
    {
        if (! $this->connection->connect()) {
            throw new IsProxyConnectionException('Cannot connect to IsProxy');
        }

        $response = $this->sendCheckRequest($domain, $tld);
        $this->connection->disconnect();

        return $response;
    }

    private function sendCheckRequest(string $domain, string $tld): ?IsProxyDomain
    {
        $this->connection->write("IS {$domain}.{$tld}");
        $response = $this->connection->read();

        if (! preg_match('#^([\-\w.]+)\s(available|not\savailable|invalid\sdomain|error)#', $response, $matches)) {
            return null;
        }

        [$matchedText, $domain, $result] = $matches;

        return new IsProxyDomain($domain, $result);
    }
}
