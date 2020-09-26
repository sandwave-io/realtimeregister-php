<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class NotificationPoll implements DomainObjectInterface
{
    /** @var string */
    public $count;

    /** @var array<string>|null */
    public $notification;

    private function __construct(string $count, ?array $notification)
    {
        $this->count = $count;
        $this->notification = $notification;
    }

    public static function fromArray(array $json): NotificationPoll
    {
        return new NotificationPoll(
            $json['count'],
            $json['notification'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'count' => $this->count,
            'notification' => $this->notification,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
