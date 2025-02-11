<?php

namespace App\Application\Query\WorkingDay;

use App\Domain\Entity\WorkingDay;

class WorkingDayResponse
{
    public int $id;

    public string  $morningStartTime;
    public string  $morningEndTime;
    public string  $afternoonStartTime;
    public string  $afternoonEndTime;
    public string  $workingDayType;


    public function fromEntity(WorkingDay $workingDay): self
    {
        $this->id = $workingDay->getId();
        $this->morningStartTime = $workingDay->getMorningStartTime()->format('H:i');
        $this->morningEndTime = $workingDay->getMorningEndTime()->format('H:i');
        $this->afternoonStartTime = $workingDay->getAfternoonStartTime()->format('H:i');
        $this->afternoonEndTime = $workingDay->getAfternoonEndTime()->format('H:i');
        $this->workingDayType = $workingDay->getWorkingDayType()->value;

        return $this;
    }
}
