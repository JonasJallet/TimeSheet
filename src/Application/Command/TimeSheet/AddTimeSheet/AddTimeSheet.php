<?php

namespace App\Application\Command\TimeSheet\AddTimeSheet;

use App\Application\Bus\Command\Command;
use App\Domain\Entity\TimeSheet;
use App\Domain\Entity\WorkingDay;
use App\Infrastructure\Symfony\Attribute\MapToEntityAttribute;
use Symfony\Component\Serializer\Attribute\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

class AddTimeSheet implements Command
{
    #[Ignore]
    public ?int $id = null;

    #[Assert\NotBlank(
        message: "Exceptions.Assert.NotBlank",
    )]
    #[Assert\Range(
        notInRangeMessage: "Exceptions.Assert.Range",
        min: 2000,
        max: 2100,
    )]
    public int $year;

    #[Assert\NotBlank(
        message: "Exceptions.Assert.NotBlank",
    )]
    #[Assert\Range(
        notInRangeMessage: "Exceptions.Assert.Range",
        min: 1,
        max: 12,
    )]
    public int $month;

    #[MapToEntityAttribute(entityClass: WorkingDay::class)]
    public ?array $workingDays;

    public function toEntity(): TimeSheet
    {
        $timeSheet = new TimeSheet();
        $timeSheet->setYear($this->year);
        $timeSheet->setMonth($this->month);

        foreach ($this->workingDays as $workingDay) {
            $timeSheet->addWorkingDay($workingDay);
        }

        return $timeSheet;
    }
}
