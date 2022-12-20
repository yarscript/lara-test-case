<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\{Eloquent\BaseRepository as EloquentRepository,
    Exceptions\RepositoryException,
    Traits\CacheableRepository,
    Contracts\CacheableInterface
};

/**
 * Class BaseRepository
 * @package App\Repository
 */
abstract class BaseRepository extends EloquentRepository implements CacheableInterface
{
    use CacheableRepository;

    /**
     * Find data by field and value
     *
     * @param string $field
     * @param string|null $value
     * @param array $columns
     * @return mixed
     */
    public function findOneByField(string $field, string $value = null, array $columns = ['*']): mixed
    {
        $model = $this->findByField($field, $value, $columns = ['*']);

        return $model->first();
    }

    /**
     * Find data by field and value
     *
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findOneWhere(array $where, array $columns = ['*']): mixed
    {
        $model = $this->findWhere($where, $columns);

        return $model->first();
    }

    /**
     * Find data by id
     *
     * @param int $id
     * @param array $columns
     * @return mixed
     * @throws RepositoryException
     */
    public function find($id, $columns = ['*']): mixed
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->getModel()->find($id, $columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Find data by id
     *
     * @param int $id
     * @param array $columns
     * @return mixed
     * @throws RepositoryException
     */
    public function findOrFail(int $id, array $columns = ['*']): mixed
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->findOrFail($id, $columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Count results of repository
     *
     * @param array $where
     * @param string $columns
     * @return mixed
     * @throws RepositoryException
     */
    public function count(array $where = [], $columns = '*'): mixed
    {
        $this->applyCriteria();
        $this->applyScope();

        if ($where) {
            $this->applyConditions($where);
        }

        $result = $this->model->count($columns);
        $this->resetModel();
        $this->resetScope();

        return $result;
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }
}
