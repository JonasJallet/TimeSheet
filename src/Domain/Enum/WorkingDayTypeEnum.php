<?php

namespace App\Domain\Enum;

use App\Domain\ObjectValues\GetValuesEnumTrait;

enum WorkingDayTypeEnum: string
{
    use GetValuesEnumTrait;

    case WORK = 'work';
    case SCHOOL = 'school';
    case PAID_LEAVE = 'paid_leave';
}
