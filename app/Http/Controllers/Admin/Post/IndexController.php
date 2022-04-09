<?php


namespace App\Http\Controllers\Admin\Post;

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
        $posts_count = Post::count();

        return view('admin.post.index', compact('posts', 'posts_count'));
    }

   // public function

}
