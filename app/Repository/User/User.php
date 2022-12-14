<?php

namespace App\Repository\User;

use App\Repository\BaseRepository;

abstract class User extends BaseRepository
{
    public function model(): string
    {
        return \App\Models\User\User::class;
    }
}
