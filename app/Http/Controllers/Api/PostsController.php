<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

/**
 * Class PostsController.
 */
class PostsController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    protected $postRepository;

    /**
     * PostsController constructor.
     *
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->postRepository->all();
    }

    /**
     * @param Post $post
     *
     * @return Post
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        return $this->postRepository->create($request->all());
    }

    /**
     * @param Request $request
     * @param Post    $post
     *
     * @return Post
     */
    public function update(Request $request, Post $post): Post
    {
        $updated = $request->all();

        $postRepository = new PostRepository($post);

        $postRepository->update($updated);

        return $post;
    }

    /**
     * @param Post $post
     *
     * @return Post
     *
     * @throws \Exception
     */
    public function destroy(Post $post): Post
    {
        $postRepository = new PostRepository($post);

        $postRepository->delete();

        return $post;
    }
}
