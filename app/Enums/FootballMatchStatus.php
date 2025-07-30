<?php

namespace App\Enums;

enum FootballMatchStatus: string
{
    case SCHEDULED = 'scheduled';
    case ONGOING = 'ongoing';
    case HALFTIME = 'halftime';
    case FINISHED = 'finished';
}
