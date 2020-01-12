<?php

namespace App\Repositories\User;

use App\Entities\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): Collection
    {
        return User::all();
    }

    public function getById(int $id): ?User
    {
        return User::find($id);
    }

    public function save(User $user): User
    {
        $user->save();

        return $user;
    }

    public function deleteById(int $id): void
    {
        User::destroy($id);
    }

}
