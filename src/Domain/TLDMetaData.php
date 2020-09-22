<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\DomainDesignatedAgentEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\DomainFeatureEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\DomainPossibleClientDomainStatusEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\GDPRCategoryEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\KeyDataAlgorithmEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\ValidationCategoryEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\WhoisExposureEnum;
use Webmozart\Assert\Assert;

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
        if (! is_null($data['possibleClientDomainStatuses'])) {
            Assert::isArray($data['possibleClientDomainStatuses']);
            foreach ($data['possibleClientDomainStatuses'] as $status) {
                DomainPossibleClientDomainStatusEnum::validate($status);
            }
        }
        if (! is_null($data['allowedDnssecAlgorithms'])) {
            Assert::isArray($data['allowedDnssecAlgorithms']);
            foreach ($data['allowedDnssecAlgorithms'] as $algo) {
                KeyDataAlgorithmEnum::validate($algo);
            }
        }
        if (! is_null($data['validationCategory'])) {
            ValidationCategoryEnum::validate($data['validationCategory']);
        }
        foreach ($data['featuresAvailable'] as $feature) {
            DomainFeatureEnum::validate($feature);
        }
        DomainDesignatedAgentEnum::validate($data['allowDesignatedAgent']);
        WhoisExposureEnum::validate($data['whoisExposure']);
        GDPRCategoryEnum::validate($data['gdprCategory']);

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
            'createDomainPeriods' => $this->createDomainPeriods,
            'renewDomainPeriods' => $this->renewDomainPeriods,
            'autoRenewDomainPeriods' => $this->autoRenewDomainPeriods,
            'transferDomainPeriods' => $this->transferDomainPeriods,
            'transferFOA' => $this->transferFOA,
            'adjustableAuthCode' => $this->adjustableAuthCode,
            'customAuthcodeSupport' => $this->customAuthcodeSupport,
            'transferSupportsAuthcode' => $this->transferSupportsAuthcode,
            'transferRequiresAuthcode' => $this->transferRequiresAuthcode,
            'creationRequiresPreValidation' => $this->creationRequiresPreValidation,
            'zoneCheck' => $this->zoneCheck,
            'whoisExposure' => $this->whoisExposure,
            'gdprCategory' => $this->gdprCategory,
            'domainSyntax' => $this->domainSyntax,
            'nameservers' => $this->nameservers,
            'registrant' => $this->registrant,
            'adminContacts' => $this->adminContacts,
            'billingContacts' => $this->billingContacts,
            'techContacts' => $this->techContacts,
            'contactProperties' => $this->contactProperties,
            'launchPhases' => $this->launchPhases,
            'redemptionPeriod' => $this->redemptionPeriod,
            'pendingDeletePeriod' => $this->pendingDeletePeriod,
            'addGracePeriod' => $this->addGracePeriod,
            'renewGracePeriod' => $this->renewGracePeriod,
            'autoRenewGracePeriod' => $this->autoRenewGracePeriod,
            'transferGracePeriod' => $this->transferGracePeriod,
            'expiryDateOffset' => $this->expiryDateOffset,
            'possibleClientDomainStatuses' => $this->possibleClientDomainStatuses,
            'allowedDnssecRecords' => $this->allowedDnssecRecords,
            'allowedDnssecAlgorithms' => $this->allowedDnssecAlgorithms,
            'validationCategory' => $this->validationCategory,
            'featuresAvailable' => $this->featuresAvailable,
            'registrantChangeApprovalRequired' => $this->registrantChangeApprovalRequired,
            'allowDesignatedAgent' => $this->allowDesignatedAgent,
            'jurisdiction' => $this->jurisdiction,
            'thermsOfService' => $this->thermsOfService,
            'privacyPolicy' => $this->privacyPolicy,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
