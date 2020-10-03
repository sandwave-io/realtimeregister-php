<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Carbon\Carbon;

final class Downtime implements DomainObjectInterface
{
    /** @var int */
    public $id;

    /** @var Carbon */
    public $startDate;

    /** @var Carbon */
    public $endDate;

    /** @var string|null */
    public $reason;

    /** @var Provider */
    public $provider;

    private function __construct(
        Carbon $startDate,
        Carbon $endDate,
        ?string $reason,
        Provider $provider
    ) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->reason = $reason;
        $this->provider = $provider;
    }

    public static function fromArray(array $json): Downtime
    {
        return new Downtime(
            new Carbon($json['startDate']),
            new Carbon($json['endDate']),
            $json['reason'],
            Provider::fromArray($json['provider'])
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'startDate' => $this->startDate->toDateTimeString(),
            'endDate' => $this->endDate->toDateTimeString(),
            'reason' => $this->reason,
            'provider' => $this->provider->toArray(),
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
