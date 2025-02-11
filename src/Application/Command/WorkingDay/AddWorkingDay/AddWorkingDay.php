<?php

namespace App\Application\Command\WorkingDay\AddWorkingDay;

use App\Application\Bus\Command\Command;
use App\Domain\Entity\WorkingDay;
use App\Domain\Enum\WorkingDayTypeEnum;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class AddWorkingDay implements Command
{
    #[Assert\NotBlank(message: "Exceptions.Assert.NotBlank")]
    #[Assert\Time]
    public string $morningStartTime;

    #[Assert\NotBlank(message: "Exceptions.Assert.NotBlank")]
    #[Assert\Time]
    public string $morningEndTime;

    #[Assert\NotBlank(message: "Exceptions.Assert.NotBlank")]
    #[Assert\Time]
    public string $afternoonStartTime;

    #[Assert\NotBlank(message: "Exceptions.Assert.NotBlank")]
    #[Assert\Time]
    public string $afternoonEndTime;

    #[Assert\Choice(
        callback: [WorkingDayTypeEnum::class, 'getValues'],
        message: 'Exceptions.Assert.InvalidChoice',
    )]
    public string $workingDayType;

    public function toEntity(): WorkingDay
    {
        $workingDay = new WorkingDay();
        $workingDay
            ->setMorningStartTime(DateTime::createFromFormat('H:i', $this->morningStartTime))
            ->setMorningEndTime(DateTime::createFromFormat('H:i', $this->morningEndTime))
            ->setAfternoonStartTime(DateTime::createFromFormat('H:i', $this->afternoonStartTime))
            ->setAfternoonEndTime(DateTime::createFromFormat('H:i', $this->afternoonEndTime))
            ->setWorkingDayType(WorkingDayTypeEnum::from($this->workingDayType));

        return $workingDay;
    }
}
