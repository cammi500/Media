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
}
