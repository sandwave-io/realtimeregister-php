<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class TLDMetaData implements DomainObjectInterface
{
    /** @var array<int> */
    public $createDomainPeriods;

    /** @var array<int> */
    public $renewDomainPeriods;

    /** @var array<int> */
    public $autoRenewDomainPeriods;

    /** @var array<int> */
    public $transferDomainPeriods;

    /** @var int|null */
    public $redemptionPeriod;

    /** @var int|null */
    public $pendingDeletePeriod;

    /** @var int|null */
    public $addGracePeriod;

    /** @var int|null */
    public $renewGracePeriod;

    /** @var int|null */
    public $autoRenewGracePeriod;

    /** @var int|null */
    public $transferGracePeriod;

    /** @var int|null */
    public $expiryDateOffset;

    /** @var bool */
    public $transferFOA;

    /** @var bool */
    public $adjustableAuthCode;

    /** @var bool */
    public $customAuthcodeSupport;

    /** @var bool */
    public $transferSupportsAuthcode;

    /** @var bool */
    public $transferRequiresAuthcode;

    /** @var bool */
    public $creationRequiresPreValidation;

    /** @var string */
    public $zoneCheck;

    /** @var array|null */
    public $possibleClientDomainStatuses;

    /** @var int|null */
    public $allowedDnssecRecords;

    /** @var array|null */
    public $allowedDnssecAlgorithms;

    /** @var string|null */
    public $validationCategory;

    /** @var array */
    public $featuresAvailable;

    /** @var bool */
    public $registrantChangeApprovalRequired;

    /** @var string|null */
    public $allowDesignatedAgent;

    /** @var string|null */
    public $jurisdiction;

    /** @var string|null */
    public $thermsOfService;

    /** @var string|null */
    public $privacyPolicy;

    /** @var string */
    public $whoisExposure;

    /** @var string */
    public $gdprCategory;

    public $domainSyntax;
    public $nameservers;
    public $registrant;
    public $adminContacts;
    public $billingContacts;
    public $techContacts;
    public $contactProperties;
    public $launchPhases;




    private function __construct(
        array $createDomainPeriods,
        array $renewDomainPeriods,
        array $autoRenewDomainPeriods,
        array $transferDomainPeriods,
        bool $transferFOA,
        bool $adjustableAuthCode,
        bool $customAuthcodeSupport,
        bool $transferSupportsAuthcode,
        bool $transferRequiresAuthcode,
        bool $creationRequiresPreValidation,
        string $zoneCheck,
        string $whoisExposure,
        string $gdprCategory,
        $domainSyntax,
        $nameservers,
        $registrant,
        $adminContacts,
        $billingContacts,
        $techContacts,
        $contactProperties,
        $launchPhases,
        ?int $redemptionPeriod = null,
        ?int $pendingDeletePeriod = null,
        ?int $addGracePeriod = null,
        ?int $renewGracePeriod = null,
        ?int $autoRenewGracePeriod = null,
        ?int $transferGracePeriod = null,
        ?int $expiryDateOffset = null,
        ?array $possibleClientDomainStatuses = null,
        ?int $allowedDnssecRecords = null,
        ?array $allowedDnssecAlgorithms = null,
        ?string $validationCategory = null,
        ?array $featuresAvailable = null,
        bool $registrantChangeApprovalRequired,
        ?string $allowDesignatedAgent = null,
        ?string $jurisdiction = null,
        ?string $thermsOfService = null,
        ?string $privacyPolicy = null
    ) {
        $this->createDomainPeriods = $createDomainPeriods;
        $this->renewDomainPeriods = $renewDomainPeriods;
        $this->autoRenewDomainPeriods = $autoRenewDomainPeriods;
        $this->transferDomainPeriods = $transferDomainPeriods;
        $this->transferFOA = $transferFOA;
        $this->adjustableAuthCode = $adjustableAuthCode;
        $this->customAuthcodeSupport = $customAuthcodeSupport;
        $this->transferSupportsAuthcode = $transferSupportsAuthcode;
        $this->transferRequiresAuthcode = $transferRequiresAuthcode;
        $this->creationRequiresPreValidation = $creationRequiresPreValidation;
        $this->zoneCheck = $zoneCheck;
        $this->whoisExposure = $whoisExposure;
        $this->gdprCategory = $gdprCategory;
        $this->domainSyntax = $domainSyntax;
        $this->nameservers = $nameservers;
        $this->registrant = $registrant;
        $this->adminContacts = $adminContacts;
        $this->billingContacts = $billingContacts;
        $this->techContacts = $techContacts;
        $this->contactProperties = $contactProperties;
        $this->launchPhases = $launchPhases;
        $this->redemptionPeriod = $redemptionPeriod;
        $this->pendingDeletePeriod = $pendingDeletePeriod;
        $this->addGracePeriod = $addGracePeriod;
        $this->renewGracePeriod = $renewGracePeriod;
        $this->autoRenewGracePeriod = $autoRenewGracePeriod;
        $this->transferGracePeriod = $transferGracePeriod;
        $this->expiryDateOffset = $expiryDateOffset;
        $this->possibleClientDomainStatuses = $possibleClientDomainStatuses;
        $this->allowedDnssecRecords = $allowedDnssecRecords;
        $this->allowedDnssecAlgorithms = $allowedDnssecAlgorithms;
        $this->validationCategory = $validationCategory;
        $this->featuresAvailable = $featuresAvailable;
        $this->registrantChangeApprovalRequired = $registrantChangeApprovalRequired;
        $this->allowDesignatedAgent = $allowDesignatedAgent;
        $this->jurisdiction = $jurisdiction;
        $this->thermsOfService = $thermsOfService;
        $this->privacyPolicy = $privacyPolicy;
    }

    public static function fromArray(array $data): TLDMetaData
    {
        return new TLDMetaData(
            $data['createDomainPeriods'],
            $data['renewDomainPeriods'],
            $data['autoRenewDomainPeriods'],
            $data['transferDomainPeriods'],
            $data['transferFOA'],
            $data['adjustableAuthCode'],
            $data['customAuthcodeSupport'],
            $data['transferSupportsAuthcode'],
            $data['transferRequiresAuthcode'],
            $data['creationRequiresPreValidation'],
            $data['zoneCheck'],
            $data['whoisExposure'],
            $data['gdprCategory'],
            $data['domainSyntax'],
            $data['nameservers'],
            $data['registrant'],
            $data['adminContacts'],
            $data['billingContacts'],
            $data['techContacts'],
            $data['contactProperties'],
            $data['launchPhases'],
            $data['redemptionPeriod'] ?? null,
            $data['pendingDeletePeriod'] ?? null,
            $data['addGracePeriod'] ?? null,
            $data['renewGracePeriod'] ?? null,
            $data['autoRenewGracePeriod'] ?? null,
            $data['transferGracePeriod'] ?? null,
            $data['expiryDateOffset'] ?? null,
            $data['possibleClientDomainStatuses'] ?? null,
            $data['allowedDnssecRecords'] ?? null,
            $data['allowedDnssecAlgorithms'] ?? null,
            $data['validationCategory'] ?? null,
            $data['featuresAvailable'] ?? null,
            $data['registrantChangeApprovalRequired'] ?? null,
            $data['allowDesignatedAgent'] ?? null,
            $data['jurisdiction'] ?? null,
            $data['thermsOfService'] ?? null,
            $data['privacyPolicy'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            $this->createDomainPeriods,
            $this->renewDomainPeriods,
            $this->autoRenewDomainPeriods,
            $this->transferDomainPeriods,
            $this->transferFOA,
            $this->adjustableAuthCode,
            $this->customAuthcodeSupport,
            $this->transferSupportsAuthcode,
            $this->transferRequiresAuthcode,
            $this->creationRequiresPreValidation,
            $this->zoneCheck,
            $this->whoisExposure,
            $this->gdprCategory,
            $this->domainSyntax,
            $this->nameservers,
            $this->registrant,
            $this->adminContacts,
            $this->billingContacts,
            $this->techContacts,
            $this->contactProperties,
            $this->launchPhases,
            $this->redemptionPeriod,
            $this->pendingDeletePeriod,
            $this->addGracePeriod,
            $this->renewGracePeriod,
            $this->autoRenewGracePeriod,
            $this->transferGracePeriod,
            $this->expiryDateOffset,
            $this->possibleClientDomainStatuses,
            $this->allowedDnssecRecords,
            $this->allowedDnssecAlgorithms,
            $this->validationCategory,
            $this->featuresAvailable,
            $this->registrantChangeApprovalRequired,
            $this->allowDesignatedAgent,
            $this->jurisdiction,
            $this->thermsOfService,
            $this->privacyPolicy,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
