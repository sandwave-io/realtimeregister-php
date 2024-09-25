<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\ZoneServiceEnum;

final class Zone implements DomainObjectInterface
{
    private function __construct(public readonly ZoneServiceEnum $service, public ?string $template, public ?bool $link)
    {
    }

    public static function fromArray(array $json): self
    {
        return new self(
            ZoneServiceEnum::from($json['service']),
            $json['template'] ?? null,
            $json['link'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'service' => $this->service->value,
            'template' => $this->template,
            'link' => $this->link,
        ], static function ($x) {
            return $x !== null;
        });
    }
}
