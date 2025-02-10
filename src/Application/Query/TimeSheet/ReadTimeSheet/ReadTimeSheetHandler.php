<?php

namespace App\Application\Query\TimeSheet\ReadTimeSheet;

use App\Application\Bus\Query\QueryHandler;
use App\Application\Query\TimeSheet\TimeSheetResponse;
use App\Domain\Exception\TimeSheet\TimeSheetNotFoundException;
use App\Domain\Repository\TimeSheet\TimeSheetRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class ReadTimeSheetHandler implements QueryHandler
{
    public function __construct(
        private TimeSheetRepository $timeSheetRepository
    )
    {
    }

    public function __invoke(ReadTimeSheet $readTimeSheet): TimeSheetResponse
    {
        $timeSheet = $this->timeSheetRepository->read($readTimeSheet->id);

        if ($timeSheet === null) {
            throw new TimeSheetNotFoundException($readTimeSheet->id);
        }

        return (new TimeSheetResponse())->fromEntity($timeSheet);
    }
}
