<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class NotificationPollCollection extends AbstractCollection
{
    /** @var NotificationPoll[] */
    public $entities;

    public static function fromArray(array $json): NotificationPollCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?NotificationPoll
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }

    public static function parseChild(array $json): NotificationPoll
    {
        return NotificationPoll::fromArray($json);
    }
}
