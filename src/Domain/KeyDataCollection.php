<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class KeyDataCollection extends AbstractCollection
{
    /** @var KeyData[] */
    public $entities;

    /** @var Pagination */
    public $pagination;

    /**
     * @param KeyData[]  $entities
     * @param Pagination $pagination
     */
    private function __construct(array $entities, Pagination $pagination)
    {
        $this->entities = $entities;
        $this->pagination = $pagination;
    }

    public static function fromArray(array $json): KeyDataCollection
    {
        $pagination = Pagination::fromArray($json['pagination']);
        $entities   = array_map(function ($country) {
            return KeyData::fromArray($country);
        }, $json['entities']);

        return new KeyDataCollection($entities, $pagination);
    }

    public function offsetGet($offset): ?KeyData
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }
}
