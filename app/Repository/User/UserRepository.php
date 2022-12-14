<?php

namespace App\Repository\User;

use App\Models\User\User;
use App\Repository\BaseRepository;
use App\Repository\BaseRepositoryContract;
use Illuminate\Support\Str;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class UserRepository
 */
class UserRepository extends BaseRepository implements BaseRepositoryContract
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

    /**
     * @param array $data
     * @return User
     * @throws ValidatorException
     */
    public function createUser(array $data): User
    {
        /** @var User $user */
        return $this->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data[ 'password' ]),
            'api_token' => Str::random(30),
        ]);
    }

    public function updateUser()
    {

    }
}
