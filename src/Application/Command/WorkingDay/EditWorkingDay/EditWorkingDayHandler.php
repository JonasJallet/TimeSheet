<?php

namespace App\Application\Command\WorkingDay\EditWorkingDay;

use App\Application\Bus\Command\CommandHandler;
use App\Domain\Repository\WorkingDay\WorkingDayRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class EditWorkingDayHandler implements CommandHandler
{
    public function __construct(
        private WorkingDayRepository $workingDayRepository
    )
    {
    }

    public function __invoke(EditWorkingDay $editWorkingDay): void
    {
        $workingDay = $editWorkingDay->toEntity();
        $this->workingDayRepository->edit($workingDay);
    }

}
