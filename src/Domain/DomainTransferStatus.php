<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Carbon\Carbon;
use SandwaveIo\RealtimeRegister\Domain\Enum\DomainTransferTypeEnum;

final class DomainTransferStatus implements DomainObjectInterface
{
    /** @var string */
    public $domainName;

    /** @var string */
    public $registrar;

    /** @var string */
    public $status;

    /** @var Carbon */
    public $requestedDate;

    /** @var Carbon */
    public $actionDate;

    /** @var Carbon */
    public $expiryDate;

    /** @var string */
    public $type;

    /** @var int */
    public $processId;

    /** @var LogCollection|null */
    public $log;

    private function __construct(
        string $domainName,
        string $registrar,
        string $status,
        Carbon $requestedDate,
        Carbon $actionDate,
        Carbon $expiryDate,
        string $type,
        int $processId,
        ?LogCollection $log = null
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
            new Carbon($json['requestedDate']),
            new Carbon($json['actionDate']),
            new Carbon($json['expiryDate']),
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
            'requestedDate' => $this->requestedDate->toDateTimeString(),
            'actionDate' => $this->actionDate->toDateTimeString(),
            'expiryDate' => $this->expiryDate->toDateTimeString(),
            'type' => $this->type,
            'processId' => $this->processId,
            'log' => $this->log ? $this->log->toArray() : null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
