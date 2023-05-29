<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    protected static string $model = User::class;

    public function findByName(string $name): ?User
    {
        return $this->where('name', $name)->first();
    }

    public function findByEmail(string $email): ?User
    {
        return $this->where('email', $email)->first();
    }

    public function findById(int $id): ?User
    {
        return $this->find($id);
    }
}
