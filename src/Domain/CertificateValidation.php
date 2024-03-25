<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\DocsEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\OrganizationEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\VoiceEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\WhoisEnum;

class CertificateValidation implements DomainObjectInterface
{
    public function __construct(
        public ?string $organization,
        public ?string $docs,
        public ?string $voice,
        public ?string $whois,
        public ?DomainControlValidationCollection $dcv
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'organization' => $this->organization,
            'docs' => $this->docs,
            'voice' => $this->voice,
            'whois' => $this->whois,
            'dcv' => $this->dcv?->toArray(),
        ], function ($x) {
            return ! is_null($x);
        });
    }

    public static function fromArray(array $json): CertificateValidation
    {
        if (array_key_exists('organization', $json)) {
            OrganizationEnum::validate($json['organization']);
        }
        if (array_key_exists('docs', $json)) {
            DocsEnum::validate($json['docs']);
        }
        if (array_key_exists('voice', $json)) {
            VoiceEnum::validate($json['voice']);
        }
        if (array_key_exists('whois', $json)) {
            WhoisEnum::validate($json['whois']);
        }

        return new CertificateValidation(
            $json['organization'],
            $json['docs'],
            $json['voice'],
            $json['whois'],
            $json['dcv'] ? DomainControlValidationCollection::fromArray($json['dcv']) : null,
        );
    }
}
