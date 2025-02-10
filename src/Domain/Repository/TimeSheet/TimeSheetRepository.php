<?php

namespace App\Domain\Repository\TimeSheet;

use App\Domain\Entity\TimeSheet;

readonly class TimeSheetRepository
{
    public function __construct(
        private TimeSheetRepositoryInterface $timeSheetRepositoryInterface,
    ) {
    }

    public function browse(): array
    {
        return $this->timeSheetRepositoryInterface->browse();
    }

    public function read(string $email): ?TimeSheet
    {
        return $this->timeSheetRepositoryInterface->findById($email);
    }

    public function edit(TimeSheet $timeSheet): void
    {
        $this->timeSheetRepositoryInterface->save($timeSheet, false);
    }

    public function add(TimeSheet $timeSheet): void
    {
        $this->timeSheetRepositoryInterface->save($timeSheet, true);
    }

    public function delete(TimeSheet $timeSheet): void
    {
        $this->timeSheetRepositoryInterface->delete($timeSheet);
    }

}
