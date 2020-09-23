<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DomainSyntax implements DomainObjectInterface
{
    /** @var int */
    public $minLength;

    /** @var int */
    public $maxLength;

    /** @var bool */
    public $idnSupport;

    /** @var string */
    public $allowedCharacters;

    private function __construct(int $minLength, int $maxLength, bool $idnSupport, string $allowedCharacters)
    {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
        $this->idnSupport = $idnSupport;
        $this->allowedCharacters = $allowedCharacters;
    }

    public static function fromArray(array $json): DomainSyntax
    {
        return new DomainSyntax(
            $json['minLength'],
            $json['maxLength'],
            $json['idnSupport'] ?? null,
            $json['allowedCharacters'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'minLength' =>$this->minLength,
            'maxLength' =>$this->maxLength,
            'idnSupport' =>$this->idnSupport,
            'allowedCharacters' =>$this->allowedCharacters,
        ];
    }
}
