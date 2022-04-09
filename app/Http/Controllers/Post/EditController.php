<?php

namespace App\Http\Controllers\Post;

use App\Models\Category;
use App\Models\Post;

class EditController extends BaseController
{
    public function __invoke(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }
}
