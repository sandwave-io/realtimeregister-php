<?php

declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Exception;

class ProcessCollection extends AbstractCollection
{
    /** @var Process[] */
    public array $entities;

    public static function fromArray(array $json): ProcessCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Process
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }

    /**
     * @throws Exception
     */
    public static function parseChild(array $json): Process
    {
        return Process::fromArray($json);
    }
}
