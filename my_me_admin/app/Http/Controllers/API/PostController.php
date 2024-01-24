<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //get all posts
    public function allPostList(){
        $post =Post::get();
            return response()->json([
                'status' => 'success',
                'post' => $post
            ]);
    }
    public function postSearch(Request $request){
        $category =Post::where('title','LIKE','%'.$request->key.'%')->get();
        return response()->json([
            'searchData' => $category
        ]);
    }
    public function postDetails(Request $request){
        // dd($request->all());
        $id =$request->postId;
        $post =Post::where('post_id',$id)->first();
        return response()->json([
            'post' => $post
        ]);
    }
}
