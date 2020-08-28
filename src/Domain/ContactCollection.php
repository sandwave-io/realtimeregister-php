<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class ContactCollection extends AbstractCollection
{
    /** @var Contact[] */
    public $entities;

    /** @var Pagination */
    public $pagination;

    /**
     * @param Contact[]  $entities
     * @param Pagination $pagination
     */
    private function __construct(array $entities, Pagination $pagination)
    {
        $this->entities = $entities;
        $this->pagination = $pagination;
    }

    public static function fromArray(array $json): ContactCollection
    {
        $pagination = Pagination::fromArray($json['pagination']);
        $entities   = array_map(function ($country) {
            return Contact::fromArray($country);
        }, $json['entities']);

        return new ContactCollection($entities, $pagination);
    }

    public function offsetGet($offset): ?Contact
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }
}
