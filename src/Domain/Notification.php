<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;

final class Notification implements DomainObjectInterface
{
    public int $id;
    public DateTime $fireDate;
    public DateTime $readDate;
    public ?DateTime $acknowledgedDate;
    public string $message;
    public ?string $reason;
    public ?string $customer;
    public ?int $process;
    public string $eventType;
    public string $notificationType;
    /** @var array<string>|null */
    public ?array $payload;

    private function __construct(
        int $id,
        DateTime $fireDate,
        DateTime $readDate,
        ?DateTime $acknowledgedDate,
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
            isset($json['acknowledgedDate']) ? new DateTime($json['acknowledgedDate']) : null,
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
            'fireDate' => $this->fireDate->format('Y-m-d\TH:i:s\Z'),
            'readDate' => $this->readDate->format('Y-m-d\TH:i:s\Z'),
            'acknowledgedDate' => $this->acknowledgedDate ? $this->acknowledgedDate->format('Y-m-d\TH:i:s\Z') : null,
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
