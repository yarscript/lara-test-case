<?php

namespace App\Strategies\Create;

use App\Dto\BaseDto;
use App\Repository\BaseRepository;
use App\Strategies\BaseStrategy;

/**
 * Class App\Strategies\User\BaseCreate
 */
abstract class BaseCreate extends BaseStrategy implements BaseCreateContract
{
    /**
     * @param BaseRepository $repository
     * @param BaseDto $dto
     */
    public function __construct(
        private BaseRepository $repository,
        private BaseDto $dto,
    )
    {

    }

    /**
     * @return mixed
     */
    public function execute(): mixed
    {
        return $this->create(
            $this->repository,
            $this->dto
        );
    }

    /**
     * @param BaseRepository $repository
     * @param BaseDto $dto
     * @return mixed
     */
    protected abstract function create(BaseRepository $repository, BaseDto $dto): mixed;
}
