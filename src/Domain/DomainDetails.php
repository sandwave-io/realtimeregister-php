<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Carbon\Carbon;
use SandwaveIo\RealtimeRegister\Domain\Enum\DomainStatusEnum;

final class DomainDetails implements DomainObjectInterface
{
    /** @var string */
    public $domainName;

    /** @var string */
    public $registry;

    /** @var string */
    public $customer;

    /** @var string */
    public $registrant;

    /** @var bool */
    public $privacyProtect;

    /** @var string */
    public $status;

    /** @var string|null */
    public $authcode;

    /** @var string|null */
    public $languageCode;

    /** @var bool */
    public $autoRenew;

    /** @var int */
    public $autoRenewPeriod;

    /** @var string[] */
    public $ns;

    /** @var string[] */
    public $childHosts;

    /** @var Carbon */
    public $createdDate;

    /** @var Carbon|null */
    public $updatedDate;

    /** @var Carbon */
    public $expiryDate;

    /** @var bool */
    public $premium;

    /** @var Zone|null */
    public $zone;

    /** @var DomainContactCollection|null */
    public $contacts;

    /** @var KeyDataCollection|null */
    public $keyData;

    /** @var DsDataCollection|null */
    public $dsData;

    private function __construct(
        string $domainName,
        string $registry,
        string $customer,
        string $registrant,
        bool $privacyProtect,
        string $status,
        ?string $authcode,
        ?string $languageCode,
        bool $autoRenew,
        int $autoRenewPeriod,
        array $ns,
        array $childHosts,
        Carbon $createdDate,
        ?Carbon $updatedDate,
        Carbon $expiryDate,
        bool $premium,
        ?Zone $zone,
        ?DomainContactCollection $contacts,
        ?KeyDataCollection $keyData,
        ?DsDataCollection $dsData
    ) {
        $this->domainName = $domainName;
        $this->registry = $registry;
        $this->customer = $customer;
        $this->registrant = $registrant;
        $this->privacyProtect = $privacyProtect;
        $this->status = $status;
        $this->authcode = $authcode;
        $this->languageCode = $languageCode;
        $this->autoRenew = $autoRenew;
        $this->autoRenewPeriod = $autoRenewPeriod;
        $this->ns = $ns;
        $this->childHosts = $childHosts;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        $this->expiryDate = $expiryDate;
        $this->premium = $premium;
        $this->zone = $zone;
        $this->contacts = $contacts;
        $this->keyData = $keyData;
        $this->dsData = $dsData;
    }

    public static function fromArray(array $json): DomainDetails
    {
        DomainStatusEnum::validate($json['status']);

        return new DomainDetails(
            $json['domainName'],
            $json['registry'],
            $json['customer'],
            $json['registrant'],
            $json['privacyProtect'],
            $json['status'],
            $json['authcode'] ?? null,
            $json['languageCode'] ?? null,
            $json['autoRenew'],
            $json['autoRenewPeriod'],
            $json['ns'] ?? [],
            $json['childHosts'] ?? [],
            new Carbon($json['createdDate']),
            $json['updatedDate'] ? new Carbon($json['updatedDate']) : null,
            new Carbon($json['expiryDate']),
            $json['premium'],
            isset($json['zone']) ? Zone::fromArray($json['zone']) : null,
            isset($json['contacts']) ? DomainContactCollection::fromArray($json['contacts']) : null,
            isset($json['keyData']) ? KeyDataCollection::fromArray($json['keyData']) : null,
            isset($json['ds_data']) ? DsDataCollection::fromArray($json['ds_data']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'domainName' => $this->domainName,
            'registry' => $this->registry,
            'customer' => $this->customer,
            'registrant' => $this->registrant,
            'privacyProtect' => $this->privacyProtect,
            'status' => $this->status,
            'authcode' => $this->authcode,
            'languageCode' => $this->languageCode,
            'autoRenew' => $this->autoRenew,
            'autoRenewPeriod' => $this->autoRenewPeriod,
            'ns' => $this->ns,
            'childHosts' => $this->childHosts,
            'createdDate' => $this->createdDate->toDateTimeString(),
            'updatedDate' => $this->updatedDate ? $this->updatedDate->toDateTimeString() : null,
            'expiryDate' => $this->expiryDate->toDateTimeString(),
            'premium' => $this->premium,
            'zone' => $this->zone ? $this->zone->toArray() : null,
            'contacts' => $this->contacts ? $this->contacts->toArray() : null,
            'keyData' => $this->keyData ? $this->keyData->toArray() : null,
            'ds_data' => $this->dsData ? $this->dsData->toArray() : null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
