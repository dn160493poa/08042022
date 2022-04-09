<?php

namespace App\Http\Controllers\Post;

use App\Models\Category;


class CreateController extends BaseController
{
    public function __invoke()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }
}
