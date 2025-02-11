<?php

namespace App\Domain\Repository\WorkingDay;

use App\Domain\Entity\WorkingDay;

interface WorkingDayRepositoryInterface
{
    public function save(WorkingDay $workingDay, bool $newEntity): void;

    public function delete(WorkingDay $workingDay): void;

    public function findById(int $id): ?WorkingDay;
}
