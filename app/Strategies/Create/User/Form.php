<?php

namespace App\Strategies\Create\User;

use App\Dto\Create\Create as UserCreateDataDto;
use App\Repository\BaseRepository;
use App\Repository\User\Create as UserCreateRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Strategies\Create\User\User as CreateUserAbstractStrategy;
use Prettus\Validator\Exceptions\ValidatorException;


/**
 *
 */
class Form extends CreateUserAbstractStrategy
{
    /**
     * @param BaseRepository $repository
     * @param UserCreateDataDto|\App\Dto\BaseDto $dto
     * @return Model|null
     */
    public function create(BaseRepository $repository, UserCreateDataDto|\App\Dto\BaseDto $dto): ?Model
    {
        return null;
    }

    /**
     * @throws ValidatorException
     */
    private function createFormUser(UserCreateRepository $createUserRepository, UserCreateDataDto $createUserDto): Authenticatable
    {
        return $createUserRepository->createUser($createUserDto->all());
    }
}
