<?php

namespace App\Actions\User;

class DeleteUserRequest
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
