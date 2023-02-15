<?php
namespace App\Repository;

use App\Models\Post;
use App\Models\Category;

class PostRepository implements IPostRepository{

    public function getAllPosts(){
        $post = Post::with(['category','state']);
        if(request()->search){
            $post = $post->where('name','LIKE','%'.request()->search.'%');
        }
        if(request()->category){
            $post = $post->where('category_id',request()->category);
        }
        if(request()->date){
            $post = $post->whereDate('created_at',request()->date);
        }
        return $post->orderBy('id','desc')->paginate(15);
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