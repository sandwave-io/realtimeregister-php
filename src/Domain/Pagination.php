<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class Pagination
{
    public int $limit;

    public int $offset;

    public ?int $total;

    private function __construct(int $limit, int $offset, ?int $total)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->total = $total;
    }

    public static function fromArray(array $json): Pagination
    {
        return new Pagination(
            $json['limit'],
            $json['offset'],
            $json['total'] ?? null
        );
    }
}
