<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\TimeType;
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

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?TimeType $hourBalance = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $teleworkingCounter = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'timeSheets')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: WorkingDay::class, mappedBy: 'timeSheet')]
    private Collection $workingDays;

    public function __construct()
    {
        $this->workingDays = new ArrayCollection();
    }

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

    public function getHourBalance(): ?TimeType
    {
        return $this->hourBalance;
    }

    public function setHourBalance(?TimeType $hourBalance): self
    {
        $this->hourBalance = $hourBalance;
        return $this;
    }

    public function getTeleworkingCounter(): ?int
    {
        return $this->teleworkingCounter;
    }

    public function setTeleworkingCounter(?int $teleworkingCounter): self
    {
        $this->teleworkingCounter = $teleworkingCounter;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        $this->user?->addTimeSheet($this);

        return $this;
    }

    /**
     * @return Collection<int, WorkingDay>
     */
    public function getWorkingDays(): Collection
    {
        return $this->workingDays;
    }

    public function addWorkingDay(WorkingDay $workingDay): self
    {
        if (!$this->workingDays->contains($workingDay)) {
            $this->workingDays->add($workingDay);
            $workingDay->setTimeSheet($this);
        }

        return $this;
    }
}
