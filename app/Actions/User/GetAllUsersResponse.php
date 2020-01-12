<?php

namespace App\Actions\User;

class GetAllUsersResponse
{
    private $userCollection;

    public function __construct( $userCollection)
    {
        $this->userCollection = $userCollection;
    }

    public function getCollection()
    {
        return $this->userCollection;
    }

    public function toArray(): array
    {
        return $this->userCollection->toArray();
    }
}
