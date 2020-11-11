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

    /** @var array<int>|null */
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
    public $termsOfService;

    /** @var string|null */
    public $privacyPolicy;

    /** @var string */
    public $whoisExposure;

    /** @var string */
    public $gdprCategory;

    /** @var DomainSyntax */
    public $domainSyntax;

    /** @var Nameservers */
    public $nameservers;

    /** @var Registrant */
    public $registrant;

    /** @var ContactsConstraint */
    public $adminContacts;

    /** @var ContactsConstraint */
    public $billingContacts;

    /** @var ContactsConstraint */
    public $techContacts;

    /** @var ContactPropertyCollection|null */
    public $contactProperties;

    /** @var LaunchPhaseCollection|null */
    public $launchPhases;

    private function __construct(
        array $createDomainPeriods,
        array $renewDomainPeriods,
        array $autoRenewDomainPeriods,
        bool $transferFOA,
        bool $adjustableAuthCode,
        bool $customAuthcodeSupport,
        bool $transferSupportsAuthcode,
        bool $transferRequiresAuthcode,
        bool $creationRequiresPreValidation,
        string $zoneCheck,
        string $whoisExposure,
        string $gdprCategory,
        DomainSyntax $domainSyntax,
        Nameservers $nameservers,
        Registrant $registrant,
        ContactsConstraint $adminContacts,
        ContactsConstraint $billingContacts,
        ContactsConstraint $techContacts,
        ?ContactPropertyCollection $contactProperties,
        ?LaunchPhaseCollection $launchPhases,
        ?int $redemptionPeriod,
        ?int $pendingDeletePeriod,
        ?int $addGracePeriod,
        ?int $renewGracePeriod,
        ?int $autoRenewGracePeriod,
        ?int $transferGracePeriod,
        ?int $expiryDateOffset,
        ?array $transferDomainPeriods,
        ?array $possibleClientDomainStatuses,
        ?int $allowedDnssecRecords,
        ?array $allowedDnssecAlgorithms,
        ?string $validationCategory,
        array $featuresAvailable,
        bool $registrantChangeApprovalRequired,
        ?string $allowDesignatedAgent = null,
        ?string $jurisdiction = null,
        ?string $termsOfService = null,
        ?string $privacyPolicy = null
    ) {
        $this->createDomainPeriods = $createDomainPeriods;
        $this->renewDomainPeriods = $renewDomainPeriods;
        $this->autoRenewDomainPeriods = $autoRenewDomainPeriods;
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
        $this->transferDomainPeriods = $transferDomainPeriods;
        $this->possibleClientDomainStatuses = $possibleClientDomainStatuses;
        $this->allowedDnssecRecords = $allowedDnssecRecords;
        $this->allowedDnssecAlgorithms = $allowedDnssecAlgorithms;
        $this->validationCategory = $validationCategory;
        $this->featuresAvailable = $featuresAvailable;
        $this->registrantChangeApprovalRequired = $registrantChangeApprovalRequired;
        $this->allowDesignatedAgent = $allowDesignatedAgent;
        $this->jurisdiction = $jurisdiction;
        $this->termsOfService = $termsOfService;
        $this->privacyPolicy = $privacyPolicy;
    }

    public static function fromArray(array $data): TLDMetaData
    {
        if (isset($data['possibleClientDomainStatuses'])) {
            Assert::isArray($data['possibleClientDomainStatuses']);
            foreach ($data['possibleClientDomainStatuses'] as $status) {
                DomainPossibleClientDomainStatusEnum::validate($status);
            }
        }
        if (isset($data['allowedDnssecAlgorithms'])) {
            Assert::isArray($data['allowedDnssecAlgorithms']);
            foreach ($data['allowedDnssecAlgorithms'] as $algo) {
                KeyDataAlgorithmEnum::validate($algo);
            }
        }
        if (isset($data['validationCategory'])) {
            ValidationCategoryEnum::validate($data['validationCategory']);
        }
        foreach ($data['featuresAvailable'] as $feature) {
            DomainFeatureEnum::validate($feature);
        }
        if (isset($data['allowDesignatedAgent'])) {
            DomainDesignatedAgentEnum::validate($data['allowDesignatedAgent']);
        }
        WhoisExposureEnum::validate($data['whoisExposure']);
        GDPRCategoryEnum::validate($data['gdprCategory']);

        return new TLDMetaData(
            $data['createDomainPeriods'],
            $data['renewDomainPeriods'],
            $data['autoRenewDomainPeriods'],
            $data['transferFOA'],
            $data['adjustableAuthCode'],
            $data['customAuthcodeSupport'],
            $data['transferSupportsAuthcode'],
            $data['transferRequiresAuthcode'],
            $data['creationRequiresPreValidation'],
            $data['zoneCheck'],
            $data['whoisExposure'],
            $data['gdprCategory'],
            DomainSyntax::fromArray($data['domainSyntax']),
            Nameservers::fromArray($data['nameservers']),
            Registrant::fromArray($data['registrant']),
            ContactsConstraint ::fromArray($data['adminContacts']),
            ContactsConstraint ::fromArray($data['billingContacts']),
            ContactsConstraint ::fromArray($data['techContacts']),
            isset($data['contactProperties']) ? ContactPropertyCollection::fromArray($data['contactProperties']) : null,
            isset($data['launchPhases']) ? LaunchPhaseCollection::fromArray($data['launchPhases']) : null,
            $data['redemptionPeriod'] ?? null,
            $data['pendingDeletePeriod'] ?? null,
            $data['addGracePeriod'] ?? null,
            $data['renewGracePeriod'] ?? null,
            $data['autoRenewGracePeriod'] ?? null,
            $data['transferGracePeriod'] ?? null,
            $data['expiryDateOffset'] ?? null,
            $data['transferDomainPeriods'] ?? null,
            $data['possibleClientDomainStatuses'] ?? null,
            $data['allowedDnssecRecords'] ?? null,
            $data['allowedDnssecAlgorithms'] ?? null,
            $data['validationCategory'] ?? null,
            $data['featuresAvailable'] ?? null,
            $data['registrantChangeApprovalRequired'] ?? null,
            $data['allowDesignatedAgent'] ?? null,
            $data['jurisdiction'] ?? null,
            $data['termsOfService'] ?? null,
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
            'creationRequiresPreValidation' => $this->creationRequiresPreValidation,
            'zoneCheck' => $this->zoneCheck,
            'possibleClientDomainStatuses' => $this->possibleClientDomainStatuses,
            'allowedDnssecRecords' => $this->allowedDnssecRecords,
            'allowedDnssecAlgorithms' => $this->allowedDnssecAlgorithms,
            'validationCategory' => $this->validationCategory,
            'featuresAvailable' => $this->featuresAvailable,
            'registrantChangeApprovalRequired' => $this->registrantChangeApprovalRequired,
            'allowDesignatedAgent' => $this->allowDesignatedAgent,
            'jurisdiction' => $this->jurisdiction,
            'termsOfService' => $this->termsOfService,
            'privacyPolicy' => $this->privacyPolicy,
            'whoisExposure' => $this->whoisExposure,
            'gdprCategory' => $this->gdprCategory,
            'domainSyntax' => $this->domainSyntax->toArray(),
            'nameservers' => $this->nameservers->toArray(),
            'registrant' => $this->registrant->toArray(),
            'adminContacts' => $this->adminContacts->toArray(),
            'billingContacts' => $this->billingContacts->toArray(),
            'techContacts' => $this->techContacts->toArray(),
            'contactProperties' => $this->contactProperties ? $this->contactProperties->toArray() : null,
            'launchPhases' => $this->launchPhases ? $this->launchPhases->toArray() : null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
