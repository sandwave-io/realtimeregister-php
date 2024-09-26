<?php

declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;

final class Promo implements DomainObjectInterface
{
    public string $product;

    public string $action;

    public string $currency;

    public int $price;

    public DateTime $fromDate;

    public DateTime $endDate;

    public bool $active;

    private function __construct(
        string $product,
        string $action,
        string $currency,
        int $price,
        DateTime $fromDate,
        DateTime $endDate,
        bool $active
    ) {
        $this->product = $product;
        $this->action = $action;
        $this->currency = $currency;
        $this->price = $price;
        $this->fromDate = $fromDate;
        $this->endDate = $endDate;
        $this->active = $active;
    }

    public static function fromArray(array $json): Promo
    {
        return new Promo(
            $json['product'],
            $json['action'],
            $json['currency'],
            $json['price'],
            new DateTime($json['fromDate']),
            new DateTime($json['endDate']),
            $json['active']
        );
    }

    public function toArray(): array
    {
        return [
            'product' => $this->product,
            'action' => $this->action,
            'currency' => $this->currency,
            'price' => $this->price,
            'fromDate' => $this->fromDate,
            'endDate' => $this->endDate,
            'active' => $this->active,
        ];
    }
}
