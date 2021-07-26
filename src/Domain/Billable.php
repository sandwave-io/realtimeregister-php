<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\BillableActionEnum;

final class Billable implements DomainObjectInterface
{
    public string $product;
    public string $action;
    public int $quantity;

    private function __construct(
        string $product,
        string $action,
        int $quantity
    ) {
        $this->product = $product;
        $this->action = $action;
        $this->quantity = $quantity;
    }

    public static function fromArray(array $data): Billable
    {
        BillableActionEnum::validate($data['action']);

        return new Billable(
            $data['product'],
            $data['action'],
            $data['quantity']
        );
    }

    public function toArray(): array
    {
        return [
            'product' =>$this->product,
            'action' =>$this->action,
            'quantity' =>$this->quantity,
        ];
    }
}
