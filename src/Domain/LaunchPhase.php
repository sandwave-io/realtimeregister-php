<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;

final class LaunchPhase implements DomainObjectInterface
{
    /** @var string */
    public $phase;

    /** @var DateTime|null */
    public $startDate;

    /** @var DateTime|null */
    public $endDate;

    private function __construct(string $phase, ?DateTime $startDate = null, ?DateTime $endDate = null)
    {
        $this->phase = $phase;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public static function fromArray(array $json): LaunchPhase
    {
        return new LaunchPhase(
            $json['phase'],
            isset($json['startDate']) ? new DateTime($json['startDate']) : null,
            isset($json['endDate']) ? new DateTime($json['endDate']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'phase' => $this->phase,
            'startDate' => $this->startDate ? $this->startDate->format('Y-m-d H:i:s') : null,
            'endDate' => $this->endDate ? $this->endDate->format('Y-m-d H:i:s') : null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
