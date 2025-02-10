<?php

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
#[ORM\Table(name: 'time_sheet')]
class TimeSheet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::INTEGER)]
    private int $year;

    #[ORM\Column(type: Types::INTEGER)]
    private int $month;

    #[ORM\Column(type: Types::FLOAT)]
    private ?float $hourBalance = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $teleworkingCounter = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $workingDays = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;
        return $this;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function setMonth(int $month): self
    {
        $this->month = $month;
        return $this;
    }

    public function getHourBalance(): float
    {
        return $this->hourBalance;
    }

    public function setHourBalance(float $hourBalance): self
    {
        $this->hourBalance = $hourBalance;
        return $this;
    }

    public function getTeleworkingCounter(): int
    {
        return $this->teleworkingCounter;
    }

    public function setTeleworkingCounter(int $teleworkingCounter): self
    {
        $this->teleworkingCounter = $teleworkingCounter;

        return $this;
    }

    public function getWorkingDays(): int
    {
        return $this->workingDays;
    }

    public function setWorkingDays(int $workingDays): self
    {
        $this->workingDays = $workingDays;

        return $this;
    }
}
