<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;
use SandwaveIo\RealtimeRegister\Domain\Enum\DomainTransferTypeEnum;

final class DomainTransferStatus implements DomainObjectInterface
{
    public string $domainName;
    public string $registrar;
    public string $status;
    public DateTime $requestedDate;
    public DateTime $actionDate;
    public DateTime $expiryDate;
    public string $type;
    public int $processId;
    public ?LogCollection $log;

    private function __construct(
        string $domainName,
        string $registrar,
        string $status,
        DateTime $requestedDate,
        DateTime $actionDate,
        DateTime $expiryDate,
        string $type,
        int $processId,
        ?LogCollection $log
    ) {
        $this->domainName = $domainName;
        $this->registrar = $registrar;
        $this->status = $status;
        $this->requestedDate = $requestedDate;
        $this->actionDate = $actionDate;
        $this->expiryDate = $expiryDate;
        $this->type = $type;
        $this->processId = $processId;
        $this->log = $log;
    }

    public static function fromArray(array $json): DomainTransferStatus
    {
        DomainTransferTypeEnum::validate($json['type']);
        return new DomainTransferStatus(
            $json['domainName'],
            $json['registrar'],
            $json['status'],
            new DateTime($json['requestedDate']),
            new DateTime($json['actionDate']),
            new DateTime($json['expiryDate']),
            $json['type'],
            $json['processId'],
            isset($json['log']) ? LogCollection::fromArray($json['log']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'domainName' => $this->domainName,
            'registrar' => $this->registrar,
            'status' => $this->status,
            'requestedDate' => $this->requestedDate->format('Y-m-d H:i:s'),
            'actionDate' => $this->actionDate->format('Y-m-d H:i:s'),
            'expiryDate' => $this->expiryDate->format('Y-m-d H:i:s'),
            'type' => $this->type,
            'processId' => $this->processId,
            'log' => $this->log ? $this->log->toArray() : null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
