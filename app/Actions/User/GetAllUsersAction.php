<?php

namespace App\Actions\User;

use App\Entities\User;
use App\Repositories\User\UserRepositoryInterface;

class GetAllUsersAction
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * GetAllUsersAction constructor.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(User $current_user): GetAllUsersResponse
    {
        $users = $this->userRepository->getAll()
            ->whereNotIn('email',$current_user->email)
            ->whereNotIn('name', '');

        return new GetAllUsersResponse($users);
    }
}
