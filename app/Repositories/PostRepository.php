<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

/**
 * Class PostsRepository.
 */
class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * @var Post
     */
    protected $model;

    /**
     * ArticlesRepository constructor.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
    }
}
