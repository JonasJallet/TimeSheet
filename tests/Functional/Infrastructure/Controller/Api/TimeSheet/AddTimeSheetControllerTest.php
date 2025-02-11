<?php

namespace App\Tests\Functional\Infrastructure\Controller\Api\TimeSheet;

use App\Domain\Factory\WorkingDayFactory;
use App\Tests\Functional\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;

class AddTimeSheetControllerTest extends ApiTestCase
{
    use Factories;

    public function testAddTimeSheet(): void
    {
        $workingDays = WorkingDayFactory::createMany(21);
        $workingDayIds = array_map(
            fn($workingDay) => $workingDay->getId(),
            $workingDays
        );

        $response = $this->browser()
            ->post('/api/time-sheets', [
                'json' => [

                    'year' => 2001,
                    'month' => 11,
                    'workingDays' => $workingDayIds,
                ],
            ])
            ->json();

        dd($response->decoded());
    }
}
