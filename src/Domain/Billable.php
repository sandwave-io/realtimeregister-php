<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\BillableActionEnum;

final class Billable implements DomainObjectInterface
{
    public string $product;
    public string $action;
    public int $quantity;
    public int $amount;
    public string $providerName;

    private function __construct(
        string $product,
        string $action,
        int $quantity,
        int $amount,
        string $providerName
    ) {
        $this->product = $product;
        $this->action = $action;
        $this->quantity = $quantity;
        $this->amount = $amount;
        $this->providerName = $providerName;
    }

    public static function fromArray(array $data): Billable
    {
        BillableActionEnum::validate($data['action']);

        return new Billable(
            $data['product'],
            $data['action'],
            $data['quantity'],
            $data['amount'] ?? 0,
            $data['providerName']
        );
    }

    public function toArray(): array
    {
        return [
            'product' => $this->product,
            'action' => $this->action,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'providerName' => $this->providerName,
        ];
    }
}
