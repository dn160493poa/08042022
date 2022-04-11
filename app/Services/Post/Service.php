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

                $categoryIds = $this->getCategoryIds($categories);

                $post = Post::create($data);

                $post->categories()->attach($categoryIds);
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

                $categoryIds = $this->getCategoryIdsWithUpdate($categories);

                $post->update($data);

                $post->categories()->sync($categoryIds);
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

    private function getCategoryIds($categories)
    {
        $categoryIds = [];

        foreach ($categories as $category){
            $category = !isset($category['id']) ? Category::firstOrCreate($category) : Category::find($category['id']);
            $categoryIds[] = $category->id;
        }

        return $categoryIds;
    }

    private function getCategoryIdsWithUpdate($categories)
    {
        $categoryIds = [];

        foreach ($categories as $category){
            if(!isset($category['id'])){
                $categoryLocal = Category::firstOrCreate($category);
            }else{
                $currentCategory = Category::find($category['id']);
                $currentCategory->update($category);
                $categoryLocal = $currentCategory->fresh();
            }
            $categoryIds[] = $categoryLocal->id;
        }
        return $categoryIds;
    }
}
