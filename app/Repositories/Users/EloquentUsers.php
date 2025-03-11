<?php

namespace App\Repositories\Users;

use App\Models\User;
use \Illuminate\Database\Eloquent\Builder;
class EloquentUsers implements UserInterface
{
    public function store(array $data): ?User
    {
        $query = $this->newQuery();

        $user = $query->create($data);

        return $user->fresh();
    }

    public function findByEmail(string $email): ?User
    {
        $query = $this->newQuery();

        return $query->where('email', $email)->first();
    }

    protected function newQuery(): Builder
    {
        return (new User())->newQuery();
    }
}
