<?php

namespace App\Domain\Repository\WorkingDay;

use App\Domain\Entity\WorkingDay;

interface WorkingDayRepositoryInterface
{
    public function save(WorkingDay $workingDay, bool $newEntity): void;

    public function remove(WorkingDay $workingDay): void;
}
