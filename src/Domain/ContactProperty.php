<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\PropertyTypeEnum;

final class ContactProperty implements DomainObjectInterface
{
    public string $name;
    public string $label;
    public string $description;
    public string $type;
    public bool $mandatory;
    /** @var array<string,string>|null */
    public ?array $values;

    private function __construct(string $name, string $label, string $description, string $type, bool $mandatory, ?array $values)
    {
        $this->name = $name;
        $this->label = $label;
        $this->description = $description;
        $this->type = $type;
        $this->mandatory = $mandatory;
        $this->values = $values;
    }

    public static function fromArray(array $json): ContactProperty
    {
        PropertyTypeEnum::validate($json['type']);
        return new ContactProperty(
            $json['name'],
            $json['label'],
            $json['description'],
            $json['type'],
            $json['mandatory'],
            $json['values'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'label' => $this->label,
            'description' => $this->description,
            'type' => $this->type,
            'mandatory' => $this->mandatory,
            'values' => $this->values ?? null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
