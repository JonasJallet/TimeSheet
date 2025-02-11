<?php

namespace App\Application\Command\WorkingDay\AddWorkingDay;

use App\Application\Bus\Command\CommandHandler;
use App\Domain\Repository\WorkingDay\WorkingDayRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class AddWorkingDayHandler implements CommandHandler
{
    public function __construct(
        private WorkingDayRepository $workingDayRepository
    )
    {
    }

    public function __invoke(AddWorkingDay $addWorkingDay): void
    {
        $workingDay = $addWorkingDay->toEntity();
        $this->workingDayRepository->add($workingDay);
    }
}
