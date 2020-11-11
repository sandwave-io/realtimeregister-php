<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DomainAvailability implements DomainObjectInterface
{
    /** @var bool */
    public $available;

    /** @var string|null */
    public $reason;

    /** @var bool|null */
    public $premium;

    /** @var int|null */
    public $price;

    /** @var string|null */
    public $currency;

    private function __construct(bool $available, ?string $reason = null, ?bool $premium = null, ?int $price = null, ?string $currency = null)
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
            $json['reason'] ?? null,
            $json['premium'] ?? null,
            $json['price'] ?? null,
            $json['currency'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter(
            [
            'available' => $this->available,
            'reason'    => $this->reason,
            'premium'   => $this->premium,
            'price'     => $this->price,
            'currency'  => $this->currency,
        ],
            function ($x) {
            return ! is_null($x);
        }
        );
    }
}
