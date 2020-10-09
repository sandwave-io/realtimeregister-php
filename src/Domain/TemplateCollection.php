<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class TemplateCollection extends AbstractCollection
{
    /** @var Template[] */
    public $entities;

    public static function fromArray(array $json): TemplateCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Template
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }

    public static function parseChild(array $json): Template
    {
        return Template::fromArray($json);
    }
}
