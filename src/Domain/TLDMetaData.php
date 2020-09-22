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
    public $launchPhases;






    /** @var TldMetaData */
    public $metadata;

    private function __construct(
        array $createDomainPeriods,
        array $renewDomainPeriods,
        array $autoRenewDomainPeriods,
        array $transferDomainPeriods,
        ?int $redemptionPeriod = null,
        ?int $pendingDeletePeriod = null,
        ?int $addGracePeriod = null,
        ?int $renewGracePeriod = null,
        ?int $autoRenewGracePeriod = null,
        ?int $transferGracePeriod = null,
        ?int $expiryDateOffset = null,
        bool $transferFOA = null,
        bool $adjustableAuthCode = null,
        bool $customAuthcodeSupport = null,
        bool $transferSupportsAuthcode = null,
        bool $transferRequiresAuthcode = null,
        bool $creationRequiresPreValidation = null,
        string $zoneCheck,
        ?array $possibleClientDomainStatuses = null,




        int $metadata
    ) {
        $this->createDomainPeriods = $createDomainPeriods;
        $this->renewDomainPeriods = $renewDomainPeriods;
        $this->autoRenewDomainPeriods = $autoRenewDomainPeriods;
        $this->transferDomainPeriods = $transferDomainPeriods;
        $this->redemptionPeriod = $redemptionPeriod;
        $this->pendingDeletePeriod = $pendingDeletePeriod;
        $this->addGracePeriod = $addGracePeriod;
        $this->renewGracePeriod = $renewGracePeriod;
        $this->autoRenewGracePeriod = $autoRenewGracePeriod;
        $this->transferGracePeriod = $transferGracePeriod;
        $this->expiryDateOffset = $expiryDateOffset;
        $this->transferFOA = $transferFOA;
        $this->adjustableAuthCode = $adjustableAuthCode;
        $this->customAuthcodeSupport = $customAuthcodeSupport;
        $this->transferSupportsAuthcode = $transferSupportsAuthcode;
        $this->transferRequiresAuthcode = $transferRequiresAuthcode;
        $this->creationRequiresPreValidation = $creationRequiresPreValidation;
        $this->zoneCheck = $zoneCheck;







        $this->metadata = $metadata;
    }

    public static function fromArray(array $data): TLDMetaData
    {
        return new TLDMetaData(
            $data['createDomainPeriods'],
            $data['renewDomainPeriods'],
            $data['autoRenewDomainPeriods'],
            $data['transferDomainPeriods'],
            $data['redemptionPeriod'] ?? null,
            $data['pendingDeletePeriod'] ?? null,
            $data['addGracePeriod'] ?? null,
            $data['renewGracePeriod'] ?? null,
            $data['autoRenewGracePeriod'] ?? null,
            $data['transferGracePeriod'] ?? null,
            $data['expiryDateOffset'] ?? null,
            $data['transferFOA'],
            $data['adjustableAuthCode'],
            $data['customAuthcodeSupport'],
            $data['transferSupportsAuthcode'],
            $data['transferRequiresAuthcode'],
            $data['creationRequiresPreValidation'],
            $data['zoneCheck'],






            $data['metadata']
        );
    }

    public function toArray(): array
    {
        return [
            'createDomainPeriods' => $this->createDomainPeriods,
            'renewDomainPeriods' => $this->renewDomainPeriods,
            'autoRenewDomainPeriods' => $this->autoRenewDomainPeriods,
            'transferDomainPeriods' => $this->transferDomainPeriods,
            'redemptionPeriod' => $this->redemptionPeriod,
            'pendingDeletePeriod' => $this->pendingDeletePeriod,
            'addGracePeriod' => $this->addGracePeriod,
            'renewGracePeriod' => $this->renewGracePeriod,
            'autoRenewGracePeriod' => $this->autoRenewGracePeriod,
            'transferGracePeriod' => $this->transferGracePeriod,
            'expiryDateOffset' => $this->expiryDateOffset,
            'transferFOA' => $this->transferFOA,
            'adjustableAuthCode' => $this->adjustableAuthCode,
            'customAuthcodeSupport' => $this->customAuthcodeSupport,
            'transferSupportsAuthcode' => $this->transferSupportsAuthcode,
            'transferRequiresAuthcode' => $this->transferRequiresAuthcode,
            'zoneCheck' => $this->zoneCheck,









            'metadata' => $this->metadata,
        ];
    }
}
