<?php

namespace App\Application\Command\TimeSheet\AddTimeSheet;

use App\Application\Bus\Command\CommandHandler;
use App\Domain\Repository\TimeSheet\TimeSheetRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class AddTimeSheetHandler implements CommandHandler
{
    public function __construct(
        private TimeSheetRepository $timeSheetRepository,
    )
    {
    }

    public function __invoke(AddTimeSheet $addTimeSheet): void
    {
        $timeSheet = $addTimeSheet->toEntity();
        $this->timeSheetRepository->add($timeSheet);
        $addTimeSheet->id = $timeSheet->getId();
    }

}
