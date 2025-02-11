<?php

namespace App\Domain\Factory;

use App\Domain\Entity\WorkHourDefault;
use DateTime;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

class WorkHourDefaultFactory extends PersistentProxyObjectFactory
{
    private const string MORNING_START = '08:00';
    private const string MORNING_END = '12:00';
    private const string AFTERNOON_START = '13:00';
    private const string AFTERNOON_END = '17:00';

    protected function defaults(): array|callable
    {
        return [
            'morningStartTime' => DateTime::createFromFormat('H:i', self::MORNING_START),
            'morningEndTime' => DateTime::createFromFormat('H:i',self::MORNING_END),
            'afternoonStartTime' => DateTime::createFromFormat('H:i',self::AFTERNOON_START),
            'afternoonEndTime' => DateTime::createFromFormat('H:i',self::AFTERNOON_END),
        ];
    }

    public static function class(): string
    {
        return WorkHourDefault::class;
    }
}
