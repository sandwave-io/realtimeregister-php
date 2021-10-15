<?php

declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use SandwaveIo\RealtimeRegister\Domain\Enum\ProcessStatusEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\ResumeTypeEnum;
use Webmozart\Assert\Assert;

final class Process implements DomainObjectInterface
{
    public int $id;
    public string $user;
    public string $customer;
    public string $status;
    public DateTimeInterface $createdDate;
    public ?DateTimeInterface $updatedDate;
    public ?DateTimeInterface $startedDate;
    public string $type;
    public string $identifier;
    public string $action;
    /**
     * @var array<string, int>|null
     */
    public ?array $reservation;
    /**
     * @var array<string, int>|null
     */
    public ?array $transaction;
    /**
     * @var array<string, int>|null
     */
    public ?array $refund;
    /**
     * @var array<string>|null
     */
    public ?array $command;
    /**
     * @var string[]|null
     */
    public ?array $resumeTypes;
    public ?BillableCollection $billables;

    private function __construct(
        int $id,
        string $user,
        string $customer,
        string $status,
        DateTimeInterface $createdDate,
        string $type,
        string $identifier,
        string $action,
        array $command,
        ?DateTimeInterface $updatedDate,
        ?DateTimeInterface $startedDate,
        ?array $reservation,
        ?array $transaction,
        ?array $refund,
        ?array $resumeTypes,
        ?BillableCollection $billables
    ) {
        $this->id = $id;
        $this->user = $user;
        $this->customer = $customer;
        $this->status = $status;
        $this->createdDate = $createdDate;
        $this->type = $type;
        $this->identifier = $identifier;
        $this->action = $action;
        $this->command = $command;
        $this->updatedDate = $updatedDate;
        $this->startedDate = $startedDate;
        $this->reservation = $reservation;
        $this->transaction = $transaction;
        $this->refund = $refund;
        $this->resumeTypes = $resumeTypes;
        $this->billables = $billables;
    }

    public function toArray(): array
    {
        return array_filter(
            [
                'id' => $this->id,
                'user' => $this->user,
                'customer' => $this->customer,
                'status' => $this->status,
                'resumeTypes' => $this->resumeTypes,
                'createdDate' => $this->createdDate->format('Y-m-d\TH:i:s\Z'),
                'updatedDate' => $this->updatedDate ? $this->updatedDate->format('Y-m-d\TH:i:s\Z') : null,
                'startedDate' => $this->startedDate ? $this->startedDate->format('Y-m-d\TH:i:s\Z') : null,
                'action' => $this->action,
                'type' => $this->type,
                'identifier' => $this->identifier,
                'reservation' => $this->reservation,
                'transaction' => $this->transaction,
                'refund' => $this->refund,
                'command' => $this->command,
                'billables' => $this->billables ? $this->billables->toArray() : null,
            ],
            static function ($x) {
                return ! is_null($x);
            }
        );
    }

    /**
     * @throws Exception
     */
    public static function fromArray(array $json): Process
    {
        Assert::string($json['status']);

        ProcessStatusEnum::validate($json['status']);

        if (array_key_exists('resumeTypes', $json)) {
            Assert::isArray($json['resumeTypes']);

            foreach ($json['resumeTypes'] as $status) {
                ResumeTypeEnum::validate($status);
            }
        }

        return new Process(
            $json['id'],
            $json['user'],
            $json['customer'],
            $json['status'],
            new DateTimeImmutable($json['createdDate']),
            $json['type'],
            $json['identifier'],
            $json['action'],
            $json['command'],
            isset($json['updatedDate']) ? new DateTimeImmutable($json['updatedDate']) : null,
            isset($json['startedDate']) ? new DateTimeImmutable($json['startedDate']) : null,
            $json['reservation'] ?? null,
            $json['transaction'] ?? null,
            $json['refund'] ?? null,
            $json['resumeTypes'] ?? null,
            isset($json['billables']) ? BillableCollection::fromArray($json['billables']) : null
        );
    }
}
