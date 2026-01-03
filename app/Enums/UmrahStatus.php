<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelper;

enum UmrahStatus: string
{
    use EnumHelper;
    case Registered = 'registered';
    case Cancelled = 'cancelled';
    case Completed = 'completed';
}
