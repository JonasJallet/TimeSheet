<?php

namespace App\Domain\ObjectValues;

trait GetValuesEnumTrait
{
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
