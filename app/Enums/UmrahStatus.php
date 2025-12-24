<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelper;

enum UmrahStatus: string
{
    use EnumHelper;
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Cancelled = 'cancelled';
    case Completed = 'completed';
}
