<?php

declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

class ProcessInfo implements DomainObjectInterface
{
    private string $commonName;
    private bool $requiresAttention;
    private ?array $validations;
    private ?array $notes;

    public function __construct(
        string $commonName,
        bool $requiresAttention,
        ?array $validations,
        ?array $notes
    ) {
        $this->commonName = $commonName;
        $this->requiresAttention = $requiresAttention;
        $this->validations = $validations;
        $this->notes = $notes;
    }

    public function toArray(): array
    {
        return array_filter([
            'commonName' => $this->commonName,
            'requiresAttention' => $this->requiresAttention,
            'validations' => $this->validations,
            'notes' => $this->notes,
        ], fn ($v) => ! is_null($v));
    }

    public static function fromArray(array $json): self
    {
        return new self(
            $json['commonName'],
            $json['requiresAttention'],
            $json['validations'] ?? null,
            $json['notes'] ?? null
        );
    }
}
