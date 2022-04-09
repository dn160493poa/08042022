<?php


namespace App\Http\Controllers\Post\Api;

use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Post;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(PostFilter::class, ['query_params' => array_filter($data)]);
        $posts = Post::filter($filter)->paginate(10);


        return 22222;
       // return view('posts.index', compact('posts'));
    }
}
