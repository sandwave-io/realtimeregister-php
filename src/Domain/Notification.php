<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;

final class Notification implements DomainObjectInterface
{
    /** @var int */
    public $id;

    /** @var DateTime */
    public $fireDate;

    /** @var DateTime */
    public $readDate;

    /** @var DateTime */
    public $acknowledgedDate;

    /** @var string */
    public $message;

    /** @var string|null */
    public $reason;

    /** @var string|null */
    public $customer;

    /** @var int|null */
    public $process;

    /** @var string */
    public $eventType;

    /** @var string */
    public $notificationType;

    /** @var array<string>|null */
    public $payload;

    private function __construct(
        int $id,
        DateTime $fireDate,
        DateTime $readDate,
        DateTime $acknowledgedDate,
        string $message,
        ?string $reason,
        ?string $customer,
        ?int $process,
        string $eventType,
        string $notificationType,
        ?array $payload
    ) {
        $this->id = $id;
        $this->fireDate = $fireDate;
        $this->readDate = $readDate;
        $this->acknowledgedDate = $acknowledgedDate;
        $this->message = $message;
        $this->reason = $reason;
        $this->customer = $customer;
        $this->process = $process;
        $this->eventType = $eventType;
        $this->notificationType = $notificationType;
        $this->payload = $payload;
    }

    public static function fromArray(array $json): Notification
    {
        return new Notification(
            $json['id'],
            new DateTime($json['fireDate']),
            new DateTime($json['readDate']),
            new DateTime($json['acknowledgedDate']),
            $json['message'],
            $json['reason'] ?? null,
            $json['customer'] ?? null,
            $json['process'] ?? null,
            $json['eventType'],
            $json['notificationType'],
            $json['payload'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'fireDate' => $this->fireDate->format('Y-m-d H:i:s'),
            'readDate' => $this->readDate->format('Y-m-d H:i:s'),
            'acknowledgedDate' => $this->acknowledgedDate->format('Y-m-d H:i:s'),
            'message' => $this->message,
            'reason' => $this->reason,
            'customer' => $this->customer,
            'process' => $this->process,
            'eventType' => $this->eventType,
            'notificationType' => $this->notificationType,
            'payload' => $this->payload,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
