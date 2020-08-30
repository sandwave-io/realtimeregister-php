<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class Price implements DomainObjectInterface
{
    /** @var string */
    public $product;

    /** @var string */
    public $action;

    /** @var string */
    public $currency;

    /** @var int */
    public $price;

    private function __construct(string $product, string $action, string $currency, int $price)
    {
        $this->product = $product;
        $this->action = $action;
        $this->currency = $currency;
        $this->price = $price;
    }

    public static function fromArray(array $json): Price
    {
        return new Price(
            $json['product'],
            $json['action'],
            $json['currency'],
            $json['price']
        );
    }

    public function toArray(): array
    {
        return [
            'product' =>$this->product,
            'action' =>$this->action,
            'currency' =>$this->currency,
            'price' =>$this->price,
        ];
    }
}
