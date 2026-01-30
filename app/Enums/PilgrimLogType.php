<?php

namespace App\Enums;

enum PilgrimLogType: string
{
    case UmrahRegistered = 'umrah_registered'; // ✅
    case UmrahCancelled = 'umrah_cancelled'; // ✅
    case UmrahCompleted = 'umrah_completed'; // ✅
    case UmrahCollection = 'umrah_collection'; // ✅

    case HajjPreRegistered = 'hajj_pre_registered'; // ✅
    case HajjRegistered = 'hajj_registered'; // ✅
    case HajjPreRegArchived = 'hajj_pre_reg_archived'; // ✅
    case HajjPreRegCancelled = 'hajj_pre_reg_cancelled'; // ✅
    case HajjPreRegTransferred = 'hajj_pre_reg_transferred'; // ✅
    case HajjRegReplaced = 'hajj_reg_replaced';
    case HajjCollection = 'hajj_collection'; // ✅


    // case HajjCompleted = 'hajj_completed';
}
