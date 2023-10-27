<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class IsProxyDomain
{
    public const STATUS_ERROR          = 'error';
    public const STATUS_AVAILABLE      = 'available';
    public const STATUS_NOT_AVAILABLE  = 'not available';
    public const STATUS_INVALID_DOMAIN = 'invalid domain';

    private string $domain;

    private string $status;

    private array $extras;

    public function __construct(string $domain, string $status, array $extras = [])
    {
        $this->domain = $domain;
        $this->status = $status;
        $this->extras = $extras;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getExtras(): array
    {
        return $this->extras;
    }

    public function isAvailable(): bool
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    public function isError(): bool
    {
        return $this->status === self::STATUS_ERROR;
    }

    public function isNotAvailable(): bool
    {
        return $this->status === self::STATUS_NOT_AVAILABLE;
    }

    public function isInvalid(): bool
    {
        return $this->status === self::STATUS_INVALID_DOMAIN;
    }
}
