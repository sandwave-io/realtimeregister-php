<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Carbon\Carbon;
use Webmozart\Assert\Assert;

final class DomainDetails implements DomainObjectInterface
{
    const STATUS_OK = 'OK';
    const STATUS_INACTIVE = 'INACTIVE';
    const STATUS_PENDING_TRANSFER = 'PENDING_TRANSFER';
    const STATUS_PENDING_RENEW = 'PENDING_RENEW';
    const STATUS_PENDING_UPDATE = 'PENDING_UPDATE';
    const STATUS_DELETE_REQUESTED = 'DELETE_REQUESTED';
    const STATUS_PENDING_DELETE = 'PENDING_DELETE';
    const STATUS_ADD_PERIOD = 'ADD_PERIOD';
    const STATUS_RENEW_PERIOD = 'RENEW_PERIOD';
    const STATUS_AUTO_RENEW_PERIOD = 'AUTO_RENEW_PERIOD';
    const STATUS_TRANSFER_PERIOD = 'TRANSFER_PERIOD';
    const STATUS_REDEMPTION_PERIOD = 'REDEMPTION_PERIOD';
    const STATUS_PENDING_RESTORE = 'PENDING_RESTORE';
    const STATUS_CLIENT_HOLD = 'CLIENT_HOLD';
    const STATUS_CLIENT_DELETE_PROHIBITED = 'CLIENT_DELETE_PROHIBITED';
    const STATUS_CLIENT_UPDATE_PROHIBITED = 'CLIENT_UPDATE_PROHIBITED';
    const STATUS_CLIENT_RENEW_PROHIBITED = 'CLIENT_RENEW_PROHIBITED';
    const STATUS_CLIENT_TRANSFER_PROHIBITED = 'CLIENT_TRANSFER_PROHIBITED';
    const STATUS_REGISTRAR_HOLD = 'REGISTRAR_HOLD';
    const STATUS_REGISTRAR_DELETE_PROHIBITED = 'REGISTRAR_DELETE_PROHIBITED';
    const STATUS_REGISTRAR_UPDATE_PROHIBITED = 'REGISTRAR_UPDATE_PROHIBITED';
    const STATUS_REGISTRAR_RENEW_PROHIBITED = 'REGISTRAR_RENEW_PROHIBITED';
    const STATUS_REGISTRAR_TRANSFER_PROHIBITED = 'REGISTRAR_TRANSFER_PROHIBITED';
    const STATUS_SERVER_HOLD = 'SERVER_HOLD';
    const STATUS_SERVER_DELETE_PROHIBITED = 'SERVER_DELETE_PROHIBITED';
    const STATUS_SERVER_UPDATE_PROHIBITED = 'SERVER_UPDATE_PROHIBITED';
    const STATUS_SERVER_RENEW_PROHIBITED = 'SERVER_RENEW_PROHIBITED';
    const STATUS_SERVER_TRANSFER_PROHIBITED = 'SERVER_TRANSFER_PROHIBITED';
    const STATUS_PENDING_VALIDATION = 'PENDING_VALIDATION';
    const STATUS_PRIVACY_PROTECT_PROHIBITED = 'PRIVACY_PROTECT_PROHIBITED';
    const STATUS_EXPIRED = 'EXPIRED';
    const STATUS_IRTPC_TRANSFER_PROHIBITED = 'IRTPC_TRANSFER_PROHIBITED';

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
        Assert::inArray($json['status'], [
            DomainDetails::STATUS_OK,
            DomainDetails::STATUS_INACTIVE,
            DomainDetails::STATUS_PENDING_TRANSFER,
            DomainDetails::STATUS_PENDING_RENEW,
            DomainDetails::STATUS_PENDING_UPDATE,
            DomainDetails::STATUS_DELETE_REQUESTED,
            DomainDetails::STATUS_PENDING_DELETE,
            DomainDetails::STATUS_ADD_PERIOD,
            DomainDetails::STATUS_RENEW_PERIOD,
            DomainDetails::STATUS_AUTO_RENEW_PERIOD,
            DomainDetails::STATUS_TRANSFER_PERIOD,
            DomainDetails::STATUS_REDEMPTION_PERIOD,
            DomainDetails::STATUS_PENDING_RESTORE,
            DomainDetails::STATUS_CLIENT_HOLD,
            DomainDetails::STATUS_CLIENT_DELETE_PROHIBITED,
            DomainDetails::STATUS_CLIENT_UPDATE_PROHIBITED,
            DomainDetails::STATUS_CLIENT_RENEW_PROHIBITED,
            DomainDetails::STATUS_CLIENT_TRANSFER_PROHIBITED,
            DomainDetails::STATUS_REGISTRAR_HOLD,
            DomainDetails::STATUS_REGISTRAR_DELETE_PROHIBITED,
            DomainDetails::STATUS_REGISTRAR_UPDATE_PROHIBITED,
            DomainDetails::STATUS_REGISTRAR_RENEW_PROHIBITED,
            DomainDetails::STATUS_REGISTRAR_TRANSFER_PROHIBITED,
            DomainDetails::STATUS_SERVER_HOLD,
            DomainDetails::STATUS_SERVER_DELETE_PROHIBITED,
            DomainDetails::STATUS_SERVER_UPDATE_PROHIBITED,
            DomainDetails::STATUS_SERVER_RENEW_PROHIBITED,
            DomainDetails::STATUS_SERVER_TRANSFER_PROHIBITED,
            DomainDetails::STATUS_PENDING_VALIDATION,
            DomainDetails::STATUS_PRIVACY_PROTECT_PROHIBITED,
            DomainDetails::STATUS_EXPIRED,
            DomainDetails::STATUS_IRTPC_TRANSFER_PROHIBITED,
        ]);
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
            isset($json['dsData']) ? DsDataCollection::fromArray($json['dsData']) : null
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
            'dsData' => $this->dsData ? $this->dsData->toArray() : null,
        ], function ($x) { return !is_null($x); });
    }
}
