<?php

namespace App\Strategies\Create\User;

use App\Dto\BaseDto;
use App\Repository\BaseRepository;
use App\Repository\User\Create;
use App\Strategies\Create\User\User as CreateUserAbstractStrategy;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 *
 */
class Google extends CreateUserAbstractStrategy
{

    /**
     * @param BaseRepository $repository
     * @param BaseDto $dto
     * @return \App\Models\User\User
     * @throws ValidatorException
     */
    public function create(BaseRepository $repository, BaseDto $dto): \App\Models\User\User
    {
        /** @var Create $dto */
        return $this->createGoogleUser($repository, $dto);
    }

    /**
     * @throws ValidatorException
     */
    private function createGoogleUser(Create $createUserRepository, Create $createUserDto): \App\Models\User\User
    {
        return $createUserRepository->createUser($createUserDto->all());
    }
}
