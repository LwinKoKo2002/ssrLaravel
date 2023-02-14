<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\State;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::with('category')->orderBy('id','desc')->get();
        $categories = Category::all();
        return view('post',compact('posts','categories'));
    }

    public function create(Request $request){
        $name = $request->name;
        $description = $request->description;
        $category_id = $request->category_id;
        $post = new Post();
        $post->name = $name;
        $post->description = $description;
        $post->category_id = $category_id;
        $post->save();

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

    public function destroy(Request $request){
        $post_id = $request->post_id;
        $post = Post::where('id',$post_id)->firstOrFail();
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

    public function edit(Request $request){
        $post_id = $request->post_id;
        $post = Post::where('id',$post_id)->firstOrFail();
        return response()->json([
            'status'=>'success',
            'message'=>'Successfully deleted',
            'post'=>$post
        ]);
    }

    public function update(Request $request){
        $post_id = $request->post_id;
        $post = Post::where('id',$post_id)->firstOrFail();
        $post->name = $request->name;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->update();

        return response()->json([
            'status'=>'success',
            'message'=>'Successfully updated'
        ]);
    }
}
