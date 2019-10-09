<?php

namespace App\Repositories\Interfaces;
/**
 * Interface CarouselRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface CarouselRepositoryInterface
{
    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * @param array  $columns
     * @param string $orderBy
     * @param string $sortBy
     *
     * @return mixed
     */
    public function all($columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc');

    /**
     * @param array $attributes
     *
     * @return bool
     */
    public function update(array $attributes): bool;

    /**
     * @return bool
     *
     * @throws \Exception
     */
    public function delete(): bool;
}
