<?php

namespace App\Repositories\Users;

use App\Models\User;

interface UserInterface
{
    function store(array $data): ?User;

    function findByEmail(string $email): ?User;
}
