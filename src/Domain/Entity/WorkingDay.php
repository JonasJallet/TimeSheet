<?php

namespace App\Domain\Entity;

use App\Domain\Enum\WorkingDayTypeEnum;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'working_day')]
class WorkingDay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?DateTime $morningStartTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?DateTime $morningEndTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?DateTime $afternoonStartTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?DateTime $afternoonEndTime = null;

    #[ORM\Column(type: Types::STRING, enumType: WorkingDayTypeEnum::class)]
    private ?WorkingDayTypeEnum $workingDayType = null;

    #[ORM\ManyToOne(targetEntity: TimeSheet::class, inversedBy: 'workingDays')]
    #[ORM\JoinColumn(nullable: true)]
    private ?TimeSheet $timeSheet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMorningStartTime(): ?DateTime
    {
        return $this->morningStartTime;
    }

    public function setMorningStartTime(DateTime $time): self
    {
        $this->morningStartTime = $time;
        return $this;
    }

    public function getMorningEndTime(): ?DateTime
    {
        return $this->morningEndTime;
    }

    public function setMorningEndTime(DateTime $time): self
    {
        $this->morningEndTime = $time;
        return $this;
    }

    public function getAfternoonStartTime(): ?DateTime
    {
        return $this->afternoonStartTime;
    }

    public function setAfternoonStartTime(DateTime $time): self
    {
        $this->afternoonStartTime = $time;
        return $this;
    }

    public function getAfternoonEndTime(): ?DateTime
    {
        return $this->afternoonEndTime;
    }

    public function setAfternoonEndTime(DateTime $time): self
    {
        $this->afternoonEndTime = $time;
        return $this;
    }

    public function getWorkingDayType(): ?WorkingDayTypeEnum
    {
        return $this->workingDayType;
    }

    public function setWorkingDayType(?WorkingDayTypeEnum $workingDayType): self
    {
        $this->workingDayType = $workingDayType;

        return $this;
    }

    public function getTimeSheet(): ?TimeSheet
    {
        return $this->timeSheet;
    }

    public function setTimeSheet(?TimeSheet $timeSheet): self
    {
        $this->timeSheet = $timeSheet;
        $this->timeSheet?->addWorkingDay($this);

        return $this;
    }
}
