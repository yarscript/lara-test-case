<?php

namespace App\Strategies\Create\User;

use App\Dto\User\CreateData as UserCreateDataDto;
use App\Repository\BaseRepository;
use App\Strategies\Create\BaseCreate as BaseCreateStrategy;

class Form extends BaseCreateStrategy
{
    public function create(BaseRepository $repository, UserCreateDataDto|\App\Dto\BaseDto $dto): mixed
    {

    }
}
