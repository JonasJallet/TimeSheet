<?php

namespace App\Infrastructure\Controller\Api\TimeSheet;

use App\Application\Bus\Command\CommandBus;
use App\Application\Bus\Query\QueryBus;
use App\Application\Command\TimeSheet\AddTimeSheet\AddTimeSheet;
use App\Application\Query\TimeSheet\ReadTimeSheet\ReadTimeSheet;
use App\Infrastructure\Utils\ResponseFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Throwable;

#[Route('time-sheets', name: 'api_time_sheet_')]
#[OA\Tag(name: 'Time Sheet')]
class AddTimeSheetController extends AbstractController
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly QueryBus $queryBus,
        private readonly ResponseFormatter $responseFormatter,
    ) {
    }

    #[Route('', name: 'post', methods: ['POST'])]
    #[OA\Post(
        path: '/time-sheets',
        description: 'Add a new time sheet with the provided details',
        summary: 'Add a new user'
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'year', type: 'integer', example: 2024),
                new OA\Property(property: 'month', type: 'integer', example: 2),
            ]
        )
    )]
    #[OA\Response(
        response: Response::HTTP_OK,
        description: 'Time Sheet successfully created',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string'),
                new OA\Property(property: 'status', type: 'string'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: Response::HTTP_BAD_REQUEST,
        description: 'Invalid input data provided'
    )]
    #[OA\Response(
        response: Response::HTTP_INTERNAL_SERVER_ERROR,
        description: 'Server error occurred while processing the request'
    )]
    public function add(#[MapRequestPayload] AddTimeSheet $addTimeSheet): JsonResponse
    {
        try {
            $this->commandBus->dispatch($addTimeSheet);

            $query = new ReadTimeSheet();
            $query->id = $addTimeSheet->id;
            $user = $this->queryBus->ask($query);

            return new JsonResponse(
                $this->responseFormatter->formatResponse(
                    "Success.Entity.Added",
                    ['%entity%' => 'User'],
                    'success',
                    $user
                )
                , Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            [$response, $status] = $this->responseFormatter->formatException($exception);


            return new JsonResponse(
                $response,
                $status
            );
        }
    }

}
