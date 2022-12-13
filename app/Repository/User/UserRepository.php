<?php

namespace App\Repository\User;

use App\Models\User\User;
use App\Repository\BaseRepository;

/**
 * Class UserRepository
 */
class UserRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}
