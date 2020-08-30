<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class Account implements DomainObjectInterface
{
    /** @var int */
    public $balance;

    /** @var int */
    public $reservation;

    /** @var string */
    public $currency;

    /** @var int */
    public $locked;

    private function __construct(int $balance, int $reservation, string $currency, int $locked)
    {
        $this->balance = $balance;
        $this->reservation = $reservation;
        $this->currency = $currency;
        $this->locked = $locked;
    }

    public static function fromArray(array $json): Account
    {
        return new Account(
            $json['balance'],
            $json['reservation'],
            $json['currency'],
            $json['locked']
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'balance' => $this->balance,
            'reservation' => $this->reservation,
            'currency' => $this->currency,
            'locked' => $this->locked,
        ], function ($x) { return !is_null($x); });
    }
}
