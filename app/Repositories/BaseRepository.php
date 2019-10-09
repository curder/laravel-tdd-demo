<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * @param string $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }
    /**
     * @param  $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findOneOrFail($id)
    {
        return $this->model->findOrFail($id);
    }
    /**
     * @param array $data
     * @return Collection
     */
    public function findBy(array $data)
    {
        return $this->model->where($data)->get();
    }
    /**
     * @param array $data
     * @return mixed
     */
    public function findOneBy(array $data)
    {
        return $this->model->where($data)->first();
    }
    /**
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findOneByOrFail(array $data)
    {
        return $this->model->where($data)->firstOrFail();
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
