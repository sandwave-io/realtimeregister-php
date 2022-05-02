<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;

final class Notification implements DomainObjectInterface
{
    public int $id;
    public DateTime $fireDate;
    public ?DateTime $readDate;
    public ?DateTime $acknowledgeDate;
    public string $message;
    public ?string $reason;
    public ?string $customer;
    public ?int $process;
    public string $eventType;
    public string $notificationType;
    /** @var array<string>|null */
    public ?array $payload;
    public ?int $certificateId;
    public ?string $transferType;
    public ?string $subjectStatus;

    private function __construct(
        int $id,
        DateTime $fireDate,
        ?DateTime $readDate,
        ?DateTime $acknowledgeDate,
        string $message,
        ?string $reason,
        ?string $customer,
        ?int $process,
        string $eventType,
        string $notificationType,
        ?array $payload,
        ?int $certificateId,
        ?string $transferType,
        ?string $subjectStatus
    ) {
        $this->id = $id;
        $this->fireDate = $fireDate;
        $this->readDate = $readDate;
        $this->acknowledgeDate = $acknowledgeDate;
        $this->message = $message;
        $this->reason = $reason;
        $this->customer = $customer;
        $this->process = $process;
        $this->eventType = $eventType;
        $this->notificationType = $notificationType;
        $this->payload = $payload;
        $this->certificateId = $certificateId;
        $this->transferType = $transferType;
        $this->subjectStatus = $subjectStatus;
    }

    public static function fromArray(array $json): Notification
    {
        return new Notification(
            $json['id'],
            new DateTime($json['fireDate']),
            isset($json['readDate']) ? new DateTime($json['readDate']) : null,
            isset($json['acknowledgeDate']) ? new DateTime($json['acknowledgeDate']) : null,
            $json['message'],
            $json['reason'] ?? null,
            $json['customer'] ?? null,
            $json['process'] ?? null,
            $json['eventType'],
            $json['notificationType'],
            $json['payload'] ?? null,
            $json['certificateId'] ?? null,
            $json['transferType'] ?? null,
            $json['subjectStatus'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'fireDate' => $this->fireDate->format('Y-m-d\TH:i:s\Z'),
            'readDate' => $this->readDate ? $this->readDate->format('Y-m-d\TH:i:s\Z') : null,
            'acknowledgeDate' => $this->acknowledgeDate ? $this->acknowledgeDate->format('Y-m-d\TH:i:s\Z') : null,
            'message' => $this->message,
            'reason' => $this->reason,
            'customer' => $this->customer,
            'process' => $this->process,
            'eventType' => $this->eventType,
            'notificationType' => $this->notificationType,
            'payload' => $this->payload,
            'certificateId' => $this->certificateId,
            'transferType' => $this->transferType,
            'subjectStatus' => $this->subjectStatus,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
