<?php

namespace App\Repository\User;

use App\Repository\BaseRepository;

class Create extends User
{
    /**
     * @param array $data
     * @return \App\Models\User\User
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function createUser(array $data): \App\Models\User\User
    {
        $this->create(
            ''
        );
    }
}
