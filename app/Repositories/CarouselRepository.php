<?php

namespace App\Repositories;

use App\Exceptions\CarouselNotFoundException;
use App\Exceptions\CreateCarouselErrorException;
use App\Exceptions\UpdateCarouselErrorException;
use App\Models\Carousel;
use App\Repositories\Interfaces\CarouselRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

/**
 * Class CarouselRepository.
 */
class CarouselRepository extends BaseRepository implements CarouselRepositoryInterface
{
    /**
     * CarouselRepository constructor.
     *
     * @param \App\Models\Carousel $model
     */
    public function __construct(Carousel $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     *
     * @return Carousel
     *
     * @throws CreateCarouselErrorException
     */
    public function createCarousel(array $data): Carousel
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCarouselErrorException($e);
        }
    }

    /**
     * @param int $id
     * @return Carousel
     * @throws CarouselNotFoundException
     */
    public function findCarousel(int $id) : Carousel
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new CarouselNotFoundException($e);
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws UpdateCarouselErrorException
     */
    public function updateCarousel(array $data) : bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateCarouselErrorException($e);
        }
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function deleteCarousel() : ?bool
    {
        return $this->model->delete();
    }
}
