<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Carbon\Carbon;
use SandwaveIo\RealtimeRegister\Domain\Enum\LogStatusEnum;

final class Log implements DomainObjectInterface
{
    /** @var Carbon */
    public $date;

    /** @var string */
    public $status;

    /** @var string */
    public $message;

    private function __construct(Carbon $date, string $status, string $message)
    {
        $this->date = $date;
        $this->status = $status;
        $this->message = $message;
    }

    public static function fromArray(array $json): Log
    {
        LogStatusEnum::validate($json['status']);
        return new Log(
            new Carbon($json['date']),
            $json['status'],
            $json['message']
        );
    }

    public function toArray(): array
    {
        return [
            'date' =>$this->date->toDateTimeString(),
            'status' =>$this->status,
            'message' =>$this->message,
        ];
    }
}
