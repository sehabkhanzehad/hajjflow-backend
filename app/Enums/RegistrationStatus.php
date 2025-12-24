<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelper;

enum RegistrationStatus: string
{
    use EnumHelper;
    case Active = 'active';
    case Cancelled = 'cancelled';
    case Completed = 'completed';
    case Transferred = 'transferred';
}
