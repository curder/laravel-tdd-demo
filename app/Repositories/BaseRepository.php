<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RepositoryInterface.
 */
class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array  $columns
     * @param string $orderBy
     * @param string $sortBy
     *
     * @return mixed
     */
    public function all($columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc')
    {
        return $this->model->orderBy($orderBy, $sortBy)->get($columns);
    }

    /**
     * @param array $data
     *
     * @return bool|mixed
     */
    public function update(array $data): bool
    {
        return $this->model->update($data);
    }

    /**
     * @return bool
     *
     * @throws \Exception
     */
    public function delete(): bool
    {
        return $this->model->delete();
    }
}
