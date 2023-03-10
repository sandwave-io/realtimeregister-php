<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;
use SandwaveIo\RealtimeRegister\Domain\Enum\DomainStatusEnum;
use Webmozart\Assert\Assert;

final class DomainDetails implements DomainObjectInterface
{
    public string $domainName;

    public string $registry;

    public string $customer;

    public string $registrant;

    public bool $privacyProtect;

    /** @var string[] */
    public array $status;

    public ?string $authcode;

    public ?string $languageCode;

    public bool $autoRenew;

    public int $autoRenewPeriod;

    /** @var string[] */
    public array $ns;

    /** @var string[] */
    public array $childHosts;

    public DateTime $createdDate;

    public ?DateTime $updatedDate;

    public DateTime $expiryDate;

    public bool $premium;

    public ?Zone $zone;

    public ?DomainContactCollection $contacts;

    public ?KeyDataCollection $keyData;

    public ?DsDataCollection $dsData;

    private function __construct(
        string $domainName,
        string $registry,
        string $customer,
        string $registrant,
        bool $privacyProtect,
        array $status,
        ?string $authcode,
        ?string $languageCode,
        bool $autoRenew,
        int $autoRenewPeriod,
        array $ns,
        array $childHosts,
        DateTime $createdDate,
        ?DateTime $updatedDate,
        DateTime $expiryDate,
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
        Assert::isArray($json['status']);

        foreach ($json['status'] as $status) {
            DomainStatusEnum::validate($status);
        }

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
            new DateTime($json['createdDate']),
            isset($json['updatedDate']) ? new DateTime($json['updatedDate']) : null,
            new DateTime($json['expiryDate']),
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
            'createdDate' => $this->createdDate->format('Y-m-d\TH:i:s\Z'),
            'updatedDate' => $this->updatedDate ? $this->updatedDate->format('Y-m-d\TH:i:s\Z') : null,
            'expiryDate' => $this->expiryDate->format('Y-m-d\TH:i:s\Z'),
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
