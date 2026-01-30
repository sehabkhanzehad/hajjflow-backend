<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelper;

enum RegistrationStatus: string
{
    use EnumHelper;
    case Active = 'active';
    case Completed = 'completed';
}
