<?php

namespace App\Application\Query\User\BrowseUsers;

use App\Application\Bus\Query\QueryHandler;
use App\Application\Query\User\UserResponse;
use App\Domain\Repository\User\UserRepository;

readonly class BrowseUsersHandler implements QueryHandler
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function __invoke(BrowseUsers $browseUsers): array
    {
        $users = $this->userRepository->browse();

        return array_map(
            fn($user) => (new UserResponse())->fromEntity($user),
            $users
        );
    }
}
