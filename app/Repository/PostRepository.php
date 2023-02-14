<?php
namespace App\Repository;

use App\Models\Post;
use App\Models\Category;

class PostRepository implements IPostRepository{

    public function getAllPosts(){
        return Post::with(['category','state'])->orderBy('id','desc')->get();
    }

    public function getAllCategories(){
        return Category::all();
    }

    public function storePost(array $data){
            return Post::create([
                'name'=>$data['name'],
                'description'=>$data['description'],
                'category_id'=>$data['category_id']
            ]);
    }

    public function editPost($id){
        return Post::where('id',$id)->firstOrFail();
    }

    public function updatePost($id , array $data){
        return Post::find($id)->update([
            'name'=> $data['name'],
            'description'=> $data['description'],
            'category_id'=>$data['category_id']
        ]);
    }

    public function deletePost($id){
        return Post::where('id',$id)->firstOrFail();
    }
}