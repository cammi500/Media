<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TrendPostController extends Controller
{
    public function index()
    {
        $data = ActionLog::select('action_logs.*', 'posts.*', DB::raw('COUNT(action_logs.post_id) as post_count'))
            ->leftJoin('posts', 'posts.post_id', 'action_logs.post_id')
            ->groupBy('action_logs.post_id')
            ->get();
        // dd($data->toArray());

        return view('admin.trendPost.index', compact('data'));
    }
    public function detail($id)
    {
        // dd($id);
        $post = Post::where('post_id', $id)->first();
        return view('admin.trendPost.detail', compact('post'));
    }
}
