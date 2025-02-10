<?php

namespace App\Application\Command\TimeSheet\AddTimeSheet;

use App\Application\Bus\Command\Command;
use App\Domain\Entity\TimeSheet;
use Symfony\Component\Validator\Constraints as Assert;

class AddTimeSheet implements Command
{
    #[Assert\NotBlank(
        message: "Exceptions.Assert.NotBlank",
        payload: [
            "property" => "year",
            "entity" => TimeSheet::class,
        ]
    )]
    #[Assert\Range(
        notInRangeMessage: "Exceptions.Assert.Range",
        min: 2000,
        max: 2100,
        payload: [
            "property" => "year",
            "entity" => TimeSheet::class,
        ]
    )]
    public int $year;

    #[Assert\NotBlank(
        message: "Exceptions.Assert.NotBlank",
        payload: [
            "property" => "month",
            "entity" => TimeSheet::class,
        ]
    )]
    #[Assert\Range(
        notInRangeMessage: "Exceptions.Assert.Range",
        min: 1,
        max: 12,
        payload: [
            "property" => "month",
            "entity" => TimeSheet::class,
        ]
    )]
    public int $month;

    #[Assert\NotNull(
        message: "Exceptions.Assert.NotNull",
        payload: [
            "property" => "hourBalance",
            "entity" => TimeSheet::class,
        ]
    )]
    public float $hourBalance;

    #[Assert\NotNull(
        message: "Exceptions.Assert.NotNull",
        payload: [
            "property" => "teleworkingCounter",
            "entity" => TimeSheet::class,
        ]
    )]
    #[Assert\PositiveOrZero(
        message: "Exceptions.Assert.PositiveOrZero",
        payload: [
            "property" => "teleworkingCounter",
            "entity" => TimeSheet::class,
        ]
    )]
    public int $teleworkingCounter;

    #[Assert\NotNull(
        message: "Exceptions.Assert.NotNull",
        payload: [
            "property" => "workingDays",
            "entity" => TimeSheet::class,
        ]
    )]
    #[Assert\Positive(
        message: "Exceptions.Assert.Positive",
        payload: [
            "property" => "workingDays",
            "entity" => TimeSheet::class,
        ]
    )]
    public int $workingDays;

    public function toEntity(): TimeSheet
    {
        $timeSheet = new TimeSheet();
        $timeSheet
            ->setYear($this->year)
            ->setMonth($this->month)
            ->setHourBalance($this->hourBalance)
            ->setTeleworkingCounter($this->teleworkingCounter)
            ->setWorkingDays($this->workingDays);

        return $timeSheet;
    }
}
