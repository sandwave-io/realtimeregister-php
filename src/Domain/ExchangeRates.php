<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

class ExchangeRates implements DomainObjectInterface
{
    private function __construct(public readonly string $currency, public readonly ?array $exchangerates = null)
    {
    }

    public static function fromArray(array $json): self
    {
        return new ExchangeRates(
            currency: $json['currency'],
            exchangerates: $json['exchangerates'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'currency' => $this->currency,
            'exchangerates' => $this->exchangerates ?? null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
