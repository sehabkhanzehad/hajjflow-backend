<?php

namespace App\Enums;

enum CustomerRole: string
{
    case Customer = 'customer';
    case TeamMember = 'team_member';
}
