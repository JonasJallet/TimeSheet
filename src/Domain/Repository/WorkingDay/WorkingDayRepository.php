<?php

namespace App\Domain\Repository\WorkingDay;

use App\Domain\Entity\WorkingDay;

readonly class WorkingDayRepository
{
    public function __construct(
        private WorkingDayRepositoryInterface $workingDayRepositoryInterface,
    ) {
    }

    public function read(int $id): ?WorkingDay
    {
        return $this->workingDayRepositoryInterface->findById($id);
    }

    public function edit(WorkingDay $workingDay): void
    {
        $this->workingDayRepositoryInterface->save($workingDay, false);
    }

    public function add(WorkingDay $user): void
    {
        $this->workingDayRepositoryInterface->save($user, true);
    }
}
