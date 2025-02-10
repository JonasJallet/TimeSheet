<?php

namespace App\Domain\Enum;

use App\Domain\ObjectValues\GetValuesEnumTrait;

enum MonthEnum: string
{
    use GetValuesEnumTrait;

    case JANUARY = 'january';
    case FEBRUARY = 'february';
    case MARCH = 'march';
    case APRIL = 'april';
    case MAY = 'may';
    case JUNE = 'june';
    case JULY = 'july';
    case AUGUST = 'august';
    case SEPTEMBER = 'september';
    case OCTOBER = 'october';
    case NOVEMBER = 'november';
    case DECEMBER = 'december';
}
