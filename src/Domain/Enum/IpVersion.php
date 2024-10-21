<?php

declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

enum IpVersion: string
{
    case V4 = 'V4';
    case V6 = 'V6';
}
