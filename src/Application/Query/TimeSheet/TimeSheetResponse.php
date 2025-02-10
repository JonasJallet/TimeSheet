<?php

namespace App\Application\Query\TimeSheet;

use App\Domain\Entity\TimeSheet;

class TimeSheetResponse
{
    public int $id;
    public int $year;
    public int $month;
    public float $hourBalance;
    public string $teleworkingCounter;

    public function fromEntity(TimeSheet $timeSheet): self
    {
        $this->id = $timeSheet->getId();
        $this->year = $timeSheet->getYear();
        $this->month = $timeSheet->getMonth();
        $this->hourBalance = $timeSheet->getHourBalance();
        $this->teleworkingCounter = $timeSheet->getTeleworkingCounter();

        return $this;
    }

}
