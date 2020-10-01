<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class NotificationCollection extends AbstractCollection
{
    /** @var Notification[] */
    public $entities;

    public static function fromArray(array $json): NotificationCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Notification
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }

    public static function parseChild(array $json): Notification
    {
        return Notification::fromArray($json);
    }
}
