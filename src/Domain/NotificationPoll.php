<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class NotificationPoll implements DomainObjectInterface
{
    /** @var string */
    public $count;

    /** @var Notification|null */
    public $notification;

    private function __construct(string $count, ?Notification $notification = null)
    {
        $this->count = $count;
        $this->notification = $notification;
    }

    public static function fromArray(array $json): NotificationPoll
    {
        return new NotificationPoll(
            $json['count'],
            isset($json['notification']) ? Notification::fromArray($json['notification']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'count' => $this->count,
            'notification' => $this->notification ? $this->notification->toArray() : null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
