<?php

namespace App\Domain\Repository\TimeSheet;

use App\Domain\Entity\TimeSheet;

interface TimeSheetRepositoryInterface
{
    public function save(TimeSheet $timeSheet, bool $newEntity): void;

    public function delete(TimeSheet $timeSheet): void;

    public function findById(int $id): ?TimeSheet;

    public function browse(): array;
}
