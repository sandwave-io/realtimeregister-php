<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\DomainZoneServiceEnum;

final class Zone implements DomainObjectInterface
{
    private function __construct(public readonly string $service, public ?string $template, public ?bool $link)
    {
    }

    public static function fromArray(array $json): self
    {
        DomainZoneServiceEnum::validate($json['service']);

        return new self(
            $json['service'],
            $json['template'] ?? null,
            $json['link'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'service' => $this->service,
            'template' => $this->template,
            'link' => $this->link,
        ], static function ($x) {
            return $x !== null;
        });
    }
}
