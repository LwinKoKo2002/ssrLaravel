<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use App\Repository\IPostRepository;

class PostController extends Controller
{
    public $post;
    public function __construct(IPostRepository $post){
        $this->post = $post;
    }

    public function index(){

        $posts = $this->post->getAllPosts();
        $categories = $this->post->getAllCategories();
        return view('post',compact('posts','categories'));
    }

    public function store(Request $request){
        $post = $this->post->storePost($request->all());
        State::firstOrCreate(
            [
                'post_id' =>  $post->id
            ],
            [
                'name' => 1
            ]
        );
        return response()->json([
            'status'=>'success',
            'message'=>'Successfully created'
        ]);
    }

    public function edit(Request $request){
        $post = $this->post->editPost($request->post_id);
        return response()->json([
            'status'=>'success',
            'message'=>'Successfully deleted',
            'post'=>$post
        ]);
    }

    public function update(Request $request){
        $this->post->updatePost($request->post_id,$request->all());
        return response()->json([
            'status'=>'success',
            'message'=>'Successfully updated'
        ]);
    }

    public function destroy(Request $request){
        $post = $this->post->deletePost($request->post_id);
        $post->delete();
        if($post->state){
            $post->state->name = 0;
            $post->state->update();
        }
        return response()->json([
            'status'=>'success',
            'message'=>'Successfully deleted'
        ]);
    }
}
