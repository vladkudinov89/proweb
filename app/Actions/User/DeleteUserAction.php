<?php

namespace App\Actions\User;

use App\Exceptions\User\UserDoesNotExistException;
use App\Repositories\User\UserRepositoryInterface;

class DeleteUserAction
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * DeleteUserAction constructor.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(DeleteUserRequest $deleteUserRequest)
    {
        $user = $this->userRepository->getById($deleteUserRequest->getId());

        if (!$user) {
            throw new UserDoesNotExistException();
        }


        $this->userRepository->deleteById($user->id);
    }
}
