<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DsDataCollection extends AbstractCollection
{
    /** @var DsData[] */
    public $entities;

    /** @var Pagination */
    public $pagination;

    /**
     * @param DsData[]   $entities
     * @param Pagination $pagination
     */
    private function __construct(array $entities, Pagination $pagination)
    {
        $this->entities = $entities;
        $this->pagination = $pagination;
    }

    public static function fromArray(array $json): DsDataCollection
    {
        $pagination = Pagination::fromArray($json['pagination']);
        $entities   = array_map(function ($country) {
            return DsData::fromArray($country);
        }, $json['entities']);

        return new DsDataCollection($entities, $pagination);
    }

    public function offsetGet($offset): ?DsData
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }
}
