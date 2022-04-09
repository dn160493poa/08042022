<?php

namespace App\Http\Controllers\Post\Api;


use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        dd('11111');

        $data = $request->validated();

        $post = $this->service->store($data);

        return new PostResource($post);
        //return 111;
    }
}
