<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DomainAvailability implements DomainObjectInterface
{
    public bool $available;
    public ?string $reason;
    public ?bool $premium;
    public ?int $price;
    public ?string $currency;

    private function __construct(bool $available, ?string $reason, ?bool $premium, ?int $price, ?string $currency)
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
