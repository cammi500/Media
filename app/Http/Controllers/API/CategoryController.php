<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //get all categories
    public function allCategoryList(){
        $category = Category::select('category_id','title','description')->get();
        return response()->json([
            'status' => 'success',
            'category' => $category,
        ]);
    }
    //category search
    public function categorySearch(Request $request){
        $category = Category::select('posts.*')
                        ->join('posts','categories.category_id','posts.category_id')
                        ->where('categories.title','LIKE','%'.$request->key.'%')
                        ->get();
        return response()->json([
            'result' => $category,
        ]);
    }
}
