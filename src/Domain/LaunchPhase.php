<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Carbon\Carbon;

final class LaunchPhase implements DomainObjectInterface
{
    /** @var string */
    public $phase;

    /** @var Carbon|null */
    public $startDate;

    /** @var Carbon|null */
    public $endDate;

    private function __construct(string $phase, ?Carbon $startDate = null, ?Carbon $endDate = null)
    {
        $this->phase = $phase;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public static function fromArray(array $json): LaunchPhase
    {
        return new LaunchPhase(
            $json['phase'],
            $json['startDate'] ? new Carbon($json['startDate']) : null,
            $json['endDate'] ? new Carbon($json['endDate']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'phase' => $this->phase,
            'startDate' => $this->startDate ?? $this->startDate->toDateTimeString(),
            'endDate' => $this->endDate ?? $this->endDate->toDateTimeString(),
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
