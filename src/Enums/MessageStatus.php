<?php

namespace Zorb\Sender\Enums;

use BenSampo\Enum\Enum;

final class MessageStatus extends Enum
{
    const Pending = 0;
    const Delivered = 1;
    const Undelivered = 2;
}
