<?php

namespace App\Http\Controllers\Post\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoriesResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends BaseController
{
    public function __invoke()
    {
        $categories = Category::all();

        //dd($categories);

        return new CategoriesResource($categories);
    }
}
