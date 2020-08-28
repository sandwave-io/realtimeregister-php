<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DomainAvailability
{
    /** @var bool */
    public $available;

    /** @var string */
    public $reason;

    /** @var bool */
    public $premium;

    /** @var int */
    public $price;

    /** @var string */
    public $currency;

    private function __construct(bool $available, string $reason, bool $premium, int $price, string $currency)
    {
        $this->available = $available;
        $this->reason = $reason;
        $this->premium = $premium;
        $this->price = $price;
        $this->currency = $currency;
    }

    public static function fromArray(array $json): DomainAvailability
    {
        return new DomainAvailability(
            $json['available'],
            $json['reason'],
            $json['premium'],
            $json['price'],
            $json['currency']
        );
    }
}
