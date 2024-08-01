<?php

namespace App\Repositories;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    protected function query(): Builder
    {
        return User::query();
    }

    public function saveUser( $email , array $data)
    {
        return $this->query()->updateOrCreate(['email' => $email], $data);
    }

    public function getRefreshToken($userId)
    {
        return User::find($userId)->refresh_token;
    }
}
