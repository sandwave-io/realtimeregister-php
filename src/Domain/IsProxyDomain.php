<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class IsProxyDomain
{
    const STATUS_ERROR          = 'error';
    const STATUS_AVAILABLE      = 'available';
    const STATUS_NOT_AVAILABLE  = 'not available';
    const STATUS_INVALID_DOMAIN = 'invalid domain';

    /** @var string */
    private $domain;

    /** @var string */
    private $status;

    public function __construct(string $domain, string $status)
    {
        $this->domain = $domain;
        $this->status = $status;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function isAvailable(): bool
    {
        return $this->status === self::STATUS_ERROR;
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
