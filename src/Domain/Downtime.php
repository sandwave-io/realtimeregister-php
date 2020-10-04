<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Carbon\Carbon;
use TypeError;

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
        int $id,
        Carbon $startDate,
        Carbon $endDate,
        ?string $reason,
        Provider $provider
    ) {
        $this->id = $id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->reason = $reason;
        $this->provider = $provider;
    }

    public static function fromArray(array $json): Downtime
    {
        try {
            $startDate = new Carbon($json['startDate']);
        } catch (\Throwable $th) {
            throw new TypeError('Invalid start date received');
        }
        try {
            $endDate = new Carbon($json['endDate']);
        } catch (\Throwable $th) {
            throw new TypeError('Invalid end date received');
        }

        return new Downtime(
            $json['id'],
            $startDate,
            $endDate,
            $json['reason'] ?? null,
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
