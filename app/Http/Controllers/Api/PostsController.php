<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function store(Request $request)
    {
        return Post::create($request->all());
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return $post;
    }
}
