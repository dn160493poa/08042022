<?php


namespace App\Services\Post;


use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class Service
{
    public function store($data){
        try{
            DB::beginTransaction();

            if(isset($data['categories'])){
                $categories = $data['categories'];
                unset($data['categories']);

                $post = Post::create($data);

                $post->categories()->attach($categories);
            }else{
                $post = Post::create($data);
            }

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

        return $post->fresh();
    }

    public function update($post, $data){
        try {
            DB::beginTransaction();

            if(isset($data['categories'])){
                $categories = $data['categories'];
                unset($data['categories']);

                $post->update($data);

                $post->categories()->sync($categories);
            }else{
                $post->update($data);
            }

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

        return $post;
    }
}
