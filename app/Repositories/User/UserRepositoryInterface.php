<?php

namespace App\Repositories\User;

use App\Entities\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface{
    public function getAll(): Collection;

    public function getById(int $id): ?User;

    public function save(User $user): User;

    public function deleteById(int $id): void;
}
