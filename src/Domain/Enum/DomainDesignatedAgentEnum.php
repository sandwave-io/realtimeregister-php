<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class DomainDesignatedAgentEnum extends AbstractEnum
{
    const AGENT_NONE = 'NONE';
    const AGENT_OLD = 'OLD';
    const AGENT_NEW = 'NEW';
    const AGENT_BOTH = 'BOTH';

    protected static $values = [
        DomainDesignatedAgentEnum::AGENT_NONE,
        DomainDesignatedAgentEnum::AGENT_OLD,
        DomainDesignatedAgentEnum::AGENT_NEW,
        DomainDesignatedAgentEnum::AGENT_BOTH,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        DomainDesignatedAgentEnum::assertValueValid($value);
    }
}
