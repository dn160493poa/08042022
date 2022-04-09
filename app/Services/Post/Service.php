<?php


namespace App\Services\Post;


use App\Models\Post;

class Service
{
    public function store($data){
        $categories = $data['categories'];
        unset($data['categories']);

        $post = Post::create($data);

        $post->categories()->attach($categories);

        return $post;
    }

    public function update($post, $data){
        $categories = $data['categories'];
        unset($data['categories']);

        $post->update($data);

        $post->categories()->sync($categories);

        return $post;
    }
}
