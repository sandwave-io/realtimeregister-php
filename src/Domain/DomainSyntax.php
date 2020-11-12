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

    /** @var string|null */
    public $allowedCharacters;

    /** @var LanguageCodes|null */
    public $languageCodes;

    private function __construct(int $minLength, int $maxLength, bool $idnSupport, ?string $allowedCharacters, ?LanguageCodes $languageCodes)
    {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
        $this->idnSupport = $idnSupport;
        $this->allowedCharacters = $allowedCharacters;
        $this->languageCodes = $languageCodes;
    }

    public static function fromArray(array $json): DomainSyntax
    {
        return new DomainSyntax(
            $json['minLength'],
            $json['maxLength'],
            $json['idnSupport'],
            $json['allowedCharacters'] ?? null,
            isset($json['languageCodes']) ? LanguageCodes::fromArray($json['languageCodes']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'minLength' =>$this->minLength,
            'maxLength' =>$this->maxLength,
            'idnSupport' =>$this->idnSupport,
            'allowedCharacters' =>$this->allowedCharacters,
            'languageCodes' => $this->languageCodes ? $this->languageCodes->toArray() : null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
