<?php

namespace App\Application\Query\TimeSheet;

use App\Application\Query\WorkingDay\WorkingDayResponse;
use App\Domain\Entity\TimeSheet;
use App\Domain\Entity\WorkingDay;

class TimeSheetResponse
{
    public int $id;
    public int $year;
    public int $month;
    public ?float $hourBalance;
    public ?string $teleworkingCounter;

    /** @var WorkingDay[] */
    public array $workingDays = [];

    public function fromEntity(TimeSheet $timeSheet): self
    {
        $this->id = $timeSheet->getId();
        $this->year = $timeSheet->getYear();
        $this->month = $timeSheet->getMonth();
        $this->hourBalance = $timeSheet->getHourBalance();
        $this->teleworkingCounter = $timeSheet->getTeleworkingCounter();
        $this->workingDays = array_map(function ($entry) {
            return (new WorkingDayResponse())->fromEntity($entry);
        }, $timeSheet->getWorkingDays()->toArray());

        return $this;
    }
}
